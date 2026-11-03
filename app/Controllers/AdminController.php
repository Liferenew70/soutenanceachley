<?php
namespace App\Controllers;

use App\Models\ContactModel;
use App\Models\DevisModel;
use App\Models\AdminModel;

class AdminController
{
    /**
     * Vérifie que l'administrateur est authentifié, sinon redirige vers le login
     */
    private function requireAuth(): void
    {
        if (empty($_SESSION['admin_logged'])) {
            $_SESSION['flash_error'] = "Session expirée. Veuillez vous reconnecter.";
            header('Location: ' . url('admin-login'));
            exit;
        }
    }

    /**
     * Page de connexion administrateur
     */
    public function login(): void
    {
        if (!empty($_SESSION['admin_logged'])) {
            header('Location: ' . url('admin'));
            exit;
        }

        $pageTitle = "Connexion Administration • " . APP_NAME;
        $error = $_SESSION['flash_error'] ?? null;
        $success = $_SESSION['flash_success'] ?? null;
        unset($_SESSION['flash_error'], $_SESSION['flash_success']);

        require __DIR__ . '/../Views/admin/login.php';
    }

    /**
     * Traitement sécurisé de la connexion administrateur
     */
    public function loginSubmit(): void
    {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        // Vérification via la table admins en base de données
        $admin = AdminModel::verifyLogin($username, $password);

        if ($admin) {
            $_SESSION['admin_logged'] = true;
            $_SESSION['admin_id'] = (int) $admin['id'];
            $_SESSION['admin_user'] = $admin['username'];
            $_SESSION['admin_name'] = $admin['name'] ?? 'Administrateur';
            $_SESSION['admin_login_at'] = date('d/m/Y H:i');
            $_SESSION['flash_success'] = "Bienvenue dans votre tableau de bord administrateur !";

            header('Location: ' . url('admin'));
            exit;
        }

        // Message générique sécurisé sans aucun indice révélateur
        $_SESSION['flash_error'] = "Identifiants invalides. Veuillez vérifier vos accès.";
        header('Location: ' . url('admin-login'));
        exit;
    }

    /**
     * Modification sécurisée des identifiants administrateur
     */
    public function updateProfile(): void
    {
        $this->requireAuth();

        $adminId = (int) ($_SESSION['admin_id'] ?? 1);
        $currentPass = trim($_POST['current_password'] ?? '');
        $newUsername = trim($_POST['new_username'] ?? '');
        $newPass = trim($_POST['new_password'] ?? '');
        $confirmPass = trim($_POST['confirm_password'] ?? '');

        if (empty($currentPass)) {
            $_SESSION['flash_error'] = "Veuillez renseigner votre mot de passe actuel pour valider la modification.";
            header('Location: ' . url('admin'));
            exit;
        }

        if (!AdminModel::verifyPassword($adminId, $currentPass)) {
            $_SESSION['flash_error'] = "Le mot de passe actuel saisi est incorrect.";
            header('Location: ' . url('admin'));
            exit;
        }

        if (empty($newUsername)) {
            $_SESSION['flash_error'] = "Le nom d'utilisateur ne peut pas être vide.";
            header('Location: ' . url('admin'));
            exit;
        }

        if (!empty($newPass)) {
            if (strlen($newPass) < 6) {
                $_SESSION['flash_error'] = "Le nouveau mot de passe doit comporter au moins 6 caractères.";
                header('Location: ' . url('admin'));
                exit;
            }
            if ($newPass !== $confirmPass) {
                $_SESSION['flash_error'] = "Les deux nouveaux mots de passe ne correspondent pas.";
                header('Location: ' . url('admin'));
                exit;
            }
        }

        $passwordToUpdate = !empty($newPass) ? $newPass : null;
        if (AdminModel::updateCredentials($adminId, $newUsername, $passwordToUpdate)) {
            $_SESSION['admin_user'] = $newUsername;
            $_SESSION['flash_success'] = "Vos identifiants ont été mis à jour avec succès !";
        } else {
            $_SESSION['flash_error'] = "Erreur lors de la mise à jour (cet identifiant est peut-être déjà pris).";
        }

        header('Location: ' . url('admin'));
        exit;
    }

    /**
     * Déconnexion
     */
    public function logout(): void
    {
        unset($_SESSION['admin_logged'], $_SESSION['admin_user'], $_SESSION['admin_name'], $_SESSION['admin_login_at']);
        $_SESSION['flash_success'] = "Vous avez été déconnecté avec succès.";
        header('Location: ' . url('admin-login'));
        exit;
    }

    /**
     * Tableau de bord principal (Dashboard CRUD)
     */
    public function index(): void
    {
        $this->requireAuth();

        $pageTitle = "Tableau de Bord Administrateur • " . APP_NAME;

        // Onglet actif (messages ou devis)
        $tab = $_GET['tab'] ?? 'messages';
        if (!in_array($tab, ['messages', 'devis'])) {
            $tab = 'messages';
        }

        // Filtres de recherche
        $searchMsg = trim($_GET['search_msg'] ?? '');
        $statusMsg = trim($_GET['status_msg'] ?? 'all');

        $searchDevis = trim($_GET['search_devis'] ?? '');
        $statusDevis = trim($_GET['status_devis'] ?? 'all');

        // Récupération des données
        $messages = ContactModel::getAll($searchMsg, $statusMsg);
        $devisList = DevisModel::getAll($searchDevis, $statusDevis);

        // Statistiques pour les KPI Cards
        $totalMessages = ContactModel::countAll();
        $newMessages = ContactModel::countNew();
        $totalDevis = DevisModel::countAll();
        $pendingDevis = DevisModel::countPending();

        // Flash notifications
        $flashSuccess = $_SESSION['flash_success'] ?? null;
        $flashError = $_SESSION['flash_error'] ?? null;
        unset($_SESSION['flash_success'], $_SESSION['flash_error']);

        require __DIR__ . '/../Views/admin/dashboard.php';
    }

    // -------------------------------------------------------------------------
    // ACTIONS CRUD SUR LES MESSAGES
    // -------------------------------------------------------------------------

    /**
     * Mise à jour d'un message
     */
    public function updateMessage(): void
    {
        $this->requireAuth();

        $id = (int) ($_POST['id'] ?? 0);
        if ($id <= 0) {
            $_SESSION['flash_error'] = "Identifiant de message invalide.";
            header('Location: ' . url('admin', ['tab' => 'messages']));
            exit;
        }

        $data = [
            'name'    => trim($_POST['name'] ?? ''),
            'email'   => trim($_POST['email'] ?? ''),
            'phone'   => trim($_POST['phone'] ?? ''),
            'service' => trim($_POST['service'] ?? 'Général'),
            'subject' => trim($_POST['subject'] ?? 'Demande de contact'),
            'message' => trim($_POST['message'] ?? ''),
            'status'  => trim($_POST['status'] ?? 'nouveau'),
        ];

        if (ContactModel::update($id, $data)) {
            $_SESSION['flash_success'] = "Message #$id mis à jour avec succès !";
        } else {
            $_SESSION['flash_error'] = "Erreur lors de la mise à jour du message #$id.";
        }

        header('Location: ' . url('admin', ['tab' => 'messages']));
        exit;
    }

    /**
     * Suppression individuelle d'un message
     */
    public function deleteMessage(): void
    {
        $this->requireAuth();

        $id = (int) ($_POST['id'] ?? $_GET['id'] ?? 0);
        if ($id > 0 && ContactModel::delete($id)) {
            $_SESSION['flash_success'] = "Le message #$id a été supprimé.";
        } else {
            $_SESSION['flash_error'] = "Impossible de supprimer le message.";
        }

        header('Location: ' . url('admin', ['tab' => 'messages']));
        exit;
    }

    /**
     * Suppression groupée de messages
     */
    public function batchDeleteMessages(): void
    {
        $this->requireAuth();

        $ids = $_POST['ids'] ?? [];
        if (!is_array($ids) || empty($ids)) {
            $_SESSION['flash_error'] = "Veuillez cocher au moins un message à supprimer.";
            header('Location: ' . url('admin', ['tab' => 'messages']));
            exit;
        }

        $count = ContactModel::deleteBatch($ids);
        $_SESSION['flash_success'] = "$count message(s) supprimé(s) avec succès !";
        header('Location: ' . url('admin', ['tab' => 'messages']));
        exit;
    }

    /**
     * Vider tous les messages
     */
    public function truncateMessages(): void
    {
        $this->requireAuth();

        if (ContactModel::truncate()) {
            $_SESSION['flash_success'] = "Tous les messages ont été supprimés et la table a été réinitialisée.";
        } else {
            $_SESSION['flash_error'] = "Erreur lors de la réinitialisation des messages.";
        }

        header('Location: ' . url('admin', ['tab' => 'messages']));
        exit;
    }

    // -------------------------------------------------------------------------
    // ACTIONS CRUD SUR LES DEMANDES DE DEVIS
    // -------------------------------------------------------------------------

    /**
     * Mise à jour d'un devis
     */
    public function updateDevis(): void
    {
        $this->requireAuth();

        $id = (int) ($_POST['id'] ?? 0);
        if ($id <= 0) {
            $_SESSION['flash_error'] = "Identifiant de devis invalide.";
            header('Location: ' . url('admin', ['tab' => 'devis']));
            exit;
        }

        $data = [
            'company_name'    => trim($_POST['company_name'] ?? ''),
            'contact_name'    => trim($_POST['contact_name'] ?? ''),
            'email'           => trim($_POST['email'] ?? ''),
            'phone'           => trim($_POST['phone'] ?? ''),
            'service_type'    => trim($_POST['service_type'] ?? ''),
            'budget_range'    => trim($_POST['budget_range'] ?? 'Non précisé'),
            'urgency'         => trim($_POST['urgency'] ?? 'Normal'),
            'project_details' => trim($_POST['project_details'] ?? ''),
            'status'          => trim($_POST['status'] ?? 'en_attente'),
        ];

        if (DevisModel::update($id, $data)) {
            $_SESSION['flash_success'] = "Demande de devis #$id mise à jour avec succès !";
        } else {
            $_SESSION['flash_error'] = "Erreur lors de la mise à jour du devis #$id.";
        }

        header('Location: ' . url('admin', ['tab' => 'devis']));
        exit;
    }

    /**
     * Suppression individuelle d'un devis
     */
    public function deleteDevis(): void
    {
        $this->requireAuth();

        $id = (int) ($_POST['id'] ?? $_GET['id'] ?? 0);
        if ($id > 0 && DevisModel::delete($id)) {
            $_SESSION['flash_success'] = "La demande de devis #$id a été supprimée.";
        } else {
            $_SESSION['flash_error'] = "Impossible de supprimer la demande de devis.";
        }

        header('Location: ' . url('admin', ['tab' => 'devis']));
        exit;
    }

    /**
     * Suppression groupée de devis
     */
    public function batchDeleteDevis(): void
    {
        $this->requireAuth();

        $ids = $_POST['ids'] ?? [];
        if (!is_array($ids) || empty($ids)) {
            $_SESSION['flash_error'] = "Veuillez cocher au moins un devis à supprimer.";
            header('Location: ' . url('admin', ['tab' => 'devis']));
            exit;
        }

        $count = DevisModel::deleteBatch($ids);
        $_SESSION['flash_success'] = "$count devis supprimé(s) avec succès !";
        header('Location: ' . url('admin', ['tab' => 'devis']));
        exit;
    }

    /**
     * Vider tous les devis
     */
    public function truncateDevis(): void
    {
        $this->requireAuth();

        if (DevisModel::truncate()) {
            $_SESSION['flash_success'] = "Toutes les demandes de devis ont été supprimées et la table a été réinitialisée.";
        } else {
            $_SESSION['flash_error'] = "Erreur lors de la réinitialisation des devis.";
        }

        header('Location: ' . url('admin', ['tab' => 'devis']));
        exit;
    }

    // -------------------------------------------------------------------------
    // ACTIONS RAPIDES DE TEST & PURGE GLOBALE
    // -------------------------------------------------------------------------

    /**
     * Génère 5 messages et 5 devis de test en 1 clic
     */
    public function seedData(): void
    {
        $this->requireAuth();

        $msgs = ContactModel::seedTestData();
        $devis = DevisModel::seedTestData();

        $_SESSION['flash_success'] = "Données de test créées : $msgs messages et $devis demandes de devis ajoutés avec succès !";
        header('Location: ' . url('admin'));
        exit;
    }

    /**
     * Purge TOUTES les données de test en 1 clic (reset des tables messages et devis)
     */
    public function purgeAll(): void
    {
        $this->requireAuth();

        ContactModel::truncate();
        DevisModel::truncate();

        $_SESSION['flash_success'] = "Purger terminée : toutes les données de test ont été effacées et les tables remises à zéro !";
        header('Location: ' . url('admin'));
        exit;
    }
}

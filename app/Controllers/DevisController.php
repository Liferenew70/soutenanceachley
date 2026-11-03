<?php
namespace App\Controllers;

use App\Models\DevisModel;

class DevisController
{
    public function index(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $flash = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);

        $pageTitle = "Demande de Devis Gratuit • Estimez Votre Projet | Wiky Holding";
        $currentPage = 'devis';

        require dirname(__DIR__) . '/Views/pages/devis.php';
    }

    public function submit(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . url('devis'));
            exit;
        }

        $token = $_POST['csrf_token'] ?? '';
        if (empty($token) || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Jeton de sécurité expiré. Veuillez soumettre à nouveau votre formulaire.'
            ];
            header('Location: ' . url('devis'));
            exit;
        }

        $company_name    = trim($_POST['company_name'] ?? '');
        $contact_name    = trim($_POST['contact_name'] ?? '');
        $email           = trim($_POST['email'] ?? '');
        $phone           = trim($_POST['phone'] ?? '');
        $service_type    = trim($_POST['service_type'] ?? '');
        $budget_range    = trim($_POST['budget_range'] ?? 'Non précisé');
        $urgency         = trim($_POST['urgency'] ?? 'Normal');
        $project_details = trim($_POST['project_details'] ?? '');

        $errors = [];
        if (empty($contact_name)) $errors[] = 'Votre nom est requis.';
        if (empty($company_name)) $errors[] = 'Le nom de votre entreprise ou projet est requis.';
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Une adresse email valide est requise.';
        if (empty($phone)) $errors[] = 'Un numéro de téléphone est requis.';
        if (empty($service_type)) $errors[] = 'Veuillez sélectionner un type de prestation.';
        if (empty($project_details) || mb_strlen($project_details) < 15) $errors[] = 'Veuillez décrire brièvement votre besoin (au moins 15 caractères).';

        if (!empty($errors)) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => implode(' ', $errors)
            ];
            header('Location: ' . url('devis'));
            exit;
        }

        $saved = DevisModel::save([
            'company_name'    => $company_name,
            'contact_name'    => $contact_name,
            'email'           => $email,
            'phone'           => $phone,
            'service_type'    => $service_type,
            'budget_range'    => $budget_range,
            'urgency'         => $urgency,
            'project_details' => $project_details,
        ]);

        if ($saved) {
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Félicitations ' . e($contact_name) . ' ! Votre demande de devis pour "' . e($company_name) . '" a bien été enregistrée. Notre chargé d’affaires vous contactera sous 24h avec une proposition sur-mesure.'
            ];
        } else {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Une erreur technique s’est produite. Veuillez réessayer ou nous joindre directement.'
            ];
        }

        header('Location: ' . url('devis'));
        exit;
    }
}

<?php
namespace App\Controllers;

use App\Models\ContactModel;

class ContactController
{
    public function index(): void
    {
        // Initialisation token CSRF si non existant
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $flash = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);

        $pageTitle = "Contact & Rendez-vous • Wiky Holding à Abidjan";
        $currentPage = 'contact';

        require dirname(__DIR__) . '/Views/pages/contact.php';
    }

    public function submit(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . url('contact'));
            exit;
        }

        // Vérification CSRF
        $token = $_POST['csrf_token'] ?? '';
        if (empty($token) || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Jeton de sécurité invalide. Veuillez réessayer.'
            ];
            header('Location: ' . url('contact'));
            exit;
        }

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $service = trim($_POST['service'] ?? 'Général');
        $subject = trim($_POST['subject'] ?? 'Demande de renseignement');
        $message = trim($_POST['message'] ?? '');

        // Validation
        $errors = [];
        if (empty($name) || mb_strlen($name) < 2) {
            $errors[] = 'Veuillez saisir votre nom complet.';
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Veuillez saisir une adresse email valide.';
        }
        if (empty($message) || mb_strlen($message) < 10) {
            $errors[] = 'Votre message doit contenir au moins 10 caractères.';
        }

        if (!empty($errors)) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => implode(' ', $errors)
            ];
            header('Location: ' . url('contact'));
            exit;
        }

        // Sauvegarde via PDO
        $saved = ContactModel::save([
            'name'    => $name,
            'email'   => $email,
            'phone'   => $phone,
            'service' => $service,
            'subject' => $subject,
            'message' => $message,
        ]);

        if ($saved) {
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Merci ' . e($name) . ' ! Votre message a été transmis avec succès. Notre équipe vous recontactera sous 24h ouvrées.'
            ];
        } else {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Une erreur est survenue lors de l’envoi. Veuillez réessayer ou nous joindre directement par téléphone.'
            ];
        }

        header('Location: ' . url('contact'));
        exit;
    }
}

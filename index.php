<?php
/**
 * Digital Agency Wiky / Wiky Holding
 * Front Controller & Routeur Principal
 * Architecture MVP / MVC en PHP Vanilla + PDO
 */

declare(strict_types=1);

// Démarrage de session sécurisé
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Chargement des configurations
require_once __DIR__ . '/app/Config/App.php';
require_once __DIR__ . '/app/Config/Database.php';

// Autoload simple des classes du namespace App
spl_autoload_register(function (string $class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

// Récupération de la page demandée (query parameter ou réécriture d'URL)
$page = $_GET['page'] ?? '';

if (empty($page)) {
    // Détection via REQUEST_URI si mod_rewrite est activé
    $requestUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    $scriptName = dirname($_SERVER['SCRIPT_NAME'] ?? '');
    $path = trim(str_replace($scriptName, '', $requestUri), '/');
    if (!empty($path) && $path !== 'index.php') {
        $page = $path;
    }
}

// Nettoyage de la route
$page = strtolower(trim($page, '/'));

// Table de routage MVC
switch ($page) {
    case '':
    case 'home':
    case 'accueil':
        (new \App\Controllers\HomeController())->index();
        break;

    case 'about':
    case 'a-propos':
        (new \App\Controllers\AboutController())->index();
        break;

    case 'services':
    case 'nos-services':
        (new \App\Controllers\ServiceController())->index();
        break;

    case 'portfolio':
    case 'realisations':
        (new \App\Controllers\PortfolioController())->index();
        break;

    case 'podcast':
    case 'studio':
        (new \App\Controllers\PodcastController())->index();
        break;

    case 'contact':
        (new \App\Controllers\ContactController())->index();
        break;

    case 'contact-submit':
        (new \App\Controllers\ContactController())->submit();
        break;

    case 'devis':
        (new \App\Controllers\DevisController())->index();
        break;

    case 'devis-submit':
        (new \App\Controllers\DevisController())->submit();
        break;

    // -------------------------------------------------------------
    // ESPACE ADMINISTRATION & DASHBOARD CRUD
    // -------------------------------------------------------------
    case 'admin':
    case 'dashboard':
        (new \App\Controllers\AdminController())->index();
        break;

    case 'admin-login':
    case 'login':
        (new \App\Controllers\AdminController())->login();
        break;

    case 'admin-login-submit':
        (new \App\Controllers\AdminController())->loginSubmit();
        break;

    case 'admin-logout':
    case 'logout':
        (new \App\Controllers\AdminController())->logout();
        break;

    case 'admin-message-update':
        (new \App\Controllers\AdminController())->updateMessage();
        break;

    case 'admin-message-delete':
        (new \App\Controllers\AdminController())->deleteMessage();
        break;

    case 'admin-messages-batch-delete':
        (new \App\Controllers\AdminController())->batchDeleteMessages();
        break;

    case 'admin-messages-truncate':
        (new \App\Controllers\AdminController())->truncateMessages();
        break;

    case 'admin-devis-update':
        (new \App\Controllers\AdminController())->updateDevis();
        break;

    case 'admin-devis-delete':
        (new \App\Controllers\AdminController())->deleteDevis();
        break;

    case 'admin-devis-batch-delete':
        (new \App\Controllers\AdminController())->batchDeleteDevis();
        break;

    case 'admin-devis-truncate':
        (new \App\Controllers\AdminController())->truncateDevis();
        break;

    case 'admin-seed-data':
        (new \App\Controllers\AdminController())->seedData();
        break;

    case 'admin-purge-all':
        (new \App\Controllers\AdminController())->purgeAll();
        break;

    case 'admin-profile-update':
    case 'admin-update-credentials':
        (new \App\Controllers\AdminController())->updateProfile();
        break;

    default:
        // Page 404 personnalisée et soignée
        http_response_code(404);
        $pageTitle = "Page Non Trouvée (404) • " . APP_NAME;
        require __DIR__ . '/app/Views/layout/header.php';
        ?>
        <section class="section text-center py-24">
            <div class="container">
                <div class="badge">Erreur 404</div>
                <h1 class="page-title mt-4">Page introuvable</h1>
                <p class="lead max-w-reading mx-auto">La ressource que vous recherchez semble avoir été déplacée ou n'existe pas.</p>
                <div class="mt-8">
                    <a href="<?= e(url()) ?>" class="btn btn--primary">Retourner à l'accueil</a>
                </div>
            </div>
        </section>
        <?php
        require __DIR__ . '/app/Views/layout/footer.php';
        break;
}

<?php
/**
 * Wiky Holding - Gestionnaire de Connexion PDO (MySQL Pur)
 * 
 * Ce fichier est l'UNIQUE source de vérité pour la configuration de la base de données.
 * Aucun identifiant ou nom de base n'est écrit en dur ailleurs dans le projet.
 */

namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $instance = null;

    // =========================================================================
    // PARAMÈTRES DE CONNEXION MYSQL (CENTRALISÉS ICI)
    // =========================================================================
    // 1. CONFIGURATION LOCALE (WampServer / Laragon)
    public const LOCAL_HOST = 'localhost';
    public const LOCAL_NAME = 'wiky_db';
    public const LOCAL_USER = 'root';
    public const LOCAL_PASS = '';

    // 2. CONFIGURATION EN LIGNE (InfinityFree - Compte if0_43340677)
    // Copiez ces informations depuis votre onglet "MySQL Databases" InfinityFree :
    public const PROD_HOST = 'sql300.infinityfree.com'; // Ex: sqlxxx.infinityfree.com (MySQL Host Name)
    public const PROD_NAME = 'if0_43340677_wiky_db';    // Ex: if0_43340677_xxx (Database Name créée)
    public const PROD_USER = 'if0_43340677';            // Ex: if0_43340677 (MySQL User Name)
    public const PROD_PASS = '';                        // Votre mot de passe de compte InfinityFree (vPanel)

    public const DB_CHARSET = 'utf8mb4';

    /**
     * Récupère l'instance unique de connexion PDO (Patron Singleton)
     */
    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            self::$instance = self::createConnection();
        }
        return self::$instance;
    }

    /**
     * Détermine si le script s'exécute en local ou en production
     */
    public static function isLocal(): bool
    {
        $serverName = $_SERVER['SERVER_NAME'] ?? '';
        $httpHost   = $_SERVER['HTTP_HOST'] ?? '';
        return ($serverName === 'localhost' || $serverName === '127.0.0.1' || $serverName === '::1'
                || strpos($httpHost, 'localhost') !== false || strpos($httpHost, '127.0.0.1') !== false);
    }

    /**
     * Initialise et retourne la connexion PDO vers MySQL
     */
    private static function createConnection(): PDO
    {
        $isLocal = self::isLocal();
        $host = $isLocal ? self::LOCAL_HOST : self::PROD_HOST;
        $db   = $isLocal ? self::LOCAL_NAME : self::PROD_NAME;
        $user = $isLocal ? self::LOCAL_USER : self::PROD_USER;
        $pass = $isLocal ? self::LOCAL_PASS : self::PROD_PASS;

        $dsn = "mysql:host=" . $host . ";dbname=" . $db . ";charset=" . self::DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
            return $pdo;
        } catch (PDOException $e) {
            // Affichage d'un message d'aide clair et professionnel en cas de mauvaise configuration
            $safeHost = htmlspecialchars($host);
            $safeDb = htmlspecialchars($db);
            $safeUser = htmlspecialchars($user);
            $msg = htmlspecialchars($e->getMessage());
            $envLabel = $isLocal ? 'Environnement LOCAL détecté' : 'Environnement PRODUCTION (InfinityFree) détecté';

            $guide = $isLocal ? <<<LOCAL
            <h2>Guide pour démarrer en local avec WampServer :</h2>
            <ol>
                <li>Vérifiez que <strong>WampServer est lancé</strong> (l'icône Wamp dans la barre des tâches doit être <strong>verte</strong>).</li>
                <li>Ouvrez <a href="http://localhost/phpmyadmin" target="_blank" style="color:#38bdf8;text-decoration:underline;">phpMyAdmin</a> dans votre navigateur.</li>
                <li>Créez une base de données nommée <code>{$safeDb}</code> (interclassement : <code>utf8mb4_unicode_ci</code>).</li>
                <li>Cliquez sur l'onglet <strong>Importer</strong> et sélectionnez le fichier <code>database.sql</code> du projet.</li>
                <li>Actualisez ensuite cette page.</li>
            </ol>
LOCAL
            : <<<PROD
            <h2>Guide pour InfinityFree (Production) :</h2>
            <ol>
                <li>Allez dans votre panneau InfinityFree &gt; onglet <strong>MySQL Databases</strong>.</li>
                <li>Créez une base si ce n'est pas déjà fait.</li>
                <li>Ouvrez <code>app/Config/Database.php</code> et renseignez les 4 constantes <strong>PROD_*</strong> :
                    <br>• <code>PROD_HOST</code> = MySQL Host Name (ex: <code>sql300.infinityfree.com</code>)
                    <br>• <code>PROD_NAME</code> = MySQL Database Name (ex: <code>if0_43340677_wiky_db</code>)
                    <br>• <code>PROD_USER</code> = MySQL User Name (ex: <code>if0_43340677</code>)
                    <br>• <code>PROD_PASS</code> = Votre mot de passe de compte InfinityFree
                </li>
                <li>Dans phpMyAdmin en ligne, importez <code>sdldirecte.sql</code> ou <code>database.sql</code>.</li>
            </ol>
PROD;

            $html = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration Base de Données - Wiky Holding</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif; background: #0f172a; color: #f8fafc; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; padding: 20px; box-sizing: border-box; }
        .card { background: #1e293b; border: 1px solid #334155; border-radius: 16px; padding: 32px; max-width: 640px; width: 100%; box-shadow: 0 20px 40px rgba(0,0,0,0.5); }
        h1 { color: #f87171; font-size: 22px; margin-top: 0; display: flex; align-items: center; gap: 10px; }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; background: #1e3a5f; color: #38bdf8; margin-bottom: 12px; }
        .params { background: #0f172a; border-radius: 8px; padding: 14px 18px; margin: 20px 0; font-family: Consolas, monospace; font-size: 14px; line-height: 1.6; }
        .params span { color: #94a3b8; }
        .params strong { color: #38bdf8; }
        .alert { background: rgba(239, 68, 68, 0.1); border-left: 4px solid #ef4444; padding: 12px 16px; border-radius: 4px; font-size: 13px; color: #fca5a5; margin-bottom: 20px; }
        .steps { background: #0f172a; border-radius: 8px; padding: 16px 20px; margin-top: 20px; }
        .steps h2 { font-size: 15px; color: #fbbf24; margin-top: 0; }
        .steps ol { margin: 0; padding-left: 20px; font-size: 14px; color: #cbd5e1; line-height: 1.8; }
        .steps code { background: #1e293b; padding: 2px 6px; border-radius: 4px; color: #a7f3d0; font-family: Consolas, monospace; }
        .btn { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #3b82f6; color: white; text-decoration: none; border-radius: 8px; font-size: 14px; font-weight: 600; }
        .btn:hover { background: #2563eb; }
    </style>
</head>
<body>
    <div class="card">
        <div class="badge">{$envLabel}</div>
        <h1>⚠️ Connexion MySQL Requise</h1>
        <div class="alert"><strong>Erreur MySQL :</strong> {$msg}</div>
        
        <p>Paramètres de connexion actuels (dans <code>app/Config/Database.php</code>) :</p>
        <div class="params">
            <div><span>Hôte :</span> <strong>{$safeHost}</strong></div>
            <div><span>Base :</span> <strong>{$safeDb}</strong></div>
            <div><span>Utilisateur :</span> <strong>{$safeUser}</strong></div>
        </div>

        <div class="steps">
            {$guide}
        </div>

        <div style="text-align: right;">
            <a href="javascript:location.reload();" class="btn">🔄 Réessayer la connexion</a>
        </div>
    </div>
</body>
</html>
HTML;
            die($html);
        }
    }
}

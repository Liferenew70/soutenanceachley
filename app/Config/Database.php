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
    // Modifiez uniquement ces constantes pour changer de base de données :
    //
    // --- 1. CONFIGURATION LOCALE (WampServer par défaut) ---
    // public const DB_HOST = 'localhost';
    // public const DB_NAME = 'wiky_db';        // Nom de la base créée dans phpMyAdmin
    // public const DB_USER = 'root';           // Utilisateur par défaut de WampServer
    // public const DB_PASS = '';               // Mot de passe vide par défaut sous WampServer
    // public const DB_CHARSET = 'utf8mb4';
    //
    // --- 2. CONFIGURATION EN LIGNE (InfinityFree en production) ---
    // public const DB_HOST = 'sqlxxx.infinityfree.com'; // ex: sql300.infinityfree.com
    // public const DB_NAME = 'if0_xxxxxxx_wiky_db';    // ex: if0_37000000_wiky_db
    // public const DB_USER = 'if0_xxxxxxx';            // ex: if0_37000000
    // public const DB_PASS = 'votre_mot_de_passe';     // Mot de passe compte InfinityFree
    // public const DB_CHARSET = 'utf8mb4';
    // =========================================================================

    public const DB_HOST = 'localhost';              // 'localhost' en local ou 'sqlxxx.infinityfree.com' en ligne
    public const DB_NAME = 'wiky_db';                // Nom de la base de données
    public const DB_USER = 'root';                   // Nom d'utilisateur MySQL
    public const DB_PASS = '';                       // Mot de passe MySQL
    public const DB_CHARSET = 'utf8mb4';             // Jeu de caractères UTF-8 complet

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
     * Initialise et retourne la connexion PDO vers MySQL
     */
    private static function createConnection(): PDO
    {
        $dsn = "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME . ";charset=" . self::DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $pdo = new PDO($dsn, self::DB_USER, self::DB_PASS, $options);
            return $pdo;
        } catch (PDOException $e) {
            // Affichage d'un message d'aide clair et professionnel en cas de mauvaise configuration
            $host = htmlspecialchars(self::DB_HOST);
            $db = htmlspecialchars(self::DB_NAME);
            $user = htmlspecialchars(self::DB_USER);
            $msg = htmlspecialchars($e->getMessage());

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
        <h1>⚠️ Connexion MySQL Requise</h1>
        <div class="alert"><strong>Erreur MySQL :</strong> {$msg}</div>
        
        <p>Le site est configuré pour se connecter à MySQL avec les paramètres suivants (définis dans <code>app/Config/Database.php</code>) :</p>
        <div class="params">
            <div><span>Hôte (DB_HOST) :</span> <strong>{$host}</strong></div>
            <div><span>Base (DB_NAME) :</span> <strong>{$db}</strong></div>
            <div><span>Utilisateur (DB_USER) :</span> <strong>{$user}</strong></div>
        </div>

        <div class="steps">
            <h2>Guide pour démarrer en local avec WampServer :</h2>
            <ol>
                <li>Vérifiez que <strong>WampServer est lancé</strong> (l'icône Wamp dans la barre des tâches doit être <strong>verte</strong>).</li>
                <li>Ouvrez <a href="http://localhost/phpmyadmin" target="_blank" style="color:#38bdf8;text-decoration:underline;">phpMyAdmin</a> dans votre navigateur.</li>
                <li>Créez une base de données nommée <code>{$db}</code> (interclassement : <code>utf8mb4_unicode_ci</code>).</li>
                <li>Cliquez sur l'onglet <strong>Importer</strong> et sélectionnez le fichier <code>database.sql</code> du projet.</li>
                <li>Actualisez ensuite cette page.</li>
            </ol>
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

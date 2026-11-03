<?php
/**
 * Wiky Holding & Digital Agency Wiky
 * Configuration Générale de l'Application
 */

// Nom et informations de l'entreprise
define('APP_NAME', 'Wiky Holding');
define('APP_TAGLINE', 'Agence Conseil 360° • Community Management, Branding, Studio Podcast & Stratégie');
define('COMPANY_NAME', 'Wiky Holding');
define('COMPANY_LEGAL', 'Wiky Holding SARL');
define('COMPANY_ADDRESS', 'Abidjan, Cocody Riviera faya, Côte d’Ivoire');
define('COMPANY_PHONE', '+225 07 88 83 70 24 / +225 27 24 42 42 00');
define('COMPANY_EMAIL', 'Wikytechnologieci@gmail.com');
define('COMPANY_HOURS', 'Lun - Ven : 08h30 - 18h30 | Sam : 09h00 - 14h00');

// Détection de l'URL de base dynamique (compatible InfinityFree, XAMPP, PHP CLI)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$baseUrl = rtrim($protocol . $host . ($scriptDir === '/' ? '' : $scriptDir), '/');

define('BASE_URL', $baseUrl);
define('ASSETS_URL', BASE_URL . '/assets');

// Helper pour l'échappement XSS
function e(?string $string): string {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

// Helper pour générer les URLs internes (compatible requêtes avec ou sans mod_rewrite)
function url(string $page = '', array $params = []): string {
    $cleanPage = ltrim($page, '/');
    if (empty($cleanPage)) {
        $link = BASE_URL . '/';
    } else {
        $link = BASE_URL . '/index.php?page=' . urlencode($cleanPage);
    }
    if (!empty($params)) {
        $link .= (strpos($link, '?') !== false ? '&' : '?') . http_build_query($params);
    }
    return $link;
}

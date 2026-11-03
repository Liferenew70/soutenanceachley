<?php
/**
 * Layout Header - Digital Agency Wiky / Wiky Holding
 */
if (!defined('APP_NAME')) {
    require_once dirname(__DIR__, 2) . '/Config/App.php';
}
?>
<!DOCTYPE html>
<html lang="fr" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title><?= e($pageTitle ?? APP_NAME . ' • Branding, Digital & Studio Podcast 4K à Abidjan') ?></title>
    <meta name="description" content="Wiky Holding : Agence créative à Abidjan. Spécialiste en Community Management, modération 7j/7, création de logos vectoriels, production en Studio Podcast 4K et stratégies de marque.">
    <meta name="author" content="Wiky Holding">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Réseaux Sociaux (URLs absolues requises pour InfinityFree) -->
    <meta property="og:title" content="<?= e($pageTitle ?? APP_NAME) ?>">
    <meta property="og:description" content="Sublimez votre marque et dominez vos réseaux avec Wiky Holding à Abidjan.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= e(BASE_URL) ?>">
    <meta property="og:site_name" content="<?= e(APP_NAME) ?>">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:image" content="<?= e(BASE_URL) ?>/assets/images/studio-podcast-abidjan.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Wiky Holding - Agence conseil 360° à Abidjan">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@wikyholding">
    <meta name="twitter:title" content="<?= e($pageTitle ?? APP_NAME) ?>">
    <meta name="twitter:description" content="Sublimez votre marque et dominez vos réseaux avec Wiky Holding à Abidjan.">
    <meta name="twitter:image" content="<?= e(BASE_URL) ?>/assets/images/studio-podcast-abidjan.jpg">

    <!-- Préconnexion aux polices pour optimisation de chargement (Discipline 1 du design system) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Feuille de styles principale (Design Tokens & Styles d'Élite) -->
    <link rel="stylesheet" href="<?= e(ASSETS_URL) ?>/css/style.css">

    <!-- Favicon SVG officiel Wiky Holding -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='24' fill='%230F172A'/><text x='50' y='66' font-size='44' font-weight='900' font-family='sans-serif' text-anchor='middle' fill='%23FA4D09'>W</text></svg>">

    <!-- Initialisation immédiate du thème pour éviter tout FOUC (flash blanc) -->
    <script>
        (function() {
            try {
                var savedTheme = localStorage.getItem('wiky_theme') || 'light';
                var savedAccent = localStorage.getItem('wiky_accent') || 'orange';
                var customColor = localStorage.getItem('wiky_custom_color') || localStorage.getItem('wiky_custom_accent');
                document.documentElement.setAttribute('data-theme', savedTheme);
                document.documentElement.setAttribute('data-accent', savedAccent);
                if (savedAccent === 'custom' && customColor) {
                    document.documentElement.style.setProperty('--primary-color', customColor);
                    document.documentElement.style.setProperty('--primary-hover', customColor);
                    document.documentElement.style.setProperty('--primary-subtle', customColor + '22');
                }
            } catch(e) {}
        })();
    </script>
</head>
<body class="page-<?= e($currentPage ?? 'default') ?>">
    <div class="site-wrapper">
        <?php require __DIR__ . '/navbar.php'; ?>
        <main id="main-content" class="main-content">

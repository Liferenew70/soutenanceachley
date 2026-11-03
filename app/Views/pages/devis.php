<?php
require dirname(__DIR__) . '/layout/header.php';
$selectedService = $_GET['service'] ?? 'community-management';
?>

<!-- ============================================================== -->
<!-- DEVIS HERO                                                     -->
<!-- ============================================================== -->
<section class="page-hero">
    <div class="container text-center">
        <div class="badge">Simulateur & Devis Gratuit</div>
        <h1 class="page-title">Estimez le Budget de Votre Projet</h1>
        <p class="page-lead max-w-reading">
            Sélectionnez vos besoins pour obtenir une estimation instantanée, puis validez votre demande pour recevoir une offre contractuelle complète sous 24h.
        </p>
    </div>
</section>

<!-- ============================================================== -->
<!-- SIMULATEUR & FORMULAIRE                                        -->
<!-- ============================================================== -->
<section class="section">
    <div class="container">
        <?php if (!empty($flash)): ?>
            <div class="alert alert--<?= e($flash['type']) ?>" role="alert">
                <div class="alert-icon">
                    <?php if ($flash['type'] === 'success'): ?>
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <?php else: ?>
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    <?php endif; ?>
                </div>
                <div class="alert-message"><?= e($flash['message']) ?></div>
            </div>
        <?php endif; ?>

        <div class="devis-layout-grid">
            <!-- Formulaire de Devis -->
            <div class="card devis-form-card">
                <div class="form-intro">
                    <h2 class="form-title">Détaillez Votre Projet</h2>
                    <p class="form-subtitle">Toutes les informations restent strictement confidentielles.</p>
                </div>

                <form action="<?= e(url('devis-submit')) ?>" method="POST" class="devis-form" id="devis-form" novalidate>
                    <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token'] ?? '') ?>">

                    <!-- Étape 1 : Choix de la prestation -->
                    <div class="form-section-title">1. Type de Prestation & Envergure</div>
                    
                    <div class="form-group">
                        <label for="calc-service" class="form-label">Service principal souhaité</label>
                        <select id="calc-service" name="service_type" class="form-select" required>
                            <option value="community-management" <?= $selectedService === 'community-management' ? 'selected' : '' ?>>Community Management & Modération Réseaux (dès 150k FCFA)</option>
                            <option value="branding-logos" <?= $selectedService === 'branding-logos' ? 'selected' : '' ?>>Identité Visuelle, Logos & Charte (dès 250k FCFA)</option>
                            <option value="studio-podcast" <?= $selectedService === 'studio-podcast' ? 'selected' : '' ?>>Studio Podcast & Enregistrement 4K (dès 80k FCFA)</option>
                            <option value="creation-entreprise" <?= $selectedService === 'creation-entreprise' ? 'selected' : '' ?>>Branding d'Entreprise & Pack Lancement (dès 450k FCFA)</option>
                        </select>
                    </div>

                    <div class="form-row form-row-2">
                        <div class="form-group">
                            <label for="calc-scope" class="form-label">Niveau d'envergure</label>
                            <select id="calc-scope" name="budget_range" class="form-select">
                                <option value="starter">Starter / Découverte</option>
                                <option value="standard" selected>Standard / Croissance</option>
                                <option value="premium">Premium / Intensif 360°</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="calc-speed" class="form-label">Délai souhaité</label>
                            <select id="calc-speed" name="urgency" class="form-select">
                                <option value="normal" selected>Normal (2 à 3 semaines)</option>
                                <option value="urgent">Prioritaire (< 7 jours ouvrés)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Étape 2 : Coordonnées -->
                    <div class="form-section-title mt-6">2. Vos Coordonnées Professionnelles</div>

                    <div class="form-row form-row-2">
                        <div class="form-group">
                            <label for="devis-company" class="form-label">Entreprise / Nom de marque <span class="required">*</span></label>
                            <input type="text" id="devis-company" name="company_name" class="form-input" placeholder="Ex: Ivoire Bio SARL" required>
                        </div>
                        <div class="form-group">
                            <label for="devis-contact" class="form-label">Nom du responsable <span class="required">*</span></label>
                            <input type="text" id="devis-contact" name="contact_name" class="form-input" placeholder="Ex: Kouamé Cyrille" required>
                        </div>
                    </div>

                    <div class="form-row form-row-2">
                        <div class="form-group">
                            <label for="devis-email" class="form-label">Email de contact <span class="required">*</span></label>
                            <input type="email" id="devis-email" name="email" class="form-input" placeholder="direction@ivoirebio.ci" required>
                        </div>
                        <div class="form-group">
                            <label for="devis-phone" class="form-label">Numéro de téléphone <span class="required">*</span></label>
                            <input type="tel" id="devis-phone" name="phone" class="form-input" placeholder="+225 07 00 00 00" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="devis-details" class="form-label">Précisions sur votre besoin ou contexte de votre marque <span class="required">*</span></label>
                        <textarea id="devis-details" name="project_details" class="form-textarea" rows="4" placeholder="Ex: Nous souhaitons refaire notre logo et animer notre communauté Facebook et Instagram de 15.000 abonnés avec modération quotidienne..." required></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn--primary btn--full btn--lg">
                            <span>Envoyer ma demande et bloquer ce tarif</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Carte Simulateur & Résumé en temps réel -->
            <div class="devis-summary-wrapper">
                <div class="card devis-calc-card">
                    <span class="calc-badge">Simulateur en Temps Réel</span>
                    <h3 class="calc-title">Estimation Indicative</h3>
                    <p class="calc-desc">Ce montant s'adapte automatiquement selon vos choix et permet de situer l'investissement.</p>

                    <div class="calc-price-display">
                        <span class="calc-price-value" id="calc-result">240 000 FCFA</span>
                        <span class="calc-price-note">Hors taxes • Devis contractuel fourni sous 24h</span>
                    </div>

                    <div class="calc-guarantees">
                        <div class="guarantee-item">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Zéro engagement avant signature de proposition</span>
                        </div>
                        <div class="guarantee-item">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Chargée de projet dédiée à votre dossier</span>
                        </div>
                        <div class="guarantee-item">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Possibilité de paiement échelonné</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require dirname(__DIR__) . '/layout/footer.php'; ?>

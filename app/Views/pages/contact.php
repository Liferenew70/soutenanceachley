<?php
require dirname(__DIR__) . '/layout/header.php';
?>

<!-- ============================================================== -->
<!-- CONTACT HERO                                                   -->
<!-- ============================================================== -->
<section class="page-hero">
    <div class="container text-center">
        <div class="badge">Échangeons Directement</div>
        <h1 class="page-title">Contactez <br> Wiky Holding</h1>
        <p class="page-lead max-w-reading">
            Une question sur nos forfaits de Community Management, une demande de création de logo ou une séance de studio podcast ? Nous vous répondons sous 24h.
        </p>
    </div>
</section>

<!-- ============================================================== -->
<!-- FORMULAIRE & COORDONNÉES                                       -->
<!-- ============================================================== -->
<section class="section">
    <div class="container">
        <!-- Message Flash (Feedback utilisateur) -->
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

        <div class="contact-layout-grid">
            <!-- Formulaire de contact -->
            <div class="card contact-form-card">
                <div class="form-intro">
                    <h2 class="form-title">Envoyez-nous un message</h2>
                    <p class="form-subtitle">Remplissez le formulaire ci-dessous et notre chargée de projet prendra contact avec vous.</p>
                </div>

                <form action="<?= e(url('contact-submit')) ?>" method="POST" class="contact-form" novalidate>
                    <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token'] ?? '') ?>">

                    <div class="form-row form-row-2">
                        <div class="form-group">
                            <label for="contact-name" class="form-label">Nom complet <span class="required">*</span></label>
                            <input type="text" id="contact-name" name="name" class="form-input" placeholder="Ex: Jean-Marc Koffi" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-email" class="form-label">Adresse email <span class="required">*</span></label>
                            <input type="email" id="contact-email" name="email" class="form-input" placeholder="koffi@entreprise.ci" required>
                        </div>
                    </div>

                    <div class="form-row form-row-2">
                        <div class="form-group">
                            <label for="contact-phone" class="form-label">Numéro de téléphone</label>
                            <input type="tel" id="contact-phone" name="phone" class="form-input" placeholder="+225 07 00 00 00 00">
                        </div>
                        <div class="form-group">
                            <label for="contact-service" class="form-label">Prestation concernée</label>
                            <select id="contact-service" name="service" class="form-select">
                                <option value="Community Management">Community Management & Modération</option>
                                <option value="Identité Visuelle & Logo">Identité Visuelle & Logo</option>
                                <option value="Studio Podcast & Audiovisuel">Studio Podcast & Audiovisuel</option>
                                <option value="Branding d'Entreprise">Branding & Pack Lancement</option>
                                <option value="Autre demande">Autre renseignement</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="contact-subject" class="form-label">Objet du message</label>
                        <input type="text" id="contact-subject" name="subject" class="form-input" placeholder="Ex: Devis pour modération de notre page Facebook">
                    </div>

                    <div class="form-group">
                        <label for="contact-message" class="form-label">Votre message ou description du besoin <span class="required">*</span></label>
                        <textarea id="contact-message" name="message" class="form-textarea" rows="5" placeholder="Décrivez votre projet, vos objectifs et vos délais..." required></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn--primary btn--full">
                            <span>Transmettre mon message</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Coordonnées et localisation -->
            <div class="contact-info-wrapper">
                <div class="contact-office-card">
                    <img src="<?= e(ASSETS_URL . '/images/agence-bureaux-abidjan.jpg') ?>" alt="Bureaux Wiky Holding Abidjan" class="contact-office-photo" loading="lazy">
                    <div class="contact-office-badge">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <span>Siège & Studios • Abidjan, Côte d'Ivoire</span>
                    </div>
                </div>

                <div class="card contact-details-card">
                    <h3 class="details-title">Nos Bureaux à Abidjan</h3>
                    <p class="details-desc">Nous vous accueillons du lundi au samedi pour échanger autour de votre stratégie de communication.</p>

                    <div class="info-items-list">
                        <div class="info-item">
                            <div class="info-icon">
                                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            </div>
                            <div class="info-text">
                                <strong>Adresse</strong>
                                <span><?= e(COMPANY_ADDRESS) ?></span>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            </div>
                            <div class="info-text">
                                <strong>Téléphone / WhatsApp Pro</strong>
                                <span><?= e(COMPANY_PHONE) ?></span>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            </div>
                            <div class="info-text">
                                <strong>Email Officiel</strong>
                                <span><?= e(COMPANY_EMAIL) ?></span>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            </div>
                            <div class="info-text">
                                <strong>Heures d'Ouverture</strong>
                                <span><?= e(COMPANY_HOURS) ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="whatsapp-direct-box mt-6">
                        <a href="https://wa.me/2250700000000" target="_blank" rel="noopener" class="btn btn--whatsapp btn--full">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.174.086.275.072.376-.043.101-.116.433-.506.549-.68.116-.173.231-.144.39-.086s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/></svg>
                            <span>Discuter instantanément sur WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================== -->
<!-- FAQ RAPIDE                                                     -->
<!-- ============================================================== -->
<section class="section bg-alt">
    <div class="container">
        <div class="section-header">
            <div class="badge">Questions Fréquentes</div>
            <h2 class="section-title">Tout ce que vous devez savoir avant de débuter</h2>
        </div>

        <div class="faq-grid">
            <div class="faq-item card">
                <h4 class="faq-question">Comment s'effectue la gestion des commentaires sur mes pages ?</h4>
                <p class="faq-answer">Nos Community Managers s’imprègnent d’un guide de réponses validé avec vous. Nous répondons avec bienveillance, courtoisie et orientons les prospects vers vos canaux de vente (WhatsApp, téléphone ou boutique physique).</p>
            </div>
            <div class="faq-item card">
                <h4 class="faq-question">Quels sont les délais pour la création d'un logo et charte ?</h4>
                <p class="faq-answer">Comptez en moyenne 5 à 7 jours ouvrés pour les premières propositions vectorielles. Des itérations de retouches sont incluses jusqu'à votre validation complète.</p>
            </div>
            <div class="faq-item card">
                <h4 class="faq-question">Dois-je venir avec mon matériel au Studio Podcast ?</h4>
                <p class="faq-answer">Absolument pas ! Le studio est 100% prêt à l'emploi avec régie 4K, micros professionnels Shure, casque de retour et insonorisation. Venez simplement avec vos idées ou vos invités.</p>
            </div>
            <div class="faq-item card">
                <h4 class="faq-question">Quelles sont les modalités de paiement ?</h4>
                <p class="faq-answer">Nous acceptons les virements bancaires, chèques d’entreprise ainsi que les paiements Mobile Money (Orange Money, Wave, MTN MoMo). Un acompte de 50% valide le démarrage des travaux.</p>
            </div>
        </div>
    </div>
</section>

<?php require dirname(__DIR__) . '/layout/footer.php'; ?>

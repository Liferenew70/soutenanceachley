<?php
/**
 * Layout Footer - Pied de page institutionnel
 */
?>
        </main><!-- /.main-content -->

        <footer class="site-footer">
            <div class="footer-top">
                <div class="container footer-grid">
                    <!-- Colonne 1: Identité de marque -->
                    <div class="footer-col footer-col--brand">
                        <div class="footer-logo">
                            <a href="<?= e(url()) ?>" class="footer-logo-link" aria-label="WIKY HOLDING - Accueil">
                                <img src="<?= e(ASSETS_URL) ?>/images/logo-wiky-holding-white.png" alt="WIKY HOLDING" class="footer-logo-img">
                            </a>
                        </div>
                        <p class="footer-desc">
                            Wiky Holding est votre agence conseil 360° à Abidjan pour la valorisation de votre image de marque, l’animation de vos communautés et la production de contenus audiovisuels percutants en Studio 4K.
                        </p>
                        <div class="footer-socials">
                            <a href="https://facebook.com" target="_blank" rel="noopener" class="social-btn" aria-label="Facebook">
                                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95C18.05 21.45 22 17.19 22 12z"/></svg>
                            </a>
                            <a href="https://instagram.com" target="_blank" rel="noopener" class="social-btn" aria-label="Instagram">
                                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </a>
                            <a href="https://linkedin.com" target="_blank" rel="noopener" class="social-btn" aria-label="LinkedIn">
                                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 8.76c.92 0 1.66-.74 1.66-1.66 0-.91-.74-1.65-1.66-1.65-.92 0-1.66.74-1.66 1.65 0 .92.74 1.66 1.66 1.66m1.39 9.74v-8.37H5.07v8.37h2.78z"/></svg>
                            </a>
                            <a href="https://tiktok.com" target="_blank" rel="noopener" class="social-btn" aria-label="TikTok">
                                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.97v7.54c.01 2.21-.77 4.45-2.26 6.07-1.58 1.74-3.91 2.69-6.28 2.58-2.61-.1-5.02-1.52-6.35-3.76-1.38-2.27-1.42-5.2-.1-7.51 1.27-2.28 3.66-3.77 6.27-3.9v4.06c-1.39.09-2.72.84-3.41 2.05-.68 1.18-.62 2.7.15 3.82.74 1.12 2.07 1.76 3.41 1.67 1.44-.08 2.74-.99 3.23-2.35.21-.56.28-1.15.28-1.75V.02h-4.97z"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Colonne 2: Pôles de compétences -->
                    <div class="footer-col">
                        <h4 class="footer-heading">Nos Services</h4>
                        <ul class="footer-links">
                            <li><a href="<?= e(url('services')) ?>#community-management">Community Management & Modération</a></li>
                            <li><a href="<?= e(url('services')) ?>#branding-logos">Identité Visuelle & Logos</a></li>
                            <li><a href="<?= e(url('podcast')) ?>">Studio Podcast & Audiovisuel</a></li>
                            <li><a href="<?= e(url('services')) ?>#creation-entreprise">Branding & Pack Lancement</a></li>
                            <li><a href="<?= e(url('devis')) ?>">Simulateur de Devis en Ligne</a></li>
                        </ul>
                    </div>

                    <!-- Colonne 3: Navigation rapide -->
                    <div class="footer-col">
                        <h4 class="footer-heading">Liens Utiles</h4>
                        <ul class="footer-links">
                            <li><a href="<?= e(url()) ?>">Accueil</a></li>
                            <li><a href="<?= e(url('about')) ?>">À Propos de Wiky Holding</a></li>
                            <li><a href="<?= e(url('portfolio')) ?>">Nos Réalisations</a></li>
                            <li><a href="<?= e(url('podcast')) ?>">Visiter le Studio</a></li>
                            <li><a href="<?= e(url('contact')) ?>">Nous Contacter</a></li>
                            <li><a href="<?= e(url('admin')) ?>" style="color: rgba(255, 255, 255, 0.45); font-size: 0.85rem;">Espace Administration 🔒</a></li>
                        </ul>
                    </div>

                    <!-- Colonne 4: Coordonnées & Horaires -->
                    <div class="footer-col">
                        <h4 class="footer-heading">Bureaux à Abidjan</h4>
                        <div class="footer-contact-info">
                            <p class="contact-item">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                <span>Abidjan, Cocody Rivera Faya, Côte d’Ivoire</span>
                            </p>
                            <p class="contact-item">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                <span><?= e(COMPANY_PHONE) ?></span>
                            </p>
                            <p class="contact-item">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                <span><?= e(COMPANY_EMAIL) ?></span>
                            </p>
                            <p class="contact-item">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                <span><?= e(COMPANY_HOURS) ?></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="container footer-bottom-flex">
                    <p class="copyright">
                        &copy; <?= date('Y') ?> <strong><?= e(COMPANY_LEGAL) ?></strong>. Tous droits réservés.
                    </p>
                    <p class="footer-meta">
                        Projet Modernisé BTS Informatique Développeur d’Application • Développé en PHP MVP & PDO • <a href="<?= e(url('admin')) ?>" style="color: rgba(255,255,255,0.4); text-decoration: underline;" title="Espace d'administration">Administration 🔒</a>
                    </p>
                </div>
            </div>
        </footer>
    </div><!-- /.site-wrapper -->

    <!-- Bouton flottant remonter en haut sophistiqué avec indicateur circulaire de scroll -->
    <button type="button" class="floating-back-to-top" id="floating-back-to-top" aria-label="Remonter en haut de page" title="Remonter en haut">
        <svg class="progress-ring" width="46" height="46" viewBox="0 0 46 46">
            <circle class="progress-ring__circle-bg" stroke="rgba(255,255,255,0.18)" stroke-width="3" fill="transparent" r="19" cx="23" cy="23" />
            <circle class="progress-ring__circle" id="scroll-progress-circle" stroke="var(--primary-color, #F97316)" stroke-width="3" stroke-linecap="round" fill="transparent" r="19" cx="23" cy="23" />
        </svg>
        <span class="floating-arrow" aria-hidden="true">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="18 15 12 9 6 15"></polyline>
            </svg>
        </span>
    </button>

    <!-- Scripts Javascript optimisés et sans dépendances lourdes -->
    <script src="<?= e(ASSETS_URL) ?>/js/main.js"></script>
</body>
</html>

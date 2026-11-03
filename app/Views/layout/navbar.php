<?php
/**
 * Layout Navbar - Navigation Principale & Tiroir Aside Élite
 */
$currentPage = $currentPage ?? 'home';
?>
<header class="site-header" id="site-header">
    <div class="container header-container">
        <!-- Logo Officiel Wiky Holding (Épuré, sans sous-titre parasite) -->
        <a href="<?= e(url()) ?>" class="brand-logo" aria-label="WIKY HOLDING - Accueil">
            <div class="brand-logo-img-wrap">
                <img src="<?= e(ASSETS_URL) ?>/images/logo-wiky-holding-dark.png" 
                     alt="WIKY HOLDING" 
                     class="brand-logo-img logo--light-mode" 
                     width="150" height="42">
                <img src="<?= e(ASSETS_URL) ?>/images/logo-wiky-holding-white.png" 
                     alt="WIKY HOLDING" 
                     class="brand-logo-img logo--dark-mode" 
                     width="150" height="42">
            </div>
        </a>

        <!-- Liens essentiels desktop (Épurés et aérés) -->
        <nav class="main-nav" id="main-nav" aria-label="Navigation principale">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="<?= e(url()) ?>" class="nav-link <?= $currentPage === 'home' ? 'is-active' : '' ?>">Accueil</a>
                </li>
                <li class="nav-item">
                    <a href="<?= e(url('services')) ?>" class="nav-link <?= $currentPage === 'services' ? 'is-active' : '' ?>">Services</a>
                </li>
                <li class="nav-item">
                    <a href="<?= e(url('portfolio')) ?>" class="nav-link <?= $currentPage === 'portfolio' ? 'is-active' : '' ?>">Réalisations</a>
                </li>
                <li class="nav-item">
                    <a href="<?= e(url('podcast')) ?>" class="nav-link <?= $currentPage === 'podcast' ? 'is-active' : '' ?>">Studio Podcast</a>
                </li>
                <li class="nav-item">
                    <a href="<?= e(url('contact')) ?>" class="nav-link <?= $currentPage === 'contact' ? 'is-active' : '' ?>">Contact</a>
                </li>
            </ul>
        </nav>

        <!-- Actions Droite : Recherche, Bascule Thème, Devis & Bouton Menu Hamburger / Aside -->
        <div class="header-actions">
            <!-- Bouton Recherche Instantanée -->
            <button type="button" class="action-icon-btn" id="search-trigger-btn" aria-label="Ouvrir la recherche" title="Recherche rapide (Ctrl+K)">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </button>

            <!-- Bouton Bascule Rapide Clair / Sombre -->
            <button type="button" class="action-icon-btn" id="theme-toggle-btn" aria-label="Basculer le mode sombre" title="Basculer Mode Clair / Sombre">
                <svg class="icon-sun" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
                <svg class="icon-moon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
            </button>

            <!-- Bouton Palette Avancée -->
            <button type="button" class="action-icon-btn" id="theme-panel-btn" aria-label="Palette de couleurs" title="Personnaliser les couleurs">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="13.5" cy="6.5" r=".5" fill="currentColor"></circle><circle cx="17.5" cy="10.5" r=".5" fill="currentColor"></circle><circle cx="8.5" cy="7.5" r=".5" fill="currentColor"></circle><circle cx="6.5" cy="12.5" r=".5" fill="currentColor"></circle><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z"></path></svg>
            </button>

            <!-- Bouton Devis Gratuit Desktop -->
            <a href="<?= e(url('devis')) ?>" class="btn btn--primary btn--header">
                <span>Devis Gratuit</span>
            </a>

            <!-- Bouton Hamburger / Aside Universel -->
            <button type="button" class="aside-toggle-btn" id="aside-toggle-btn" aria-label="Ouvrir le menu complet" title="Menu complet">
                <span class="aside-toggle-bars" aria-hidden="true">
                    <span class="bar bar-1"></span>
                    <span class="bar bar-2"></span>
                    <span class="bar bar-3"></span>
                </span>
                <span class="aside-toggle-label">Menu</span>
            </button>
        </div>
    </div>
</header>

<!-- ============================================================== -->
<!-- ASIDE DRAWER : Navigation Complète, Découverte & Thème         -->
<!-- ============================================================== -->
<div class="aside-backdrop" id="aside-backdrop" aria-hidden="true">
    <aside class="site-aside" id="site-aside" aria-label="Menu principal complet">
        <div class="aside-header">
            <a href="<?= e(url()) ?>" class="aside-logo" aria-label="WIKY HOLDING - Accueil">
                <img src="<?= e(ASSETS_URL) ?>/images/logo-wiky-holding-dark.png" alt="WIKY HOLDING" class="logo--light-mode" height="34">
                <img src="<?= e(ASSETS_URL) ?>/images/logo-wiky-holding-white.png" alt="WIKY HOLDING" class="logo--dark-mode" height="34">
            </a>
            <button type="button" class="aside-close-btn" id="aside-close-btn" aria-label="Fermer le menu">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <div class="aside-body">
            <!-- Navigation Principale Complète -->
            <div class="aside-nav-section">
                <span class="aside-section-title">Navigation</span>
                <nav class="aside-nav-links">
                    <a href="<?= e(url()) ?>" class="aside-link <?= $currentPage === 'home' ? 'is-active' : '' ?>">
                        <span class="aside-link-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        </span>
                        <span class="aside-link-text">
                            <strong>Accueil</strong>
                            <small>Agence 360° & Studio 4K</small>
                        </span>
                    </a>
                    <a href="<?= e(url('about')) ?>" class="aside-link <?= $currentPage === 'about' ? 'is-active' : '' ?>">
                        <span class="aside-link-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        </span>
                        <span class="aside-link-text">
                            <strong>À Propos de Wiky Holding</strong>
                            <small>Vision, équipe et savoir-faire</small>
                        </span>
                    </a>
                    <a href="<?= e(url('services')) ?>" class="aside-link <?= $currentPage === 'services' ? 'is-active' : '' ?>">
                        <span class="aside-link-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                        </span>
                        <span class="aside-link-text">
                            <strong>Nos Services & Formules</strong>
                            <small>Community management, branding, packs</small>
                        </span>
                    </a>
                    <a href="<?= e(url('portfolio')) ?>" class="aside-link <?= $currentPage === 'portfolio' ? 'is-active' : '' ?>">
                        <span class="aside-link-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        </span>
                        <span class="aside-link-text">
                            <strong>Nos Réalisations</strong>
                            <small>Projets récents & études de cas</small>
                        </span>
                    </a>
                    <a href="<?= e(url('podcast')) ?>" class="aside-link <?= $currentPage === 'podcast' ? 'is-active' : '' ?>">
                        <span class="aside-link-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path><path d="M19 10v2a7 7 0 0 1-14 0v-2"></path><line x1="12" y1="19" x2="12" y2="23"></line><line x1="8" y1="23" x2="16" y2="23"></line></svg>
                        </span>
                        <span class="aside-link-text">
                            <strong>Studio Podcast 4K</strong>
                            <small>Régie & enregistrement broadcast</small>
                        </span>
                    </a>
                    <a href="<?= e(url('contact')) ?>" class="aside-link <?= $currentPage === 'contact' ? 'is-active' : '' ?>">
                        <span class="aside-link-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                        </span>
                        <span class="aside-link-text">
                            <strong>Contact & Accès</strong>
                            <small>Localisation & prise de contact</small>
                        </span>
                    </a>
                    <a href="<?= e(url('admin')) ?>" class="aside-link" style="border: 1px dashed rgba(249, 115, 22, 0.4); background: rgba(249, 115, 22, 0.05); margin-top: 0.5rem;">
                        <span class="aside-link-icon" style="color: var(--primary-color, #F97316);">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        </span>
                        <span class="aside-link-text">
                            <strong style="color: var(--primary-color, #F97316);">Espace Administrateur</strong>
                            <small>Gestion des messages & devis</small>
                        </span>
                    </a>
                </nav>
            </div>

            <!-- Personnalisation Rapide du Thème & Couleurs -->
            <div class="aside-theme-section">
                <span class="aside-section-title">Ambiance & Thème</span>
                <div class="aside-theme-buttons">
                    <button type="button" class="aside-mode-btn" data-set-theme="light">
                        <span class="mode-dot mode-dot--light"></span>
                        <span>Clair</span>
                    </button>
                    <button type="button" class="aside-mode-btn" data-set-theme="dark">
                        <span class="mode-dot mode-dot--dark"></span>
                        <span>Obsidienne</span>
                    </button>
                    <button type="button" class="aside-mode-btn" data-set-theme="navy">
                        <span class="mode-dot mode-dot--navy"></span>
                        <span>Bleu Nuit</span>
                    </button>
                </div>
                <div class="aside-accent-row">
                    <span class="accent-row-label">Accent :</span>
                    <div class="aside-accent-swatches">
                        <button type="button" class="aside-swatch-btn" data-set-accent="orange" style="--swatch-c: #FA4D09;" title="Orange Wiky"></button>
                        <button type="button" class="aside-swatch-btn" data-set-accent="blue" style="--swatch-c: #2563EB;" title="Bleu Royal"></button>
                        <button type="button" class="aside-swatch-btn" data-set-accent="emerald" style="--swatch-c: #10B981;" title="Émeraude"></button>
                        <button type="button" class="aside-swatch-btn" data-set-accent="amber" style="--swatch-c: #F59E0B;" title="Ambre"></button>
                        <button type="button" class="aside-swatch-btn" data-set-accent="rose" style="--swatch-c: #E11D48;" title="Rose"></button>
                    </div>
                </div>
            </div>

            <!-- Coordonnées & Accès direct -->
            <div class="aside-contact-section">
                <span class="aside-section-title">Bureaux à Abidjan</span>
                <div class="aside-contact-box">
                    <p class="aside-contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <span>Abidjan, Cocody Rivera Faya, Côte d’Ivoire</span>
                    </p>
                    <p class="aside-contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        <span><?= e(COMPANY_PHONE) ?></span>
                    </p>
                </div>
                <div class="aside-cta-box">
                    <a href="<?= e(url('devis')) ?>" class="btn btn--primary btn--full">
                        <span>Simulateur de Devis en Ligne</span>
                    </a>
                </div>
            </div>
        </div>
    </aside>
</div>

<!-- ============================================================== -->
<!-- MODAL DE RECHERCHE INSTANTANÉE (Spotlight Search)              -->
<!-- ============================================================== -->
<div class="search-modal-backdrop" id="search-modal" aria-hidden="true">
    <div class="search-modal-card">
        <div class="search-modal-header">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="search-icon">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" id="site-search-input" class="search-modal-input" placeholder="Rechercher un service, réalisation, studio 4K, tarif..." autocomplete="off">
            <button type="button" class="search-modal-close" id="search-close-btn" aria-label="Fermer la recherche">
                <kbd>Échap</kbd>
            </button>
        </div>
        <div class="search-modal-body" id="search-results">
            <div class="search-empty">Commencez à taper pour rechercher dans l'ensemble des services, réalisations et FAQs de Wiky Holding...</div>
        </div>
        <div class="search-modal-footer">
            <span>Suggestions rapides : <strong>logo</strong>, <strong>podcast</strong>, <strong>modération</strong>, <strong>devis</strong></span>
            <span>Wiky Holding • Abidjan</span>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- TIROIR DE PERSONNALISATION : Palette de Couleurs Complète      -->
<!-- ============================================================== -->
<div class="theme-drawer-backdrop" id="theme-drawer" aria-hidden="true">
    <div class="theme-drawer-panel">
        <div class="theme-drawer-header">
            <div class="theme-drawer-title-wrap">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M12 2a10 10 0 0 1 10 10c0 5.52-4.48 10-10 10S2 17.52 2 12A10 10 0 0 1 12 2z"></path>
                    <path d="M12 2v20"></path>
                </svg>
                <h3>Personnalisation du Thème</h3>
            </div>
            <button type="button" class="theme-drawer-close" id="theme-drawer-close" aria-label="Fermer le panneau">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <div class="theme-drawer-body">
            <!-- Bloc 1: Ambiance de fond -->
            <div class="theme-section">
                <label class="theme-label">Ambiance de fond</label>
                <div class="theme-options-grid">
                    <button type="button" class="theme-opt-card" data-set-theme="light">
                        <span class="theme-preview theme-preview--light"></span>
                        <span class="theme-name">Clair</span>
                    </button>
                    <button type="button" class="theme-opt-card" data-set-theme="dark">
                        <span class="theme-preview theme-preview--dark"></span>
                        <span class="theme-name">Obsidienne</span>
                    </button>
                    <button type="button" class="theme-opt-card" data-set-theme="navy">
                        <span class="theme-preview theme-preview--navy"></span>
                        <span class="theme-name">Bleu Nuit</span>
                    </button>
                </div>
            </div>

            <!-- Bloc 2: Couleur d'accentuation -->
            <div class="theme-section">
                <label class="theme-label">Couleur d'accent (Action & Boutons)</label>
                <div class="accent-pills-row">
                    <button type="button" class="accent-pill" data-set-accent="orange" title="Orange Wiky (Signature)">
                        <span class="pill-dot" style="background-color: #FA4D09;"></span>
                        <span>Orange Wiky</span>
                    </button>
                    <button type="button" class="accent-pill" data-set-accent="blue" title="Bleu Royal">
                        <span class="pill-dot" style="background-color: #2563EB;"></span>
                        <span>Bleu Royal</span>
                    </button>
                    <button type="button" class="accent-pill" data-set-accent="emerald" title="Émeraude">
                        <span class="pill-dot" style="background-color: #10B981;"></span>
                        <span>Émeraude</span>
                    </button>
                    <button type="button" class="accent-pill" data-set-accent="amber" title="Or & Ambre">
                        <span class="pill-dot" style="background-color: #F59E0B;"></span>
                        <span>Or & Ambre</span>
                    </button>
                    <button type="button" class="accent-pill" data-set-accent="rose" title="Rose Rubis">
                        <span class="pill-dot" style="background-color: #E11D48;"></span>
                        <span>Rose Rubis</span>
                    </button>
                </div>
            </div>

            <!-- Bloc 3: Sélecteur de couleur libre -->
            <div class="theme-section">
                <label class="theme-label">Couleur libre sur-mesure</label>
                <div class="custom-color-picker-row">
                    <input type="color" id="custom-accent-input" value="#FA4D09" title="Choisir une couleur personnalisée">
                    <input type="text" id="custom-accent-hex" value="#FA4D09" maxlength="7" placeholder="#FA4D09" class="hex-text-input">
                    <button type="button" id="apply-custom-accent-btn" class="btn btn--secondary btn--sm">Appliquer</button>
                </div>
            </div>

            <!-- Pied : Réinitialiser -->
            <div class="theme-drawer-footer">
                <button type="button" id="reset-theme-btn" class="btn btn--outline btn--sm btn--full">
                    <span>Réinitialiser aux valeurs par défaut</span>
                </button>
            </div>
        </div>
    </div>
</div>

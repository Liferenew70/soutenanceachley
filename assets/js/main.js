/**
 * Digital Agency Wiky / Wiky Holding - Script Principal Frontend
 * Système de Thèmes Adaptatifs, Barre de Recherche Instantanée, Bouton Flottant, Tiroir Aside & Simulateur
 */

document.addEventListener('DOMContentLoaded', () => {
    // =============================================================
    // 1. GESTION DU HEADER & DU BOUTON FLOTTANT REMONTER EN HAUT
    // =============================================================
    const header = document.getElementById('site-header');
    const floatingBackToTop = document.getElementById('floating-back-to-top');
    const progressCircle = document.getElementById('scroll-progress-circle');

    // Configuration du cercle de progression (rayon r = 19 => circonférence ~ 119.38)
    const RADIUS = 19;
    const CIRCUMFERENCE = 2 * Math.PI * RADIUS;

    if (progressCircle) {
        progressCircle.style.strokeDasharray = `${CIRCUMFERENCE}`;
        progressCircle.style.strokeDashoffset = `${CIRCUMFERENCE}`;
    }

    const handleScroll = () => {
        const scrollY = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;

        // Sticky Header Elevation
        if (header) {
            if (scrollY > 30) {
                header.classList.add('is-scrolled');
            } else {
                header.classList.remove('is-scrolled');
            }
        }

        // Bouton Flottant Remonter en Haut
        if (floatingBackToTop) {
            if (scrollY > 250) {
                floatingBackToTop.classList.add('is-visible');
            } else {
                floatingBackToTop.classList.remove('is-visible');
            }

            // Calcul du pourcentage de scroll pour la jauge circulaire
            if (progressCircle && docHeight > 0) {
                const scrollProgress = Math.min(Math.max(scrollY / docHeight, 0), 1);
                const offset = CIRCUMFERENCE - (scrollProgress * CIRCUMFERENCE);
                progressCircle.style.strokeDashoffset = `${offset}`;
            }
        }
    };

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();

    if (floatingBackToTop) {
        floatingBackToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // =============================================================
    // 2. MENU HAMBURGER & TIROIR ASIDE (Navigation Latérale Moderne)
    // =============================================================
    const asideToggleBtn = document.getElementById('aside-toggle-btn');
    const asideBackdrop = document.getElementById('aside-backdrop');
    const asideCloseBtn = document.getElementById('aside-close-btn');
    const siteAside = document.getElementById('site-aside');

    const openAside = () => {
        if (!asideBackdrop) return;
        asideBackdrop.classList.add('is-active');
        document.body.classList.add('no-scroll');
    };

    const closeAside = () => {
        if (!asideBackdrop) return;
        asideBackdrop.classList.remove('is-active');
        document.body.classList.remove('no-scroll');
    };

    if (asideToggleBtn) {
        asideToggleBtn.addEventListener('click', openAside);
    }

    if (asideCloseBtn) {
        asideCloseBtn.addEventListener('click', closeAside);
    }

    if (asideBackdrop) {
        asideBackdrop.addEventListener('click', (e) => {
            if (e.target === asideBackdrop) {
                closeAside();
            }
        });

        // Fermer au clic sur un lien du menu aside
        asideBackdrop.querySelectorAll('.aside-link').forEach(link => {
            link.addEventListener('click', closeAside);
        });
    }

    // =============================================================
    // 3. RECHERCHE INSTANTANÉE (Spotlight Search)
    // =============================================================
    const searchTriggerBtn = document.getElementById('search-trigger-btn');
    const searchModal = document.getElementById('search-modal');
    const searchCloseBtn = document.getElementById('search-close-btn');
    const searchInput = document.getElementById('site-search-input') || document.getElementById('spotlight-search-input');
    const searchResults = document.getElementById('search-results');

    // Index de recherche local du site
    const SITE_SEARCH_INDEX = [
        { title: "Accueil", desc: "Agence conseil 360° et holding créative à Abidjan", url: "index.php", tag: "Page" },
        { title: "À Propos de Wiky Holding", desc: "Notre histoire, notre vision, notre équipe et valeurs d'excellence", url: "index.php?page=about", tag: "Page" },
        { title: "Nos Services & Pôles d'expertise", desc: "Community management, identité visuelle, studio podcast, pack lancement", url: "index.php?page=services", tag: "Services" },
        { title: "Community Management & Modération", desc: "Stratégie de contenu, animation des réseaux sociaux et conversion commerciale", url: "index.php?page=services#community-management", tag: "Service" },
        { title: "Création de Logos & Identité Visuelle", desc: "Chartes graphiques complètes, logos vectoriels et supports institutionnels", url: "index.php?page=services#branding-logos", tag: "Service" },
        { title: "Studio Podcast & Vidéo 4K", desc: "Enregistrement d'émissions, plateaux talk-show et régie 4K pro", url: "index.php?page=podcast", tag: "Studio" },
        { title: "Pack Création & Lancement d'Entreprise", desc: "Kit complet pour formaliser et propulser une nouvelle marque à Abidjan", url: "index.php?page=services#creation-entreprise", tag: "Pack" },
        { title: "Nos Réalisations (Portfolio)", desc: "Découvrez nos projets récents en branding, social media et audiovisuel", url: "index.php?page=portfolio", tag: "Portfolio" },
        { title: "Simulateur de Devis en Ligne", desc: "Estimez votre budget sur-mesure en quelques clics sous 24h", url: "index.php?page=devis", tag: "Devis" },
        { title: "Contact & Localisation", desc: "Nos bureaux à Abidjan, Cocody Rivera Faya, coordonnées et WhatsApp", url: "index.php?page=contact", tag: "Contact" },
        { title: "Questions Fréquentes (FAQ)", desc: "Gestion des commentaires, délais graphiques, matériel podcast et paiements", url: "index.php?page=contact", tag: "FAQ" }
    ];

    const openSearch = () => {
        if (!searchModal) return;
        searchModal.classList.add('is-active');
        document.body.classList.add('no-scroll');
        if (searchInput) {
            searchInput.value = '';
            renderSearchResults(SITE_SEARCH_INDEX.slice(0, 6));
            setTimeout(() => searchInput.focus(), 80);
        }
    };

    const closeSearch = () => {
        if (!searchModal) return;
        searchModal.classList.remove('is-active');
        document.body.classList.remove('no-scroll');
    };

    const renderSearchResults = (items) => {
        if (!searchResults) return;
        if (items.length === 0) {
            searchResults.innerHTML = '<div class="search-empty-state">Aucun résultat trouvé pour votre recherche.</div>';
            return;
        }

        const html = items.map(item => `
            <a href="${item.url}" class="search-result-item">
                <div class="search-result-content">
                    <div class="search-result-title">${escapeHTML(item.title)}</div>
                    <div class="search-result-desc">${escapeHTML(item.desc)}</div>
                </div>
                <span class="search-result-badge">${escapeHTML(item.tag)}</span>
            </a>
        `).join('');

        searchResults.innerHTML = `<div class="search-results-list">${html}</div>`;
    };

    const escapeHTML = (str) => {
        return str.replace(/[&<>'"]/g, tag => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            "'": '&#39;',
            '"': '&quot;'
        }[tag] || tag));
    };

    if (searchTriggerBtn) {
        searchTriggerBtn.addEventListener('click', openSearch);
    }

    if (searchCloseBtn) {
        searchCloseBtn.addEventListener('click', closeSearch);
    }

    if (searchModal) {
        searchModal.addEventListener('click', (e) => {
            if (e.target === searchModal) {
                closeSearch();
            }
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.trim().toLowerCase();
            if (!query) {
                renderSearchResults(SITE_SEARCH_INDEX.slice(0, 6));
                return;
            }

            const filtered = SITE_SEARCH_INDEX.filter(item => {
                return item.title.toLowerCase().includes(query) ||
                    item.desc.toLowerCase().includes(query) ||
                    item.tag.toLowerCase().includes(query);
            });

            renderSearchResults(filtered);
        });
    }

    // Raccourci Clavier Universel : Ctrl+K pour ouvrir, Escape pour fermer
    window.addEventListener('keydown', (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
            e.preventDefault();
            if (searchModal && searchModal.classList.contains('is-active')) {
                closeSearch();
            } else {
                openSearch();
            }
        } else if (e.key === 'Escape') {
            if (searchModal && searchModal.classList.contains('is-active')) {
                closeSearch();
            }
            if (themeDrawer && themeDrawer.classList.contains('is-active')) {
                closeThemeDrawer();
            }
            if (asideBackdrop && asideBackdrop.classList.contains('is-active')) {
                closeAside();
            }
        }
    });

    // =============================================================
    // 4. SYSTÈME DE THÈMES ADAPTATIFS & PALETTES D'ACCENTS
    // =============================================================
    const themeToggleBtn = document.getElementById('theme-toggle-btn');
    const themePanelBtn = document.getElementById('theme-panel-btn');
    const themeDrawer = document.getElementById('theme-drawer');
    const themeDrawerClose = document.getElementById('theme-drawer-close');
    const resetThemeBtn = document.getElementById('reset-theme-btn');
    const modeButtons = document.querySelectorAll('[data-set-theme], .theme-mode-btn, .aside-mode-btn');
    const accentSwatches = document.querySelectorAll('[data-set-accent], .accent-swatch, .aside-swatch-btn');
    const customColorPicker = document.getElementById('custom-accent-input') || document.getElementById('custom-color-picker');
    const customColorHex = document.getElementById('custom-accent-hex') || document.getElementById('custom-color-hex');
    const applyCustomAccentBtn = document.getElementById('apply-custom-accent-btn');

    // Application du thème global (light / dark / navy)
    const setThemeMode = (mode) => {
        document.documentElement.setAttribute('data-theme', mode);
        localStorage.setItem('wiky_theme', mode);

        modeButtons.forEach(btn => {
            const btnMode = btn.getAttribute('data-set-theme') || btn.getAttribute('data-mode');
            btn.classList.toggle('is-active', btnMode === mode);
        });
    };

    // Application de la couleur d'accent prédéfinie
    const setAccentColor = (accent) => {
        document.documentElement.setAttribute('data-accent', accent);
        document.documentElement.style.removeProperty('--primary-color');
        document.documentElement.style.removeProperty('--primary-hover');
        document.documentElement.style.removeProperty('--primary-subtle');
        localStorage.setItem('wiky_accent', accent);
        localStorage.removeItem('wiky_custom_color');

        accentSwatches.forEach(swatch => {
            const swatchAccent = swatch.getAttribute('data-set-accent') || swatch.getAttribute('data-accent');
            swatch.classList.toggle('is-active', swatchAccent === accent);
        });
    };

    // Application d'une couleur d'accent libre personnalisée
    const setCustomAccentColor = (hex) => {
        if (!/^#([0-9A-F]{3}){1,2}$/i.test(hex)) return;

        document.documentElement.setAttribute('data-accent', 'custom');
        document.documentElement.style.setProperty('--primary-color', hex);
        document.documentElement.style.setProperty('--primary-hover', hex);
        document.documentElement.style.setProperty('--primary-subtle', hex + '22');

        localStorage.setItem('wiky_accent', 'custom');
        localStorage.setItem('wiky_custom_color', hex);

        accentSwatches.forEach(swatch => swatch.classList.remove('is-active'));
        if (customColorPicker) customColorPicker.value = hex;
        if (customColorHex) customColorHex.value = hex.toUpperCase();
    };

    // Bascule rapide Clair / Sombre
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
            const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';
            setThemeMode(nextTheme);
        });
    }

    // Gestion du tiroir de personnalisation avancée
    const openThemeDrawer = () => {
        if (themeDrawer) themeDrawer.classList.add('is-active');
    };

    const closeThemeDrawer = () => {
        if (themeDrawer) themeDrawer.classList.remove('is-active');
    };

    if (themePanelBtn) {
        themePanelBtn.addEventListener('click', openThemeDrawer);
    }

    if (themeDrawerClose) {
        themeDrawerClose.addEventListener('click', closeThemeDrawer);
    }

    if (themeDrawer) {
        themeDrawer.addEventListener('click', (e) => {
            if (e.target === themeDrawer) {
                closeThemeDrawer();
            }
        });
    }

    // Clic sur les modes (Clair, Sombre, Marine)
    modeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const mode = btn.getAttribute('data-set-theme') || btn.getAttribute('data-mode');
            if (mode) setThemeMode(mode);
        });
    });

    // Clic sur les swatches de palette
    accentSwatches.forEach(swatch => {
        swatch.addEventListener('click', () => {
            const accent = swatch.getAttribute('data-set-accent') || swatch.getAttribute('data-accent');
            if (accent) setAccentColor(accent);
        });
    });

    // Gestion du sélecteur personnalisé
    if (customColorPicker && customColorHex) {
        customColorPicker.addEventListener('input', (e) => {
            customColorHex.value = e.target.value.toUpperCase();
        });

        customColorHex.addEventListener('input', (e) => {
            let val = e.target.value.trim();
            if (!val.startsWith('#')) val = '#' + val;
            if (/^#([0-9A-F]{3}){1,2}$/i.test(val)) {
                customColorPicker.value = val;
            }
        });
    }

    if (applyCustomAccentBtn && customColorPicker) {
        applyCustomAccentBtn.addEventListener('click', () => {
            setCustomAccentColor(customColorPicker.value);
        });
    }

    // Réinitialisation aux réglages d'origine
    if (resetThemeBtn) {
        resetThemeBtn.addEventListener('click', () => {
            setThemeMode('light');
            setAccentColor('orange');
        });
    }

    // Synchronisation de l'état initial des boutons
    const currentActiveTheme = document.documentElement.getAttribute('data-theme') || 'light';
    const currentActiveAccent = document.documentElement.getAttribute('data-accent') || 'orange';

    modeButtons.forEach(btn => {
        const btnMode = btn.getAttribute('data-set-theme') || btn.getAttribute('data-mode');
        btn.classList.toggle('is-active', btnMode === currentActiveTheme);
    });

    accentSwatches.forEach(swatch => {
        const swatchAccent = swatch.getAttribute('data-set-accent') || swatch.getAttribute('data-accent');
        swatch.classList.toggle('is-active', swatchAccent === currentActiveAccent);
    });

    const storedCustomColor = localStorage.getItem('wiky_custom_color') || localStorage.getItem('wiky_custom_accent');
    if (storedCustomColor && currentActiveAccent === 'custom') {
        setCustomAccentColor(storedCustomColor);
    }

    // =============================================================
    // 5. FILTRAGE DYNAMIQUE DU PORTFOLIO
    // =============================================================
    const filterPills = document.querySelectorAll('.portfolio-filter-bar .filter-pill');
    const portfolioCards = document.querySelectorAll('.portfolio-grid .portfolio-card');

    if (filterPills.length > 0 && portfolioCards.length > 0) {
        filterPills.forEach(pill => {
            pill.addEventListener('click', (e) => {
                e.preventDefault();
                const filter = pill.getAttribute('data-filter') || 'all';

                filterPills.forEach(p => p.classList.remove('is-active'));
                pill.classList.add('is-active');

                portfolioCards.forEach(card => {
                    const cardCat = card.getAttribute('data-category');
                    if (filter === 'all' || cardCat === filter) {
                        card.style.display = 'flex';
                        card.style.opacity = '0';
                        setTimeout(() => {
                            card.style.transition = 'opacity 250ms ease-out';
                            card.style.opacity = '1';
                        }, 20);
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    }

    // =============================================================
    // 6. SIMULATEUR DE DEVIS EN TEMPS RÉEL
    // =============================================================
    const calcService = document.getElementById('calc-service');
    const calcScope = document.getElementById('calc-scope');
    const calcSpeed = document.getElementById('calc-speed');
    const calcResult = document.getElementById('calc-result');

    if (calcService && calcScope && calcSpeed && calcResult) {
        const basePrices = {
            'community-management': 150000,
            'branding-logos': 250000,
            'studio-podcast': 80000,
            'creation-entreprise': 450000
        };

        const scopeMultipliers = {
            'starter': 1.0,
            'standard': 1.6,
            'premium': 2.4
        };

        const speedMultipliers = {
            'normal': 1.0,
            'urgent': 1.3
        };

        const updateLiveEstimate = () => {
            const srv = calcService.value;
            const scope = calcScope.value;
            const speed = calcSpeed.value;

            const base = basePrices[srv] || 150000;
            const mScope = scopeMultipliers[scope] || 1.0;
            const mSpeed = speedMultipliers[speed] || 1.0;

            const total = Math.round(base * mScope * mSpeed);
            calcResult.textContent = new Intl.NumberFormat('fr-FR').format(total) + ' FCFA';

            // Animation subtile du chiffre
            calcResult.classList.add('price-updated');
            setTimeout(() => calcResult.classList.remove('price-updated'), 300);
        };

        calcService.addEventListener('change', updateLiveEstimate);
        calcScope.addEventListener('change', updateLiveEstimate);
        calcSpeed.addEventListener('change', updateLiveEstimate);
        updateLiveEstimate();
    }
});

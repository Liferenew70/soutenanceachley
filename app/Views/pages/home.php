<?php
require dirname(__DIR__) . '/layout/header.php';
?>

<!-- ============================================================== -->
<!-- HERO SECTION                                                   -->
<!-- ============================================================== -->
<section class="hero-section">
    <div class="container hero-container">
        <div class="hero-content">
            <div class="badge hero-badge">
                <span class="badge-dot"></span>
                <span>Agence Conseil 360° • Abidjan</span>
            </div>
            <h1 class="hero-title">
                Dominez votre marché avec une <span class="text-gradient">identité percutante</span> & des réseaux qui convertissent.
            </h1>
            <p class="hero-lead">
                Wiky Holding accompagne les marques ambitieuses : Community Management avec modération 7j/7, création de logos vectoriels, production en Studio Podcast 4K et stratégies de lancement d’entreprise.
            </p>
            <div class="hero-actions">
                <a href="<?= e(url('devis')) ?>" class="btn btn--primary btn--lg">
                    <span>Estimer mon projet</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
                <a href="<?= e(url('services')) ?>" class="btn btn--secondary btn--lg">
                    <span>Explorer nos services</span>
                </a>
            </div>
            
            <div class="hero-social-proof">
                <div class="avatar-group">
                    <span class="avatar" style="background-color: #6366F1;">WA</span>
                    <span class="avatar" style="background-color: #EC4899;">CM</span>
                    <span class="avatar" style="background-color: #F59E0B;">DG</span>
                    <span class="avatar" style="background-color: #10B981;">+45</span>
                </div>
                <div class="proof-text">
                    <strong>+45 PME & Dirigeants</strong>
                    <span>nous font confiance en Côte d’Ivoire</span>
                </div>
            </div>
        </div>

        <div class="hero-visual">
            <div class="hero-showcase-container">
                <!-- Image principale réelle du Studio & Production de Wiky Holding -->
                <div class="hero-showcase-main">
                    <img src="<?= e(ASSETS_URL) ?>/images/studio-podcast-abidjan.jpg" 
                         alt="Production Audiovisuelle et Studio Podcast 4K de Wiky Holding à Abidjan" 
                         class="showcase-photo"
                         width="720" height="405" loading="eager">
                    <!-- Logo Central Révélé avec Zoom Fluide -->
                    <div class="showcase-logo-reveal" aria-hidden="true">
                        <div class="reveal-badge">
                            <img src="<?= e(ASSETS_URL) ?>/images/logo-wiky-holding-white.png" alt="Wiky Holding" class="reveal-logo-img">
                        </div>
                    </div>
                </div>

                <!-- Carte flottante 1 : Modération 7j/7 & Réactivité -->
                <div class="hero-kpi-card kpi-card--top">
                    <div class="kpi-icon-wrap kpi-icon--emerald">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </div>
                    <div class="kpi-text">
                        <strong>Modération Réactive 7j/7</strong>
                        <span>Réponses en &lt; 15 minutes</span>
                    </div>
                </div>

                <!-- Carte flottante 2 : Identité & Logos vectoriels -->
                <div class="hero-kpi-card kpi-card--bottom">
                    <div class="kpi-icon-wrap kpi-icon--amber">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                    </div>
                    <div class="kpi-text">
                        <strong>Identité & Logos Vectoriels</strong>
                        <span>Chartes graphiques sur-mesure</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================== -->
<!-- STATS BAR                                                      -->
<!-- ============================================================== -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <?php foreach ($stats as $stat): ?>
                <div class="stat-card">
                    <span class="stat-number"><?= e($stat['number']) ?></span>
                    <span class="stat-label"><?= e($stat['label']) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================================== -->
<!-- NOS SERVICES PHARES                                            -->
<!-- ============================================================== -->
<section class="section services-overview-section">
    <div class="container">
        <div class="section-header">
            <div class="badge">Expertises & Métiers</div>
            <h2 class="section-title">Une offre complète 360° pour faire décoller votre marque</h2>
            <p class="section-lead">De la conception de votre charte jusqu’à l’interaction quotidienne avec vos abonnés, nos experts synchronisés vous accompagnent à chaque étape.</p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4">
            <?php foreach ($services as $srv): ?>
                <div class="card service-card">
                    <?php if (!empty($srv['badge'])): ?>
                        <span class="service-pill"><?= e($srv['badge']) ?></span>
                    <?php endif; ?>
                    <div class="service-icon-box">
                        <?php if ($srv['icon'] === 'message-circle'): ?>
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                        <?php elseif ($srv['icon'] === 'feather'): ?>
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path><line x1="16" y1="8" x2="2" y2="22"></line><line x1="17.5" y1="15" x2="9" y2="15"></line></svg>
                        <?php elseif ($srv['icon'] === 'mic'): ?>
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path><path d="M19 10v2a7 7 0 0 1-14 0v-2"></path><line x1="12" y1="19" x2="12" y2="23"></line><line x1="8" y1="23" x2="16" y2="23"></line></svg>
                        <?php else: ?>
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                        <?php endif; ?>
                    </div>
                    <h3 class="service-title"><?= e($srv['title']) ?></h3>
                    <p class="service-desc"><?= e($srv['short_desc']) ?></p>
                    <div class="service-pricing-tag"><?= e($srv['pricing']) ?></div>
                    <a href="<?= e(url('services')) ?>#<?= e($srv['id']) ?>" class="service-link">
                        <span>En savoir plus</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-12">
            <a href="<?= e(url('services')) ?>" class="btn btn--outline">
                <span>Consulter tous les détails des prestations</span>
            </a>
        </div>
    </div>
</section>

<!-- ============================================================== -->
<!-- PORTFOLIO APERÇU                                               -->
<!-- ============================================================== -->
<section class="section portfolio-preview-section bg-alt">
    <div class="container">
        <div class="section-header">
            <div class="badge">Études de Cas</div>
            <h2 class="section-title">Quelques réalisations récentes</h2>
            <p class="section-lead">Découvrez comment nos visuels, nos stratégies et nos enregistrements propulsent la notoriété de nos clients partenaires.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3">
            <?php foreach ($portfolioItems as $item): ?>
                <article class="card portfolio-card">
                    <div class="portfolio-thumb">
                        <div class="portfolio-category-badge"><?= e($item['category_name']) ?></div>
                        <?php if (!empty($item['image'])): ?>
                            <img src="<?= e(ASSETS_URL . '/' . $item['image']) ?>" 
                                 alt="<?= e($item['title']) ?> • <?= e($item['client']) ?>" 
                                 class="portfolio-thumb-img" 
                                 width="640" height="400" loading="lazy">
                            <div class="portfolio-thumb-overlay">
                                <span class="mockup-client"><?= e($item['client']) ?></span>
                            </div>
                        <?php else: ?>
                            <div class="portfolio-mockup-visual bg-grad-<?= e($item['category']) ?>">
                                <span class="mockup-client"><?= e($item['client']) ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="portfolio-body">
                        <h3 class="portfolio-title"><?= e($item['title']) ?></h3>
                        <p class="portfolio-desc"><?= e($item['description']) ?></p>
                        <div class="portfolio-result">
                            <span class="result-label">Résultat obtenu :</span>
                            <span class="result-text"><?= e($item['results']) ?></span>
                        </div>
                        <div class="portfolio-tags">
                            <?php foreach ($item['tags'] as $tag): ?>
                                <span class="tag"><?= e($tag) ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="portfolio-action-wrap">
            <a href="<?= e(url('portfolio')) ?>" class="btn btn--primary btn--lg">
                <span>Voir tout le portfolio</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
        </div>
    </div>
</section>

<!-- ============================================================== -->
<!-- NOTRE MÉTHODOLOGIE EN 4 ÉTAPES                                 -->
<!-- ============================================================== -->
<section class="section workflow-section">
    <div class="container">
        <div class="section-header">
            <div class="badge">Rigueur & Processus</div>
            <h2 class="section-title">Une méthode cadrée, sans mauvaise surprise</h2>
            <p class="section-lead">Issu de notre organisation d’agence, chaque projet passe par un protocole précis piloté par notre Chargée de Projets.</p>
        </div>

        <div class="workflow-steps">
            <div class="workflow-step">
                <div class="step-number">01</div>
                <h4 class="step-title">Diagnostic & Brief</h4>
                <p class="step-text">Écoute attentive de vos besoins, analyse de votre marché et cadrage du cahier des charges précis.</p>
            </div>
            <div class="workflow-step">
                <div class="step-number">02</div>
                <h4 class="step-title">Création & Direction</h4>
                <p class="step-text">Recherche graphique, élaboration des concepts, scénarios de podcasts ou planning de publication.</p>
            </div>
            <div class="workflow-step">
                <div class="step-number">03</div>
                <h4 class="step-title">Production & Répétition</h4>
                <p class="step-text">Tournage en studio, création des visuels HD, modération des réseaux sociaux et paramétrage des ads.</p>
            </div>
            <div class="workflow-step">
                <div class="step-number">04</div>
                <h4 class="step-title">Validation & Reporting</h4>
                <p class="step-text">Vérification de conformité, remise des livrables et tableau de bord des retombées générées.</p>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================== -->
<!-- TÉMOIGNAGES                                                    -->
<!-- ============================================================== -->
<section class="section testimonials-section bg-alt">
    <div class="container">
        <div class="section-header">
            <div class="badge">Avis Clients</div>
            <h2 class="section-title">Ils ont choisi Wiky Holding</h2>
            <p class="section-lead">Découvrez les retours de nos clients partenaires qui ont transformé leur image et développé leur clientèle avec nous.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3">
            <?php foreach ($testimonials as $t): ?>
                <div class="card testimonial-card">
                    <div class="testimonial-stars" aria-label="<?= e($t['rating']) ?> sur 5 étoiles">
                        <?= str_repeat('★', $t['rating']) ?>
                    </div>
                    <blockquote class="testimonial-quote">
                        « <?= e($t['text']) ?> »
                    </blockquote>
                    <div class="testimonial-author">
                        <div class="author-avatar"><?= substr(e($t['name']), 0, 1) ?></div>
                        <div class="author-info">
                            <strong><?= e($t['name']) ?></strong>
                            <span><?= e($t['role']) ?> • <?= e($t['company']) ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================================== -->
<!-- BANNIÈRE CTA DE FIN DE PAGE                                    -->
<!-- ============================================================== -->
<section class="cta-banner-section">
    <div class="container">
        <div class="cta-banner">
            <div class="cta-text">
                <h2 class="cta-title">Prêt à transformer votre présence digitale ?</h2>
                <p class="cta-lead">Échangeons dès aujourd’hui sur vos ambitions. Obtenez une estimation claire et chiffrée sous 24 heures.</p>
            </div>
            <div class="cta-buttons">
                <a href="<?= e(url('devis')) ?>" class="btn btn--cta-quote btn--lg">
                    <span>Demander un devis personnalisé</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
                <a href="<?= e(url('contact')) ?>" class="btn btn--outline-white btn--lg">
                    <span>Prendre rendez-vous</span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php require dirname(__DIR__) . '/layout/footer.php'; ?>

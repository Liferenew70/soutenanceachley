<?php
require dirname(__DIR__) . '/layout/header.php';
?>

<!-- ============================================================== -->
<!-- ABOUT HERO                                                     -->
<!-- ============================================================== -->
<section class="page-hero">
    <div class="container text-center">
        <div class="badge">Notre Histoire & Valeurs</div>
        <h1 class="page-title">L’agence créative au service de la croissance des entreprises</h1>
        <p class="page-lead max-w-reading">
            Wiky Holding est née d’une ambition simple : doter les entreprises, PME et créateurs d’Abidjan d’une communication visuelle et digitale à la hauteur des plus grands standards internationaux.
        </p>
    </div>
</section>

<!-- ============================================================== -->
<!-- PRÉSENTATION DE L'AGENCE                                       -->
<!-- ============================================================== -->
<section class="section">
    <div class="container">
        <div class="about-story-grid">
            <div class="story-content">
                <span class="badge">Wiky Holding en quelques mots</span>
                <h2 class="section-title">Une vision 360° pour amplifier votre impact</h2>
                <p>
                    Basée à Abidjan, <strong>Wiky Holding</strong> est une agence conseil 360° agile et moderne réunissant l’ensemble des corps de métiers de la communication contemporaine : stratégie de marque, community management réactif, graphisme de haut vol et production audiovisuelle en studio dédié.
                </p>
                <p>
                    Face à l'évolution rapide des usages numériques en Côte d'Ivoire et dans la sous-région, nous avons fait le choix de la rigueur : chaque projet est piloté de bout en bout par un chargé de projets dédié, garantissant ainsi un respect strict des délais et une fluidité permanente avec vos équipes.
                </p>
                <div class="story-highlights">
                    <div class="highlight-item">
                        <span class="highlight-num">100%</span>
                        <span class="highlight-label">Accompagnement personnalisé</span>
                    </div>
                    <div class="highlight-item">
                        <span class="highlight-num">7j/7</span>
                        <span class="highlight-label">Veille & modération des réseaux</span>
                    </div>
                    <div class="highlight-item">
                        <span class="highlight-num">4K</span>
                        <span class="highlight-label">Studio podcast & captation pro</span>
                    </div>
                </div>
            </div>

            <div class="story-card">
                <div class="about-founder-preview">
                    <img src="<?= e(ASSETS_URL . '/images/fondateur-wiky.jpg') ?>" alt="Direction Wiky Holding Abidjan" class="about-founder-img" loading="lazy">
                    <div class="about-founder-badge">Direction Générale & Associés • Wiky Holding Abidjan</div>
                </div>
                <div class="card about-manifesto-card">
                    <div class="manifesto-header">
                        <span class="manifesto-tag">Notre Mission</span>
                        <h3 class="manifesto-title">« Optimisez votre visibilité, gagnez en impact »</h3>
                    </div>
                    <p class="manifesto-text">
                        Nous croyons fermement qu'une entreprise sans communication moderne est comme un moteur sans carburant. Notre engagement est de concevoir des identités qui marquent les esprits, d'engager vos communautés avec empathie et de transformer chaque visiteur en client fidèle.
                    </p>
                    <div class="manifesto-footer">
                        <div class="signature-name">La Direction Générale</div>
                        <div class="signature-role">Wiky Holding • Abidjan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================== -->
<!-- LES 4 PÔLES OPÉRATIONNELS (ISSUS DU RAPPORT DE SOUTENANCE)    -->
<!-- ============================================================== -->
<section class="section bg-alt">
    <div class="container">
        <div class="section-header">
            <div class="badge">Organisation Interne</div>
            <h2 class="section-title">Les 4 Pôles d’Excellence de Wiky Holding</h2>
            <p class="section-lead">Une structure claire où chaque département collabore en synergie pour garantir des livrables de haute précision.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2">
            <?php foreach ($poles as $index => $pole): ?>
                <div class="card pole-card">
                    <div class="pole-header">
                        <div class="pole-number">0<?= $index + 1 ?></div>
                        <div class="pole-icon">
                            <?php if ($pole['icon'] === 'briefcase'): ?>
                                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                            <?php elseif ($pole['icon'] === 'message-square'): ?>
                                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                            <?php elseif ($pole['icon'] === 'palette'): ?>
                                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="13.5" cy="6.5" r=".5"></circle><circle cx="17.5" cy="10.5" r=".5"></circle><circle cx="8.5" cy="7.5" r=".5"></circle><circle cx="6.5" cy="12.5" r=".5"></circle><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.563-2.512 5.563-5.563C21.437 6.352 17.218 2 12 2z"></path></svg>
                            <?php else: ?>
                                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                            <?php endif; ?>
                        </div>
                    </div>
                    <h3 class="pole-title"><?= e($pole['title']) ?></h3>
                    <p class="pole-desc"><?= e($pole['description']) ?></p>
                    <div class="pole-team">
                        <span class="team-label">Équipe mobilisée :</span>
                        <span class="team-badge"><?= e($pole['team']) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================================== -->
<!-- VALEURS DE L'ENTREPRISE                                        -->
<!-- ============================================================== -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <div class="badge">ADN & Principes</div>
            <h2 class="section-title">Les valeurs qui guident notre action quotidienne</h2>
            <p class="section-lead">Chez Wiky Holding, nous défendons une approche éthique, performante et humaine du conseil en communication.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
            <?php foreach ($values as $val): ?>
                <div class="card value-card">
                    <div class="value-check">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                    <h3 class="value-title"><?= e($val['title']) ?></h3>
                    <p class="value-desc"><?= e($val['desc']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================================== -->
<!-- CTA                                                            -->
<!-- ============================================================== -->
<section class="cta-banner-section">
    <div class="container">
        <div class="cta-banner">
            <div class="cta-text">
                <h2 class="cta-title">Travaillons ensemble sur votre prochain palier de croissance</h2>
                <p class="cta-lead">Venez visiter nos locaux à Abidjan ou programmez un échange visio avec nos spécialistes.</p>
            </div>
            <div class="cta-buttons">
                <a href="<?= e(url('contact')) ?>" class="btn btn--white btn--lg">
                    <span>Rencontrer l’équipe Wiky</span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php require dirname(__DIR__) . '/layout/footer.php'; ?>

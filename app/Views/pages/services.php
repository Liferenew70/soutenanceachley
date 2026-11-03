<?php
require dirname(__DIR__) . '/layout/header.php';
?>

<!-- ============================================================== -->
<!-- SERVICES HERO                                                  -->
<!-- ============================================================== -->
<section class="page-hero">
    <div class="container text-center">
        <div class="badge">Solutions Stratégiques & Créatives</div>
        <h1 class="page-title">Nos Prestations & Formules d’Accompagnement</h1>
        <p class="page-lead max-w-reading">
            Des services calibrés pour bâtir une notoriété durable, générer des prospects qualifiés et transformer vos réseaux sociaux en véritables canaux de vente.
        </p>
    </div>
</section>

<!-- ============================================================== -->
<!-- DÉTAIL DES SERVICES                                            -->
<!-- ============================================================== -->
<section class="section">
    <div class="container">
        <div class="services-detailed-list">
            <?php foreach ($services as $index => $srv): ?>
                <div class="card service-detail-item <?= $index % 2 === 1 ? 'service-detail-item--reverse' : '' ?>" id="<?= e($srv['id']) ?>">
                    <div class="service-detail-content">
                        <div class="service-detail-meta">
                            <span class="badge"><?= e($srv['category']) ?></span>
                            <?php if (!empty($srv['badge'])): ?>
                                <span class="service-pill"><?= e($srv['badge']) ?></span>
                            <?php endif; ?>
                        </div>
                        <h2 class="service-detail-title"><?= e($srv['title']) ?></h2>
                        <p class="service-detail-desc"><?= e($srv['short_desc']) ?></p>

                        <div class="service-features-list">
                            <h4 class="features-heading">Ce qui est inclus dans cette prestation :</h4>
                            <ul>
                                <?php foreach ($srv['features'] as $feat): ?>
                                    <li>
                                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" class="check-icon"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        <span><?= e($feat) ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="service-detail-action">
                            <div class="service-price-block">
                                <span class="price-label">Tarif indicatif :</span>
                                <span class="price-value"><?= e($srv['pricing']) ?></span>
                            </div>
                            <a href="<?= e(url('devis')) ?>?service=<?= e($srv['id']) ?>" class="btn btn--primary">
                                <span>Demander ce service</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </a>
                        </div>
                    </div>

                    <div class="service-detail-media">
                        <div class="service-media-card">
                            <?php if (!empty($srv['image'])): ?>
                                <img src="<?= e(ASSETS_URL . '/' . $srv['image']) ?>" alt="<?= e($srv['title']) ?>" class="service-media-photo" loading="lazy">
                                <div class="service-media-photo-overlay">
                                    <span class="media-badge">Expertise Wiky Holding</span>
                                    <span class="media-title"><?= e($srv['title']) ?></span>
                                </div>
                            <?php else: ?>
                                <div class="service-media-fallback bg-grad-<?= e($srv['id']) ?>">
                                    <span class="media-title"><?= e($srv['title']) ?></span>
                                    <span class="media-badge">Expertise Wiky Holding 360°</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================================== -->
<!-- PACKS TARIFAIRES                                               -->
<!-- ============================================================== -->
<section class="section bg-alt">
    <div class="container">
        <div class="section-header">
            <div class="badge">Formules Clés en Main</div>
            <h2 class="section-title">Nos Packs d’Accompagnement Recommandés</h2>
            <p class="section-lead">Des forfaits transparents pensés pour accélérer votre développement sans frais cachés.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3">
            <?php foreach ($packs as $pack): ?>
                <div class="card pricing-card <?= $pack['popular'] ? 'pricing-card--popular' : '' ?>">
                    <?php if ($pack['popular']): ?>
                        <div class="popular-ribbon">Recommandé</div>
                    <?php endif; ?>
                    <h3 class="pack-name"><?= e($pack['name']) ?></h3>
                    <p class="pack-target"><?= e($pack['target']) ?></p>
                    <div class="pack-price"><?= e($pack['price']) ?></div>

                    <ul class="pack-features">
                        <?php foreach ($pack['features'] as $f): ?>
                            <li>
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span><?= e($f) ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="pack-action">
                        <a href="<?= e(url('devis')) ?>" class="btn <?= $pack['popular'] ? 'btn--primary' : 'btn--outline' ?> btn--full">
                            <span>Choisir cette formule</span>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require dirname(__DIR__) . '/layout/footer.php'; ?>

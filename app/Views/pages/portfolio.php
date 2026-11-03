<?php
require dirname(__DIR__) . '/layout/header.php';
?>

<!-- ============================================================== -->
<!-- PORTFOLIO HERO                                                 -->
<!-- ============================================================== -->
<section class="page-hero">
    <div class="container text-center">
        <div class="badge">Portfolio & Cas Pratiques</div>
        <h1 class="page-title">Nos Réalisations Récentes</h1>
        <p class="page-lead max-w-reading">
            Chaque marque a une histoire unique à raconter. Explorez notre sélection de projets menés avec passion pour des entreprises de tous secteurs à Abidjan et en Afrique.
        </p>

        <!-- Filtres par catégorie -->
        <div class="portfolio-filter-bar">
            <?php foreach ($categories as $key => $name): ?>
                <a href="<?= e(url('portfolio')) ?>?category=<?= e($key) ?>" 
                   class="filter-pill <?= $category === $key ? 'is-active' : '' ?>"
                   data-filter="<?= e($key) ?>">
                    <?= e($name) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================================== -->
<!-- GRILLE DU PORTFOLIO                                            -->
<!-- ============================================================== -->
<section class="section">
    <div class="container">
        <?php if (empty($projects)): ?>
            <div class="text-center py-12">
                <p class="lead">Aucun projet trouvé dans cette catégorie pour le moment.</p>
                <a href="<?= e(url('portfolio')) ?>" class="btn btn--outline mt-4">Afficher tous les projets</a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 portfolio-grid">
                <?php foreach ($projects as $item): ?>
                    <article class="card portfolio-card" data-category="<?= e($item['category']) ?>">
                        <div class="portfolio-thumb">
                            <div class="portfolio-category-badge"><?= e($item['category_name']) ?></div>
                            <?php if (!empty($item['image'])): ?>
                                <img src="<?= e(ASSETS_URL . '/' . $item['image']) ?>" 
                                     alt="<?= e($item['title']) ?> • <?= e($item['client']) ?>" 
                                     class="portfolio-thumb-img" 
                                     width="640" height="400" loading="lazy">
                                <div class="portfolio-thumb-overlay">
                                    <span class="mockup-client"><?= e($item['client']) ?></span>
                                    <span class="mockup-year"><?= e($item['date']) ?></span>
                                </div>
                            <?php else: ?>
                                <div class="portfolio-mockup-visual bg-grad-<?= e($item['category']) ?>">
                                    <div class="visual-inner">
                                        <span class="mockup-client"><?= e($item['client']) ?></span>
                                        <span class="mockup-year"><?= e($item['date']) ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="portfolio-body">
                            <h3 class="portfolio-title"><?= e($item['title']) ?></h3>
                            <p class="portfolio-desc"><?= e($item['description']) ?></p>
                            
                            <div class="portfolio-result">
                                <span class="result-label">Impact mesuré :</span>
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
        <?php endif; ?>
    </div>
</section>

<!-- ============================================================== -->
<!-- BANNIÈRE PROJET SUR-MESURE                                     -->
<!-- ============================================================== -->
<section class="cta-banner-section">
    <div class="container">
        <div class="cta-banner">
            <div class="cta-text">
                <h2 class="cta-title">Vous souhaitez une réalisation similaire pour votre marque ?</h2>
                <p class="cta-lead">Présentez-nous vos objectifs et voyons comment propulser votre visibilité dès ce mois-ci.</p>
            </div>
            <div class="cta-buttons">
                <a href="<?= e(url('devis')) ?>" class="btn btn--white btn--lg">
                    <span>Lancer mon projet</span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php require dirname(__DIR__) . '/layout/footer.php'; ?>

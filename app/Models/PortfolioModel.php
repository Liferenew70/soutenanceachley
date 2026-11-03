<?php
namespace App\Models;

class PortfolioModel
{
    /**
     * Retourne les réalisations phares de l'agence Wiky
     */
    public static function getAll(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Identité Visuelle & Charte de Marque',
                'client' => 'Aura Cosmétiques Naturels',
                'category' => 'branding',
                'category_name' => 'Branding & Logo',
                'image' => 'images/portfolio-aura-cosmetiques.jpg',
                'date' => '2025',
                'description' => 'Refonte globale de l’image de marque : logotype épuré, déclinaisons packaging éco-responsables et gabarits de présentation premium.',
                'results' => '+140% d’attractivité perçue et sélection immédiate en grande distribution.',
                'tags' => ['Logo Vectoriel', 'Packaging', 'Charte Graphique', 'Abidjan']
            ],
            [
                'id' => 2,
                'title' => 'Gestion de Communauté & Modération 24/7',
                'client' => 'Le Grand Palais - Événementiel',
                'category' => 'community',
                'category_name' => 'Community Management',
                'image' => 'images/service-gestion-reseaux-sociaux.jpg',
                'date' => '2025',
                'description' => 'Gestion active de plus de 45.000 abonnés, réponse aux questions et commentaires en moins de 15 minutes, et stratégie de conversion.',
                'results' => '+230% de taux d’engagement et 180+ réservations directes via messagerie.',
                'tags' => ['Modération', 'Instagram Ads', 'Copywriting', 'Relations Clients']
            ],
            [
                'id' => 3,
                'title' => 'Production Podcast « Décideurs d’Ivoire »',
                'client' => 'Club Afrique Entreprise',
                'category' => 'podcast',
                'category_name' => 'Studio Podcast',
                'image' => 'images/podcast-tv-show.jpg',
                'date' => '2024 - 2025',
                'description' => 'Enregistrement de 12 épisodes en studio insonorisé avec régie multi-caméras 4K, montage audio haute fidélité et déclinaisons TikTok/Reels.',
                'results' => '120.000+ écoutes cumulées et positionné dans le Top 5 podcasts Business CI.',
                'tags' => ['Captation 4K', 'Audio Broadcast', 'Shorts/Reels', 'Idéation Épisodes']
            ],
            [
                'id' => 4,
                'title' => 'Pack Lancement & Identité Complète',
                'client' => 'IvoiroTech - Logiciel de Paie',
                'category' => 'startup',
                'category_name' => 'Création d’Entreprise',
                'image' => 'images/portfolio-ivoirotech-b2b.jpg',
                'date' => '2025',
                'description' => 'Accompagnement de zéro pour le lancement d’une startup technologique : naming, logo, supports investisseurs et stratégie des réseaux sociaux.',
                'results' => 'Levée de fonds d’amorçage réussie et acquisition des 25 premiers clients PME.',
                'tags' => ['Naming', 'Plaquette Commerciale', 'Stratégie Acquisition', 'B2B']
            ],
            [
                'id' => 5,
                'title' => 'Campagne Publicitaire & Social Ads',
                'client' => 'Bâtir & Confort Immobilier',
                'category' => 'community',
                'category_name' => 'Community Management',
                'image' => 'images/portfolio-batir-immobilier.jpg',
                'date' => '2025',
                'description' => 'Animation éditoriale ciblée et gestion des campagnes Meta Ads pour la commercialisation d’un programme résidentiel de standing.',
                'results' => '320 leads ultra-qualifiés générés en 45 jours avec un coût par prospect réduit de 40%.',
                'tags' => ['Meta Ads', 'Social Media', 'Génération de Leads', 'Immobilier']
            ],
            [
                'id' => 6,
                'title' => 'Série de Vidéos Capsules & Voix Off',
                'client' => 'Clinique Médicale Saint-Joseph',
                'category' => 'podcast',
                'category_name' => 'Audiovisuel & Voix Off',
                'image' => 'images/portfolio-clinique-sante.jpg',
                'date' => '2024',
                'description' => 'Scénarisation, tournage et enregistrement de voix off institutionnelle pour sensibiliser les patients aux nouveaux services de télémédecine.',
                'results' => '98% de satisfaction patients et diffusion sur les écrans d’accueil et réseaux sociaux.',
                'tags' => ['Voix Off Pro', 'Capsules Vidéos', 'Direction Artistique', 'Santé']
            ]
        ];
    }

    /**
     * Filtre les réalisations par catégorie
     */
    public static function getByCategory(string $category): array
    {
        $all = self::getAll();
        if ($category === 'all' || empty($category)) {
            return $all;
        }
        return array_filter($all, fn($item) => $item['category'] === $category);
    }
}

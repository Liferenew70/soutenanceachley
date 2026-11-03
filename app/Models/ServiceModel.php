<?php
namespace App\Models;

class ServiceModel
{
    /**
     * Retourne la liste exhaustive des prestations de Wiky Holding
     */
    public static function getAll(): array
    {
        return [
            [
                'id' => 'community-management',
                'title' => 'Community Management & Modération Active',
                'category' => 'Réseaux Sociaux',
                'badge' => 'Essentiel Visibilité',
                'image' => 'images/service-communication-digitale.jpg',
                'short_desc' => 'Gestion de votre image sociale, animation quotidienne, modération des avis et réponse chirurgicale aux commentaires 7j/7.',
                'icon' => 'message-circle',
                'features' => [
                    'Stratégie éditoriale multi-plateformes (Facebook, Instagram, LinkedIn, TikTok)',
                    'Réponse et modération en temps réel des commentaires & messages privés',
                    'Copywriting persuasif et rédaction des scripts de publications',
                    'Gestion optimisée des campagnes publicitaires (Meta Ads & Google Ads)',
                    'Rapport mensuel détaillé de performance, portée et taux d’engagement'
                ],
                'pricing' => 'À partir de 150.000 FCFA / mois',
                'popular' => true
            ],
            [
                'id' => 'branding-logos',
                'title' => 'Identité Visuelle & Conception de Logos',
                'category' => 'Design Graphique',
                'badge' => 'Impact Visuel',
                'image' => 'images/service-branding-image-marque.jpg',
                'short_desc' => 'Création de logos distinctifs, chartes graphiques complètes et déclinaisons visuelles mémorables qui imposent votre autorité.',
                'icon' => 'feather',
                'features' => [
                    'Conception de logo vectoriel unique avec déclinaisons complètes (formats HD/SVG/Print)',
                    'Charte graphique complète (palette chromatique, règles typographiques, moodboard)',
                    'Déclinaisons papeterie : cartes de visite, en-têtes, chemises de présentation',
                    'Kit visuel pour réseaux sociaux (bannières, gabarits de posts, templates de stories)',
                    'Fichiers sources 100% vectoriels et cession totale des droits d’exploitation'
                ],
                'pricing' => 'À partir de 250.000 FCFA',
                'popular' => false
            ],
            [
                'id' => 'studio-podcast',
                'title' => 'Studio Podcast & Production Audiovisuelle',
                'category' => 'Média & Audio',
                'badge' => 'Studio Professionnel',
                'image' => 'images/studio-podcast-abidjan.jpg',
                'short_desc' => 'Studio insonorisé et équipé à Abidjan pour tournages de podcasts, capsules vidéo d’entreprise, interviews et voix off de haut standing.',
                'icon' => 'mic',
                'features' => [
                    'Studio équipé à Abidjan : micros broadcast Shure, caméras 4K, régie et éclairage multi-angles',
                    'Idéation éditoriale et accompagnement sur les thématiques d’émissions d’entreprise',
                    'Captation sonore et vidéo avec direction artistique et ingénieur du son',
                    'Montage complet avec titrage dynamique, colorimétrie, sous-titrage et jingles',
                    'Découpage en capsules courtes (Reels, TikTok, Shorts) prêtes pour la diffusion virale'
                ],
                'pricing' => 'À partir de 80.000 FCFA / session',
                'popular' => true
            ],
            [
                'id' => 'creation-entreprise',
                'title' => 'Branding d’Entreprise & Pack Lancement',
                'category' => 'Stratégie & Conseil',
                'badge' => 'Pack Entrepreneur',
                'image' => 'images/visibilite-acquisition-digitale.jpg',
                'short_desc' => 'Accompagnement stratégique 360° pour nouvelles entreprises : positionnement, naming, création de marque et kit de démarrage commercial.',
                'icon' => 'compass',
                'features' => [
                    'Diagnostic de positionnement stratégique et analyse concurrentielle',
                    'Naming, slogan de marque (baseline) et storytelling d’entreprise',
                    'Création du pack de marque initial (logo, supports commerciaux, plaquette)',
                    'Mise en place de la stratégie d’acquisition digitale des 90 premiers jours',
                    'Session de coaching privé avec les experts de Wiky Holding'
                ],
                'pricing' => 'Pack clé en main à partir de 450.000 FCFA',
                'popular' => false
            ]
        ];
    }

    /**
     * Recherche un service par son identifiant unique
     */
    public static function getById(string $id): ?array
    {
        $services = self::getAll();
        foreach ($services as $service) {
            if ($service['id'] === $id) {
                return $service;
            }
        }
        return null;
    }
}

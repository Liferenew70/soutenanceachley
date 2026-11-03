<?php
namespace App\Controllers;

use App\Models\ServiceModel;

class ServiceController
{
    public function index(): void
    {
        $services = ServiceModel::getAll();

        $packs = [
            [
                'name' => 'Pack Starter Visibilité',
                'price' => '150.000 FCFA / mois',
                'target' => 'Pour PME, artisans et créateurs qui démarrent',
                'features' => [
                    'Animation de 2 réseaux sociaux (Instagram & Facebook)',
                    '12 publications visuelles professionnelles / mois',
                    'Modération et réponses aux commentaires du lundi au samedi',
                    'Rapport mensuel de visibilité et d’engagement'
                ],
                'popular' => false
            ],
            [
                'name' => 'Pack Identité & Autorité de Marque',
                'price' => '350.000 FCFA',
                'target' => 'Pour entreprises voulant imposer un positionnement haut de gamme',
                'features' => [
                    'Création de Logo vectoriel complet (3 propositions initiales)',
                    'Charte graphique détaillée (typographies, couleurs, déclinaisons)',
                    'Cartes de visite, en-têtes et kit de bannières digitales',
                    'Cession légale de 100% des droits de propriété'
                ],
                'popular' => true
            ],
            [
                'name' => 'Pack Studio Podcast & Vidéo 360°',
                'price' => '550.000 FCFA / saison',
                'target' => 'Pour dirigeants, conférenciers et marques influentes',
                'features' => [
                    '4 sessions d’enregistrement au studio insonorisé Wiky',
                    'Prise de son pro Shure + régie 3 caméras 4K',
                    'Montage complet + titrage dynamique + étalonnage',
                    '8 capsules Reels/TikTok optimisées pour la viralité'
                ],
                'popular' => false
            ]
        ];

        $pageTitle = "Nos Services • Community Management, Branding, Studio Podcast & Stratégie";
        $currentPage = 'services';

        require dirname(__DIR__) . '/Views/pages/services.php';
    }
}

<?php
namespace App\Controllers;

class PodcastController
{
    public function index(): void
    {
        $equipment = [
            [
                'name' => 'Micros Broadcast Shure SM7B',
                'desc' => 'Le standard mondial des studios radio pour une voix chaude, ronde et sans bruits parasites.'
            ],
            [
                'name' => 'Régie & Caméras Sony 4K Cinéma',
                'desc' => '3 angles de vue synchronisés avec capteurs plein format pour un rendu visuel digne des plateaux télévisés.'
            ],
            [
                'name' => 'Éclairage Multi-Sources Godox & Softbox',
                'desc' => 'Lumière diffuse, contre-jour coloré et ambiance personnalisable aux couleurs de votre marque.'
            ],
            [
                'name' => 'Traitement Acoustique & Cabine Insonorisée',
                'desc' => 'Panneaux absorbants professionnels garantissant zéro réverbération et une clarté vocale absolue.'
            ]
        ];

        $suggestedTopics = [
            [
                'title' => 'Storytelling de Dirigeant & Parcours d’Échec/Succès',
                'format' => 'Interview 45 min',
                'target' => 'Idéal pour asseoir le personal branding d’un CEO ou fondateur.',
                'capsules' => '3 Shorts / TikTok percutants extraits de l’échange'
            ],
            [
                'title' => 'Décryptage d’Experts & Cas Clients PME',
                'format' => 'Table ronde 30 min',
                'target' => 'Pour les cabinets de conseil, experts-comptables et banques/fintechs.',
                'capsules' => '2 résumés clés pour LinkedIn et newsletter'
            ],
            [
                'title' => 'Culture d’Entreprise & Marque Employeur',
                'format' => 'Format immersif 20 min',
                'target' => 'Pour attirer les meilleurs talents et valoriser vos collaborateurs internes.',
                'capsules' => 'Vidéo récapitulative pour la page Carrières'
            ]
        ];

        $pageTitle = "Studio Podcast & Audiovisuel Pro à Abidjan • Wiky Holding";
        $currentPage = 'podcast';

        require dirname(__DIR__) . '/Views/pages/podcast.php';
    }
}

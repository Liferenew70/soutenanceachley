<?php
namespace App\Controllers;

use App\Models\ServiceModel;
use App\Models\PortfolioModel;

class HomeController
{
    public function index(): void
    {
        $services = array_slice(ServiceModel::getAll(), 0, 4);
        $portfolioItems = array_slice(PortfolioModel::getAll(), 0, 3);

        $stats = [
            ['number' => '45+', 'label' => 'Entreprises & Marques Accompagnées'],
            ['number' => '250+', 'label' => 'Logos & Visuels Conçus'],
            ['number' => '1.2M+', 'label' => 'Interactions Réseaux Sociaux Générées'],
            ['number' => '85+', 'label' => 'Épisodes de Podcasts & Vidéos Produits'],
        ];

        $testimonials = [
            [
                'name' => 'Koffi Fabrice',
                'role' => 'Directeur Général',
                'company' => 'Aura Cosmétiques',
                'text' => 'Wiky Holding a complètement métamorphosé notre image de marque. Du logo jusqu’au packaging, le professionnalisme de l’équipe a permis à nos produits d’intégrer les plus grandes pharmacies d’Abidjan.',
                'rating' => 5
            ],
            [
                'name' => 'Sarah Bamba',
                'role' => 'Fondatrice & CEO',
                'company' => 'Bâtir & Confort',
                'text' => 'La réactivité de leur équipe de Community Management est impressionnante : chaque commentaire est répondu avec tact et courtoisie, ce qui a boosté nos conversions immobilières en un temps record.',
                'rating' => 5
            ],
            [
                'name' => 'Dr. Cédric Yao',
                'role' => 'Animateur Podcast',
                'company' => 'Club Décideurs CI',
                'text' => 'Leur studio podcast à Abidjan est un véritable bijou : insonorisation parfaite, caméras haute définition, et un montage vidéo dynamique adapté à nos formats Reels et TikTok. Bravo Wiky !',
                'rating' => 5
            ]
        ];

        $pageTitle = "Accueil • Wiky Holding • Agence Conseil 360°, Branding & Studio Podcast";
        $currentPage = 'home';

        require dirname(__DIR__) . '/Views/pages/home.php';
    }
}

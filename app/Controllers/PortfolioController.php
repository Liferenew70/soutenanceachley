<?php
namespace App\Controllers;

use App\Models\PortfolioModel;

class PortfolioController
{
    public function index(): void
    {
        $category = $_GET['category'] ?? 'all';
        $projects = PortfolioModel::getByCategory($category);

        $categories = [
            'all' => 'Tous les projets',
            'branding' => 'Logos & Identité Visuelle',
            'community' => 'Community Management & Ads',
            'podcast' => 'Studio Podcast & Vidéo',
            'startup' => 'Création d’Entreprise'
        ];

        $pageTitle = "Réalisations & Portfolio • Wiky Holding";
        $currentPage = 'portfolio';

        require dirname(__DIR__) . '/Views/pages/portfolio.php';
    }
}

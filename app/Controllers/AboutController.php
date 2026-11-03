<?php
namespace App\Controllers;

class AboutController
{
    public function index(): void
    {
        $poles = [
            [
                'title' => 'Direction & Gestion de Projets',
                'description' => 'Coordination globale, relation client privilégiée, cadrage des objectifs commerciaux et validation de la conformité de chaque livrable avant livraison.',
                'icon' => 'briefcase',
                'team' => 'Directeur Général & Chargée de Projets'
            ],
            [
                'title' => 'Pôle Communication Digitale',
                'description' => 'Animation quotidienne des communautés, rédaction persuasive de contenus, modération des commentaires et pilotage des campagnes sponsorisées.',
                'icon' => 'message-square',
                'team' => '2 Community Managers Spécialisés'
            ],
            [
                'title' => 'Pôle Graphisme & Identité Visuelle',
                'description' => 'Création de logos percutants, direction artistique sur-mesure, chartes graphiques de référence et visuels marketing haute définition.',
                'icon' => 'palette',
                'team' => 'Infographe Titulaire & Assistant'
            ],
            [
                'title' => 'Pôle Audiovisuel & Studio Podcast',
                'description' => 'Captation vidéo 4K, enregistrement sonore broadcast, montage dynamique, voix off professionnelle et découpage de capsules courtes pour les réseaux.',
                'icon' => 'video',
                'team' => 'Vidéaste / Photographe & Voix Off'
            ]
        ];

        $values = [
            [
                'title' => 'Excellence & Créativité',
                'desc' => 'Chaque projet est traité comme une pièce d’art stratégique, sans compromis sur la finesse visuelle.'
            ],
            [
                'title' => 'Réactivité Chirurgicale',
                'desc' => 'Prise en charge rapide de vos demandes et modération continue pour préserver l’image de marque de nos clients.'
            ],
            [
                'title' => 'Transparence & Rigueur',
                'desc' => 'Calendriers respectés, livrables certifiés conformes et reporting chiffré régulier sur vos performances.'
            ],
            [
                'title' => 'Impact Mesurable',
                'desc' => 'Nous ne cherchons pas seulement l’esthétique : nous construisons des leviers concrets de conversion et de notoriété.'
            ]
        ];

        $pageTitle = "À Propos • Notre Histoire, Vision & Équipe | Wiky Holding";
        $currentPage = 'about';

        require dirname(__DIR__) . '/Views/pages/about.php';
    }
}

# 🌐 Wiky Holding (Digital Agency Wiky) — Application Web d'Entreprise

> **Projet de fin de cycle pour la soutenance du Brevet de Technicien Supérieur (BTS)**  
> **Filière :** Informatique Développeur d’Application (IDA)  
> **Session :** 2025 - 2026  
> **Auteure :** KOUAME AFFOUE CYNTICHE ACHLEY DELMAS  
> **Établissement :** École Supérieure des Nouvelles Technologies de l’Information et du Management (ES2I Plateau)  
> **Entreprise d'accueil :** Digital Agency Wiky (Wiky Holding - Abidjan, Côte d'Ivoire)

---

## 🔗 Liens Rapides & Accès Officiels

- 🚀 **Site Web en Production (InfinityFree) :** [https://bts2k25achley.xo.je/](https://bts2k25achley.xo.je/)
- 🔐 **Espace d'Administration :** [https://bts2k25achley.xo.je/admin](https://bts2k25achley.xo.je/admin)
- 📦 **Dépôt Public GitHub :** [https://github.com/Liferenew70/soutenanceachley.git](https://github.com/Liferenew70/soutenanceachley.git)
- 📑 **Livrables de Soutenance (Dossier `DOCSrapport/`) :**
  - [Rapport de Stage Complet (PDF)](DOCSrapport/RAPPORT_DE_STAGE_WIKY_HOLDING%204.pdf)
  - [Rapport de Stage Editable (Word DOCX)](DOCSrapport/RAPPORT_DE_STAGE_WIKY_HOLDING%204.docx)
  - [Guide de Préparation à la Soutenance Orale (PDF)](DOCSrapport/LEARNING%20soutenance/GUIDE_SOUTENANCE_WIKY_HOLDING.pdf)

---

## 🌟 Présentation de l'Entreprise

**Digital Agency Wiky** est une agence 360° de communication digitale et de production multimédia située à Abidjan. Elle articule son activité autour de 4 pôles majeurs :
1. **Community Management & Modération :** Stratégie de contenu, animation 7j/7, réponses aux commentaires et campagnes publicitaires Meta Ads.
2. **Identité Visuelle & Graphisme :** Création de logos vectoriels, chartes graphiques complètes, supports print et digitaux.
3. **Studio Podcast & Production Audiovisuelle :** Plateau insonorisé équipé à Abidjan, captation vidéo 4K, micros de diffusion, montage de capsules virales (Reels, TikTok, Shorts).
4. **Stratégie & Conseil d'Entreprise :** Naming de marques, business modeling et accompagnement stratégique.

---

## 🛠️ Spécifications & Architecture Logicielle

- **Patron d'Architecture :** Architecture MVC (Modèle - Vue - Contrôleur) stricte sans framework tiers lourd, maximisant légèreté, performances et sécurité.
- **Backend Serveur :** PHP 8.2+ Orienté Objet (compatible 8.2, 8.3 et 8.4) avec typage strict et gestion granulaire des exceptions.
- **Accès aux Données :** PHP Data Objects (PDO) avec requêtes préparées systématiques contre les injections SQL.
- **Base de Données :** MySQL 8.0+ / MariaDB avec moteur relationnel transactionnel InnoDB et clés étrangères configurées en cascade/restrict.
- **Modélisation Formelle MERISE :**
  - Dictionnaire des Données normalisé avec identifiants primaires rigoureusement uniques (`num_prospect`, `code_service`, `mat_admin`, `num_message`, `num_devis`).
  - Graphe des Dépendances Fonctionnelles (GDF) et Structure d'Accès Théorique (S.A.T).
  - Modèle Conceptuel de Données (MCD) et Modèle Logique de Données Relationnel (MLDr) validé en **3ème Forme Normale (3FN)**.
- **Sécurité Web Avancée :**
  - Protection CSRF avec jetons cryptographiques à durée de vie limitée (`hash_hmac`).
  - Neutralisation des failles XSS par échappement strict `htmlspecialchars(ENT_QUOTES, 'UTF-8')`.
  - Hachage cryptographique des mots de passe administrateurs via `password_hash(PASSWORD_BCRYPT)`.
  - En-têtes HTTP de sécurité (`X-Frame-Options`, `X-Content-Type-Options`, `X-XSS-Protection`).
- **Frontend & Expérience Utilisateur :**
  - HTML5 sémantique et Vanilla CSS3 structuré (Design Tokens, variables HSL, fluid typography `clamp()`, mode responsive optimisé mobile/tablette/desktop).
  - JavaScript ES6 modulaire pour les animations au défilement, le filtrage dynamique du portfolio et le simulateur de devis en direct (FCFA).

---

## 📁 Structure du Projet

```text
├── app/
│   ├── Config/
│   │   ├── App.php             # Constantes d'environnement, configuration des routes
│   │   └── Database.php        # Source unique de connexion PDO MySQL (Local / Cloud)
│   ├── Controllers/            # Contrôleurs MVC (logique applicative)
│   │   ├── HomeController.php
│   │   ├── AboutController.php
│   │   ├── ServiceController.php
│   │   ├── PortfolioController.php
│   │   ├── PodcastController.php
│   │   ├── ContactController.php
│   │   ├── DevisController.php
│   │   └── AdminController.php
│   ├── Models/                 # Modèles MVC et requêtes préparées PDO
│   │   ├── ContactModel.php
│   │   ├── DevisModel.php
│   │   ├── ServiceModel.php
│   │   └── AdminModel.php
│   └── Views/                  # Vues HTML et gabarits modulaires
│       ├── layout/             # Structure globale (Header, Navbar, Footer)
│       ├── pages/              # Pages publiques (Accueil, Services, Contact, Devis...)
│       └── admin/              # Espace d'administration sécurisé
├── assets/
│   ├── css/style.css           # Système de design responsive
│   ├── js/main.js              # Interactivité, modal, simulateur de devis temps réel
│   ├── js/admin.js             # Gestion du Back-Office et sélections groupées
│   └── images/                 # Visuels, réalisations et captures
├── DOCSrapport/                # Livrables officiels de soutenance
│   ├── RAPPORT_DE_STAGE_WIKY_HOLDING 4.pdf
│   ├── RAPPORT_DE_STAGE_WIKY_HOLDING 4.docx
│   └── LEARNING soutenance/    # Support de préparation pour la soutenance orale
├── database.sql                # Schéma exporté et structure complète de la base MySQL
├── sdldirecte.sql              # Script SQL idempotent de réinitialisation directe
├── index.php                   # Contrôleur frontal (Front Controller)
├── .htaccess                   # Réécriture d'URL Apache et en-têtes sécurisés
└── README.md                   # Documentation technique officielle
```

---

## 💻 Installation & Déploiement

### Option 1 : Exécution en Local avec WampServer / XAMPP

1. Copier le dossier du projet dans le répertoire web :
   - Pour WampServer : `C:\wamp64\www\achelyrapport`
   - Pour XAMPP : `C:\xampp\htdocs\achelyrapport`
2. Démarrer les services Apache et MySQL.
3. Ouvrir phpMyAdmin (`http://localhost/phpmyadmin`) et créer une base de données nommée `wiky_db` avec l'interclassement `utf8mb4_unicode_ci`.
4. Importer le fichier `database.sql` (ou exécuter les requêtes de `sdldirecte.sql`).
5. Accéder au site web dans votre navigateur :  
   `http://localhost/achelyrapport/`

### Option 2 : Déploiement en Production Cloud (InfinityFree)

1. Créer un compte d'hébergement sur [InfinityFree](https://app.infinityfree.com).
2. Créer une base MySQL dans le cPanel et importer `database.sql`.
3. Renseigner les identifiants de connexion dans `app/Config/Database.php` :
   ```php
   public const DB_HOST = 'sqlxxx.infinityfree.com';
   public const DB_NAME = 'if0_xxxxxxx_wikydb';
   public const DB_USER = 'if0_xxxxxxx';
   public const DB_PASS = 'votre_mot_de_passe';
   ```
4. Transférer les fichiers via FTP dans le répertoire racine `htdocs/`.
5. Le site est opérationnel sous protocole HTTPS à l'adresse configurée.

---

## 👤 Auteure & Droits d'Utilisation

- **Étudiante :** KOUAME AFFOUE CYNTICHE ACHLEY DELMAS
- **Formation :** BTS IDA (Informatique Développeur d’Application)
- **Promotion :** 2025 - 2026
- **Supervision :** Digital Agency Wiky & ES2I Plateau (Abidjan)

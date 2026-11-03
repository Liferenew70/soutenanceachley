-- ==============================================================
-- FICHIER SQL DIRECT : WIKY HOLDING / DIGITAL AGENCY WIKY
-- Nom du fichier : sdldirecte.sql
-- Description    : Script polyvalent et idempotent pour phpMyAdmin
-- Normalisation  : Codifications canoniques MERISE (Zéro 'id' isolé)
--                  • mat_admin (Administrateurs)
--                  • num_prospect (Prospects)
--                  • code_service (Services & Prestations)
--                  • num_message (Messages reçus)
--                  • num_devis (Demandes de devis)
-- Moteur         : InnoDB (Support ACID & Contraintes FOREIGN KEY)
-- Jeu carac.     : utf8mb4 / utf8mb4_unicode_ci
-- ==============================================================

SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

-- --------------------------------------------------------------
-- Réinitialisation propre (Permet de vider/recréer sans conflit)
-- --------------------------------------------------------------
DROP TABLE IF EXISTS `devis_requests`;
DROP TABLE IF EXISTS `messages`;
DROP TABLE IF EXISTS `prospects`;
DROP TABLE IF EXISTS `services`;
DROP TABLE IF EXISTS `admins`;

-- --------------------------------------------------------------
-- Table 1 : SERVICES (Catalogue des prestations répertoriées)
-- Codification PK : code_service (Code mnémonique unique)
-- --------------------------------------------------------------
CREATE TABLE `services` (
  `code_service` VARCHAR(50) NOT NULL,
  `lib_service` VARCHAR(100) NOT NULL,
  `desc_service` TEXT DEFAULT NULL,
  `tarif_base` INT DEFAULT 0,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`code_service`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------------
-- Table 2 : PROSPECTS (Personnes et entreprises clientes)
-- Codification PK : num_prospect (Numéro séquentiel auto-incrémenté)
-- --------------------------------------------------------------
CREATE TABLE `prospects` (
  `num_prospect` INT NOT NULL AUTO_INCREMENT,
  `nom_prospect` VARCHAR(120) NOT NULL,
  `email_prospect` VARCHAR(150) NOT NULL UNIQUE,
  `tel_prospect` VARCHAR(50) DEFAULT NULL,
  `entreprise_prospect` VARCHAR(150) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`num_prospect`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------------
-- Table 3 : ADMINS (Comptes d'accès des gestionnaires internes)
-- Codification PK : mat_admin (Matricule de l'administrateur)
-- --------------------------------------------------------------
CREATE TABLE `admins` (
  `mat_admin` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(60) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL,
  `name` VARCHAR(120) DEFAULT 'Administrateur',
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mat_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------------
-- Table 4 : MESSAGES (Flux transactionnel des messages de contact)
-- Codification PK : num_message
-- Clés étrangères  : num_prospect, code_service, mat_admin
-- --------------------------------------------------------------
CREATE TABLE `messages` (
  `num_message` INT NOT NULL AUTO_INCREMENT,
  `num_prospect` INT DEFAULT NULL,
  `code_service` VARCHAR(50) DEFAULT NULL,
  `mat_admin` INT DEFAULT NULL,
  `name` VARCHAR(120) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `phone` VARCHAR(50) DEFAULT NULL,
  `service` VARCHAR(100) DEFAULT 'Général',
  `subject` VARCHAR(200) DEFAULT NULL,
  `message` TEXT NOT NULL,
  `status` VARCHAR(30) NOT NULL DEFAULT 'nouveau',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`num_message`),
  KEY `idx_msg_prospect` (`num_prospect`),
  KEY `idx_msg_service` (`code_service`),
  KEY `idx_msg_admin` (`mat_admin`),
  CONSTRAINT `fk_messages_prospect` FOREIGN KEY (`num_prospect`) REFERENCES `prospects` (`num_prospect`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_messages_service` FOREIGN KEY (`code_service`) REFERENCES `services` (`code_service`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_messages_admin` FOREIGN KEY (`mat_admin`) REFERENCES `admins` (`mat_admin`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------------
-- Table 5 : DEVIS_REQUESTS (Documents formels de demande de devis)
-- Codification PK : num_devis
-- Clés étrangères  : num_prospect, code_service, mat_admin
-- --------------------------------------------------------------
CREATE TABLE `devis_requests` (
  `num_devis` INT NOT NULL AUTO_INCREMENT,
  `num_prospect` INT DEFAULT NULL,
  `code_service` VARCHAR(50) DEFAULT NULL,
  `mat_admin` INT DEFAULT NULL,
  `company_name` VARCHAR(150) NOT NULL,
  `contact_name` VARCHAR(120) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `phone` VARCHAR(50) NOT NULL,
  `service_type` VARCHAR(100) NOT NULL,
  `budget_range` VARCHAR(50) DEFAULT 'Non précisé',
  `urgency` VARCHAR(50) DEFAULT 'Normal (2-3 semaines)',
  `project_details` TEXT NOT NULL,
  `status` VARCHAR(30) NOT NULL DEFAULT 'en_attente',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`num_devis`),
  KEY `idx_devis_prospect` (`num_prospect`),
  KEY `idx_devis_service` (`code_service`),
  KEY `idx_devis_admin` (`mat_admin`),
  CONSTRAINT `fk_devis_prospect` FOREIGN KEY (`num_prospect`) REFERENCES `prospects` (`num_prospect`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_devis_service` FOREIGN KEY (`code_service`) REFERENCES `services` (`code_service`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_devis_admin` FOREIGN KEY (`mat_admin`) REFERENCES `admins` (`mat_admin`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET foreign_key_checks = 1;

-- --------------------------------------------------------------
-- DONNÉES INITIALES : 5 Services officiels de Wiky Holding
-- --------------------------------------------------------------
INSERT INTO `services` (`code_service`, `lib_service`, `desc_service`, `tarif_base`) VALUES
('cm', 'Community Management & Social Media', 'Animation de communautés, stratégie de contenu et modération 7j/7', 150000),
('branding', 'Branding & Identité Visuelle', 'Création de logos vectoriels, chartes graphiques et déclinaisons supports', 250000),
('podcast', 'Studio Podcast & Médias Audiovisuels', 'Enregistrement vidéo 4K multicam, mixage sonore et distribution', 200000),
('entreprise', 'Création d Entreprise & Stratégie', 'Assistance juridique, formalisation et stratégie de pénétration marché', 300000),
('conseil', 'Conseil Digital & Stratégie 360', 'Audit de communication digitale et feuille de route opérationnelle', 100000)
ON DUPLICATE KEY UPDATE `lib_service` = VALUES(`lib_service`), `desc_service` = VALUES(`desc_service`), `tarif_base` = VALUES(`tarif_base`);

-- --------------------------------------------------------------
-- DONNÉES INITIALES : Compte Administrateur par défaut
-- Identifiant  : admin
-- Mot de passe : admin123 (Empreinte BCRYPT PHP 8 standard)
-- --------------------------------------------------------------
INSERT INTO `admins` (`mat_admin`, `username`, `password_hash`, `name`, `updated_at`) VALUES
(1, 'admin', '$2y$10$fYDkj9La/KS4kCgd4NcztemxH6Sb8dhnBrjLLWUaYPncRMaXAKGsi', 'Administrateur Principal', NOW())
ON DUPLICATE KEY UPDATE `password_hash` = VALUES(`password_hash`);

-- --------------------------------------------------------------
-- DONNÉES INITIALES : Prospects d'exemple
-- --------------------------------------------------------------
INSERT INTO `prospects` (`num_prospect`, `nom_prospect`, `email_prospect`, `tel_prospect`, `entreprise_prospect`) VALUES
(1, 'Jean-Marc Koffi', 'koffi.jm@example.ci', '+225 07 12 34 56', 'Société Ivoirienne de Cosmétiques'),
(2, 'Aïssata Traoré', 'aissata@ivoiretech.ci', '+225 05 98 76 54', 'Ivoire Tech Solutions')
ON DUPLICATE KEY UPDATE `nom_prospect` = VALUES(`nom_prospect`);

-- --------------------------------------------------------------
-- DONNÉES INITIALES : Messages reçus
-- --------------------------------------------------------------
INSERT INTO `messages` (`num_message`, `num_prospect`, `code_service`, `mat_admin`, `name`, `email`, `phone`, `service`, `subject`, `message`, `status`, `created_at`) VALUES
(1, 1, 'cm', 1, 'Jean-Marc Koffi', 'koffi.jm@example.ci', '+225 07 12 34 56', 'Community Management', 'Accompagnement marque cosmétique', 'Bonjour, nous souhaitons déléguer la gestion de nos réseaux sociaux Instagram et Facebook avec modération de commentaires 7j/7.', 'nouveau', NOW())
ON DUPLICATE KEY UPDATE `subject` = VALUES(`subject`);

-- --------------------------------------------------------------
-- DONNÉES INITIALES : Demande de devis
-- --------------------------------------------------------------
INSERT INTO `devis_requests` (`num_devis`, `num_prospect`, `code_service`, `mat_admin`, `company_name`, `contact_name`, `email`, `phone`, `service_type`, `budget_range`, `urgency`, `project_details`, `status`, `created_at`) VALUES
(1, 2, 'branding', 1, 'Ivoire Tech Solutions', 'Aïssata Traoré', 'aissata@ivoiretech.ci', '+225 05 98 76 54', 'Branding & Identité Visuelle', '500.000 - 1.000.000 FCFA', 'Urgent (< 1 semaine)', 'Création complète de la charte graphique, du logo vectoriel et des déclinaisons pour lancement officiel de notre fintech.', 'en_attente', NOW())
ON DUPLICATE KEY UPDATE `company_name` = VALUES(`company_name`);

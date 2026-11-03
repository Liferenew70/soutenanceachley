<?php
namespace App\Models;

use App\Config\Database;
use PDO;
use Exception;

class ContactModel
{
    /**
     * Enregistre un message de contact dans la base de données
     */
    public static function save(array $data): bool
    {
        try {
            $pdo = Database::getConnection();

            // Résolution relationnelle : Prospect
            $prospectId = null;
            if (!empty($data['email'])) {
                try {
                    $pStmt = $pdo->prepare("SELECT num_prospect FROM prospects WHERE email_prospect = :e LIMIT 1");
                    $pStmt->execute([':e' => $data['email']]);
                    $pRow = $pStmt->fetch(PDO::FETCH_ASSOC);
                    if ($pRow) {
                        $prospectId = (int)$pRow['num_prospect'];
                    } else {
                        $ins = $pdo->prepare("
                            INSERT INTO prospects (nom_prospect, email_prospect, tel_prospect, entreprise_prospect)
                            VALUES (:nom, :email, :tel, :entr)
                            ON DUPLICATE KEY UPDATE num_prospect = LAST_INSERT_ID(num_prospect)
                        ");
                        $ins->execute([
                            ':nom'   => $data['name'] ?? 'Contact',
                            ':email' => $data['email'],
                            ':tel'   => $data['phone'] ?? null,
                            ':entr'  => $data['company'] ?? null,
                        ]);
                        $prospectId = (int)$pdo->lastInsertId();
                    }
                } catch (Exception $e) {
                    $pStmt = $pdo->prepare("SELECT id FROM prospects WHERE email_prospect = :e LIMIT 1");
                    $pStmt->execute([':e' => $data['email']]);
                    $pRow = $pStmt->fetch(PDO::FETCH_ASSOC);
                    if ($pRow) {
                        $prospectId = (int)$pRow['id'];
                    } else {
                        $ins = $pdo->prepare("
                            INSERT INTO prospects (nom_prospect, email_prospect, tel_prospect, entreprise_prospect)
                            VALUES (:nom, :email, :tel, :entr)
                            ON DUPLICATE KEY UPDATE id = LAST_INSERT_ID(id)
                        ");
                        $ins->execute([
                            ':nom'   => $data['name'] ?? 'Contact',
                            ':email' => $data['email'],
                            ':tel'   => $data['phone'] ?? null,
                            ':entr'  => $data['company'] ?? null,
                        ]);
                        $prospectId = (int)$pdo->lastInsertId();
                    }
                }
            }

            // Résolution du service
            $codeService = 'cm';
            $serviceTerm = strtolower($data['service'] ?? '');
            if (strpos($serviceTerm, 'brand') !== false || strpos($serviceTerm, 'logo') !== false) {
                $codeService = 'branding';
            } elseif (strpos($serviceTerm, 'pod') !== false || strpos($serviceTerm, 'audio') !== false) {
                $codeService = 'podcast';
            } elseif (strpos($serviceTerm, 'entr') !== false || strpos($serviceTerm, 'strat') !== false) {
                $codeService = 'entreprise';
            } elseif (strpos($serviceTerm, 'cons') !== false) {
                $codeService = 'conseil';
            }

            // Insertion dans messages avec support num_message / num_prospect / code_service / mat_admin
            try {
                $stmt = $pdo->prepare("
                    INSERT INTO messages (num_prospect, code_service, mat_admin, name, email, phone, service, subject, message, status, created_at)
                    VALUES (:prospect_id, :service_code, 1, :name, :email, :phone, :service, :subject, :message, :status, NOW())
                ");
                return $stmt->execute([
                    ':prospect_id'  => $prospectId,
                    ':service_code' => $codeService,
                    ':name'         => $data['name'],
                    ':email'        => $data['email'],
                    ':phone'        => $data['phone'] ?? null,
                    ':service'      => $data['service'] ?? 'Général',
                    ':subject'      => $data['subject'] ?? 'Demande de contact',
                    ':message'      => $data['message'],
                    ':status'       => $data['status'] ?? 'nouveau',
                ]);
            } catch (Exception $e) {
                $stmt = $pdo->prepare("
                    INSERT INTO messages (prospect_id, service_id, admin_id, name, email, phone, service, subject, message, status, created_at)
                    VALUES (:prospect_id, 1, 1, :name, :email, :phone, :service, :subject, :message, :status, NOW())
                ");
                return $stmt->execute([
                    ':prospect_id' => $prospectId,
                    ':name'        => $data['name'],
                    ':email'       => $data['email'],
                    ':phone'       => $data['phone'] ?? null,
                    ':service'     => $data['service'] ?? 'Général',
                    ':subject'     => $data['subject'] ?? 'Demande de contact',
                    ':message'     => $data['message'],
                    ':status'      => $data['status'] ?? 'nouveau',
                ]);
            }
        } catch (Exception $e) {
            error_log("Erreur ContactModel::save : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Récupère tous les messages avec filtres optionnels
     */
    public static function getAll(?string $search = null, ?string $status = null): array
    {
        try {
            $pdo = Database::getConnection();
            $params = [];
            $where = " WHERE 1=1";

            if (!empty($search)) {
                $where .= " AND (name LIKE :search OR email LIKE :search OR phone LIKE :search OR subject LIKE :search OR message LIKE :search)";
                $params[':search'] = '%' . $search . '%';
            }

            if (!empty($status) && $status !== 'all') {
                $where .= " AND status = :status";
                $params[':status'] = $status;
            }

            try {
                $sql = "SELECT m.*, m.num_message AS id FROM messages m" . $where . " ORDER BY m.num_message DESC";
                $stmt = $pdo->prepare($sql);
                $stmt->execute($params);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                $sql = "SELECT * FROM messages" . $where . " ORDER BY id DESC";
                $stmt = $pdo->prepare($sql);
                $stmt->execute($params);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            error_log("Erreur ContactModel::getAll : " . $e->getMessage());
            return [];
        }
    }

    /**
     * Récupère un message par son identifiant unique
     */
    public static function getById(int $id): ?array
    {
        try {
            $pdo = Database::getConnection();
            try {
                $stmt = $pdo->prepare("SELECT m.*, m.num_message AS id FROM messages m WHERE m.num_message = :id LIMIT 1");
                $stmt->execute([':id' => $id]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($res) {
                    return $res;
                }
            } catch (Exception $e) {
                $stmt = $pdo->prepare("SELECT * FROM messages WHERE id = :id LIMIT 1");
                $stmt->execute([':id' => $id]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($res) {
                    $res['num_message'] = $res['id'];
                    return $res;
                }
            }
            return null;
        } catch (Exception $e) {
            error_log("Erreur ContactModel::getById : " . $e->getMessage());
            return null;
        }
    }

    /**
     * Met à jour un message
     */
    public static function update(int $id, array $data): bool
    {
        try {
            $pdo = Database::getConnection();
            try {
                $stmt = $pdo->prepare("
                    UPDATE messages 
                    SET name = :name,
                        email = :email,
                        phone = :phone,
                        service = :service,
                        subject = :subject,
                        message = :message,
                        status = :status
                    WHERE num_message = :id
                ");
                return $stmt->execute([
                    ':id'      => $id,
                    ':name'    => $data['name'],
                    ':email'   => $data['email'],
                    ':phone'   => $data['phone'] ?? null,
                    ':service' => $data['service'] ?? 'Général',
                    ':subject' => $data['subject'] ?? 'Demande de contact',
                    ':message' => $data['message'],
                    ':status'  => $data['status'] ?? 'nouveau',
                ]);
            } catch (Exception $e) {
                $stmt = $pdo->prepare("
                    UPDATE messages 
                    SET name = :name,
                        email = :email,
                        phone = :phone,
                        service = :service,
                        subject = :subject,
                        message = :message,
                        status = :status
                    WHERE id = :id
                ");
                return $stmt->execute([
                    ':id'      => $id,
                    ':name'    => $data['name'],
                    ':email'   => $data['email'],
                    ':phone'   => $data['phone'] ?? null,
                    ':service' => $data['service'] ?? 'Général',
                    ':subject' => $data['subject'] ?? 'Demande de contact',
                    ':message' => $data['message'],
                    ':status'  => $data['status'] ?? 'nouveau',
                ]);
            }
        } catch (Exception $e) {
            error_log("Erreur ContactModel::update : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Mise à jour rapide du statut (nouveau, lu, traite, archive)
     */
    public static function updateStatus(int $id, string $status): bool
    {
        try {
            $pdo = Database::getConnection();
            try {
                $stmt = $pdo->prepare("UPDATE messages SET status = :status WHERE num_message = :id");
                return $stmt->execute([':id' => $id, ':status' => $status]);
            } catch (Exception $e) {
                $stmt = $pdo->prepare("UPDATE messages SET status = :status WHERE id = :id");
                return $stmt->execute([':id' => $id, ':status' => $status]);
            }
        } catch (Exception $e) {
            error_log("Erreur ContactModel::updateStatus : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Supprime un message par ID
     */
    public static function delete(int $id): bool
    {
        try {
            $pdo = Database::getConnection();
            try {
                $stmt = $pdo->prepare("DELETE FROM messages WHERE num_message = :id");
                return $stmt->execute([':id' => $id]);
            } catch (Exception $e) {
                $stmt = $pdo->prepare("DELETE FROM messages WHERE id = :id");
                return $stmt->execute([':id' => $id]);
            }
        } catch (Exception $e) {
            error_log("Erreur ContactModel::delete : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Supprime une liste d'identifiants (suppression groupée)
     */
    public static function deleteBatch(array $ids): int
    {
        if (empty($ids)) {
            return 0;
        }
        try {
            $pdo = Database::getConnection();
            $sanitizedIds = array_map('intval', $ids);
            $inClause = implode(',', $sanitizedIds);
            try {
                return $pdo->exec("DELETE FROM messages WHERE num_message IN ($inClause)");
            } catch (Exception $e) {
                return $pdo->exec("DELETE FROM messages WHERE id IN ($inClause)");
            }
        } catch (Exception $e) {
            error_log("Erreur ContactModel::deleteBatch : " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Vide complètement la table et remet l'auto-increment à 1
     */
    public static function truncate(): bool
    {
        try {
            $pdo = Database::getConnection();
            $pdo->exec("TRUNCATE TABLE messages");
            return true;
        } catch (Exception $e) {
            error_log("Erreur ContactModel::truncate : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Compte le nombre total de messages
     */
    public static function countAll(): int
    {
        try {
            $pdo = Database::getConnection();
            return (int) $pdo->query("SELECT COUNT(*) FROM messages")->fetchColumn();
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Compte les messages nouveaux (non traités)
     */
    public static function countNew(): int
    {
        try {
            $pdo = Database::getConnection();
            return (int) $pdo->query("SELECT COUNT(*) FROM messages WHERE status = 'nouveau'")->fetchColumn();
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Génère 5 messages de test réalistes pour l'étudiante
     */
    public static function seedTestData(): int
    {
        $samples = [
            [
                'name'    => 'Jean-Marc Koffi',
                'email'   => 'koffi.jm@cosmetiques-ci.com',
                'phone'   => '+225 07 12 34 56',
                'service' => 'Community Management',
                'subject' => 'Accompagnement marque cosmétique bio',
                'message' => 'Bonjour Wiky Holding, nous souhaitons déléguer la gestion complète de nos pages Instagram et TikTok avec création de contenus réels et modération 7j/7.',
                'status'  => 'nouveau'
            ],
            [
                'name'    => 'Aïssata Touré',
                'email'   => 'aissata.toure@ivoire-fintech.ci',
                'phone'   => '+225 05 45 67 89',
                'service' => 'Branding & Identité Visuelle',
                'subject' => 'Refonte globale de notre charte graphique',
                'message' => 'Nous préparons notre levée de fonds et nous avons besoin d\'une identité de marque corporate, moderne et épurée (logo vectoriel, brand book, cartes de visite).',
                'status'  => 'lu'
            ],
            [
                'name'    => 'Dr. Éric Kouamé',
                'email'   => 'e.kouame@clinique-esperance.ci',
                'phone'   => '+225 01 23 45 67',
                'service' => 'Studio Podcast & Médias',
                'subject' => 'Enregistrement d\'une série de 10 épisodes santé',
                'message' => 'Nous aimerions louer votre studio insonorisé avec régie multi-caméras 4K et micros Shure pour une émission de vulgarisation médicale pour le grand public.',
                'status'  => 'traite'
            ],
            [
                'name'    => 'Mireille Bamba',
                'email'   => 'm.bamba@agrobusiness-ci.com',
                'phone'   => '+225 07 89 01 23',
                'service' => 'Création d’Entreprise & Conseil',
                'subject' => 'Conseil en positionnement de marque agroalimentaire',
                'message' => 'Nous lançons une gamme de jus de fruits locaux en bouteilles verre et souhaitons une étude de marché packaging et stratégie de lancement.',
                'status'  => 'nouveau'
            ],
            [
                'name'    => 'Patrick N\'Dri',
                'email'   => 'pndri@innov-tech.abidjan.ci',
                'phone'   => '+225 27 20 21 22 23',
                'service' => 'Production Audiovisuelle',
                'subject' => 'Spot publicitaire vidéo 30s pour chaîne TV',
                'message' => 'Pouvez-vous nous transmettre un calendrier de tournage et une estimation pour un spot publicitaire corporate tourné à Abidjan ?',
                'status'  => 'archive'
            ]
        ];

        $inserted = 0;
        foreach ($samples as $s) {
            if (self::save($s)) {
                $inserted++;
            }
        }
        return $inserted;
    }
}

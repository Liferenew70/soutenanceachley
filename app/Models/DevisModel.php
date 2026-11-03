<?php
namespace App\Models;

use App\Config\Database;
use PDO;
use Exception;

class DevisModel
{
    /**
     * Enregistre une demande de devis dans la base de données
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
                            ':nom'   => $data['contact_name'] ?? 'Contact Devis',
                            ':email' => $data['email'],
                            ':tel'   => $data['phone'] ?? null,
                            ':entr'  => $data['company_name'] ?? null,
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
                            ':nom'   => $data['contact_name'] ?? 'Contact Devis',
                            ':email' => $data['email'],
                            ':tel'   => $data['phone'] ?? null,
                            ':entr'  => $data['company_name'] ?? null,
                        ]);
                        $prospectId = (int)$pdo->lastInsertId();
                    }
                }
            }

            // Résolution du service
            $codeService = 'cm';
            $serviceTerm = strtolower($data['service_type'] ?? '');
            if (strpos($serviceTerm, 'brand') !== false || strpos($serviceTerm, 'logo') !== false) {
                $codeService = 'branding';
            } elseif (strpos($serviceTerm, 'pod') !== false || strpos($serviceTerm, 'audio') !== false) {
                $codeService = 'podcast';
            } elseif (strpos($serviceTerm, 'entr') !== false || strpos($serviceTerm, 'strat') !== false) {
                $codeService = 'entreprise';
            } elseif (strpos($serviceTerm, 'cons') !== false) {
                $codeService = 'conseil';
            }

            try {
                $stmt = $pdo->prepare("
                    INSERT INTO devis_requests (num_prospect, code_service, mat_admin, company_name, contact_name, email, phone, service_type, budget_range, urgency, project_details, status, created_at)
                    VALUES (:prospect_id, :code_service, 1, :company_name, :contact_name, :email, :phone, :service_type, :budget_range, :urgency, :project_details, :status, NOW())
                ");

                return $stmt->execute([
                    ':prospect_id'     => $prospectId,
                    ':code_service'    => $codeService,
                    ':company_name'    => $data['company_name'],
                    ':contact_name'    => $data['contact_name'],
                    ':email'           => $data['email'],
                    ':phone'           => $data['phone'],
                    ':service_type'    => $data['service_type'],
                    ':budget_range'    => $data['budget_range'] ?? 'Non précisé',
                    ':urgency'         => $data['urgency'] ?? 'Normal (2-3 semaines)',
                    ':project_details' => $data['project_details'],
                    ':status'          => $data['status'] ?? 'en_attente',
                ]);
            } catch (Exception $e) {
                $stmt = $pdo->prepare("
                    INSERT INTO devis_requests (prospect_id, service_id, admin_id, company_name, contact_name, email, phone, service_type, budget_range, urgency, project_details, status, created_at)
                    VALUES (:prospect_id, 1, 1, :company_name, :contact_name, :email, :phone, :service_type, :budget_range, :urgency, :project_details, :status, NOW())
                ");

                return $stmt->execute([
                    ':prospect_id'     => $prospectId,
                    ':company_name'    => $data['company_name'],
                    ':contact_name'    => $data['contact_name'],
                    ':email'           => $data['email'],
                    ':phone'           => $data['phone'],
                    ':service_type'    => $data['service_type'],
                    ':budget_range'    => $data['budget_range'] ?? 'Non précisé',
                    ':urgency'         => $data['urgency'] ?? 'Normal (2-3 semaines)',
                    ':project_details' => $data['project_details'],
                    ':status'          => $data['status'] ?? 'en_attente',
                ]);
            }
        } catch (Exception $e) {
            error_log("Erreur DevisModel::save : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Récupère toutes les demandes de devis avec filtres optionnels
     */
    public static function getAll(?string $search = null, ?string $status = null): array
    {
        try {
            $pdo = Database::getConnection();
            $params = [];
            $where = " WHERE 1=1";

            if (!empty($search)) {
                $where .= " AND (company_name LIKE :search OR contact_name LIKE :search OR email LIKE :search OR phone LIKE :search OR service_type LIKE :search OR project_details LIKE :search)";
                $params[':search'] = '%' . $search . '%';
            }

            if (!empty($status) && $status !== 'all') {
                $where .= " AND status = :status";
                $params[':status'] = $status;
            }

            try {
                $sql = "SELECT d.*, d.num_devis AS id FROM devis_requests d" . $where . " ORDER BY d.num_devis DESC";
                $stmt = $pdo->prepare($sql);
                $stmt->execute($params);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                $sql = "SELECT * FROM devis_requests" . $where . " ORDER BY id DESC";
                $stmt = $pdo->prepare($sql);
                $stmt->execute($params);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            error_log("Erreur DevisModel::getAll : " . $e->getMessage());
            return [];
        }
    }

    /**
     * Récupère une demande de devis par son identifiant unique
     */
    public static function getById(int $id): ?array
    {
        try {
            $pdo = Database::getConnection();
            try {
                $stmt = $pdo->prepare("SELECT d.*, d.num_devis AS id FROM devis_requests d WHERE d.num_devis = :id LIMIT 1");
                $stmt->execute([':id' => $id]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($res) {
                    return $res;
                }
            } catch (Exception $e) {
                $stmt = $pdo->prepare("SELECT * FROM devis_requests WHERE id = :id LIMIT 1");
                $stmt->execute([':id' => $id]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($res) {
                    $res['num_devis'] = $res['id'];
                    return $res;
                }
            }
            return null;
        } catch (Exception $e) {
            error_log("Erreur DevisModel::getById : " . $e->getMessage());
            return null;
        }
    }

    /**
     * Met à jour une demande de devis
     */
    public static function update(int $id, array $data): bool
    {
        try {
            $pdo = Database::getConnection();
            try {
                $stmt = $pdo->prepare("
                    UPDATE devis_requests 
                    SET company_name = :company_name,
                        contact_name = :contact_name,
                        email = :email,
                        phone = :phone,
                        service_type = :service_type,
                        budget_range = :budget_range,
                        urgency = :urgency,
                        project_details = :project_details,
                        status = :status
                    WHERE num_devis = :id
                ");

                return $stmt->execute([
                    ':id'              => $id,
                    ':company_name'    => $data['company_name'],
                    ':contact_name'    => $data['contact_name'],
                    ':email'           => $data['email'],
                    ':phone'           => $data['phone'],
                    ':service_type'    => $data['service_type'],
                    ':budget_range'    => $data['budget_range'] ?? 'Non précisé',
                    ':urgency'         => $data['urgency'] ?? 'Normal',
                    ':project_details' => $data['project_details'],
                    ':status'          => $data['status'] ?? 'en_attente',
                ]);
            } catch (Exception $e) {
                $stmt = $pdo->prepare("
                    UPDATE devis_requests 
                    SET company_name = :company_name,
                        contact_name = :contact_name,
                        email = :email,
                        phone = :phone,
                        service_type = :service_type,
                        budget_range = :budget_range,
                        urgency = :urgency,
                        project_details = :project_details,
                        status = :status
                    WHERE id = :id
                ");

                return $stmt->execute([
                    ':id'              => $id,
                    ':company_name'    => $data['company_name'],
                    ':contact_name'    => $data['contact_name'],
                    ':email'           => $data['email'],
                    ':phone'           => $data['phone'],
                    ':service_type'    => $data['service_type'],
                    ':budget_range'    => $data['budget_range'] ?? 'Non précisé',
                    ':urgency'         => $data['urgency'] ?? 'Normal',
                    ':project_details' => $data['project_details'],
                    ':status'          => $data['status'] ?? 'en_attente',
                ]);
            }
        } catch (Exception $e) {
            error_log("Erreur DevisModel::update : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Mise à jour rapide du statut (en_attente, en_cours, valide, rejete)
     */
    public static function updateStatus(int $id, string $status): bool
    {
        try {
            $pdo = Database::getConnection();
            try {
                $stmt = $pdo->prepare("UPDATE devis_requests SET status = :status WHERE num_devis = :id");
                return $stmt->execute([':id' => $id, ':status' => $status]);
            } catch (Exception $e) {
                $stmt = $pdo->prepare("UPDATE devis_requests SET status = :status WHERE id = :id");
                return $stmt->execute([':id' => $id, ':status' => $status]);
            }
        } catch (Exception $e) {
            error_log("Erreur DevisModel::updateStatus : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Supprime une demande de devis
     */
    public static function delete(int $id): bool
    {
        try {
            $pdo = Database::getConnection();
            try {
                $stmt = $pdo->prepare("DELETE FROM devis_requests WHERE num_devis = :id");
                return $stmt->execute([':id' => $id]);
            } catch (Exception $e) {
                $stmt = $pdo->prepare("DELETE FROM devis_requests WHERE id = :id");
                return $stmt->execute([':id' => $id]);
            }
        } catch (Exception $e) {
            error_log("Erreur DevisModel::delete : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Supprime une liste de devis (suppression groupée)
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
                return $pdo->exec("DELETE FROM devis_requests WHERE num_devis IN ($inClause)");
            } catch (Exception $e) {
                return $pdo->exec("DELETE FROM devis_requests WHERE id IN ($inClause)");
            }
        } catch (Exception $e) {
            error_log("Erreur DevisModel::deleteBatch : " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Vide complètement la table devis_requests et réinitialise l'auto-incrément
     */
    public static function truncate(): bool
    {
        try {
            $pdo = Database::getConnection();
            $pdo->exec("TRUNCATE TABLE devis_requests");
            return true;
        } catch (Exception $e) {
            error_log("Erreur DevisModel::truncate : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Compte le nombre total de devis
     */
    public static function countAll(): int
    {
        try {
            $pdo = Database::getConnection();
            return (int) $pdo->query("SELECT COUNT(*) FROM devis_requests")->fetchColumn();
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Compte les devis en attente
     */
    public static function countPending(): int
    {
        try {
            $pdo = Database::getConnection();
            return (int) $pdo->query("SELECT COUNT(*) FROM devis_requests WHERE status = 'en_attente'")->fetchColumn();
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Estime un tarif indicatif pour le simulateur en temps réel (en FCFA)
     */
    public static function estimatePrice(string $service, string $scope, string $speed): array
    {
        $basePrices = [
            'community-management' => 150000,
            'branding-logos'       => 250000,
            'studio-podcast'       => 80000,
            'creation-entreprise'  => 450000,
        ];

        $scopeMultipliers = [
            'starter' => 1.0,
            'standard' => 1.6,
            'premium' => 2.4,
        ];

        $speedMultipliers = [
            'normal' => 1.0,
            'urgent' => 1.3,
        ];

        $base = $basePrices[$service] ?? 150000;
        $scopeMult = $scopeMultipliers[$scope] ?? 1.0;
        $speedMult = $speedMultipliers[$speed] ?? 1.0;

        $total = (int) round($base * $scopeMult * $speedMult);

        return [
            'total' => $total,
            'formatted' => number_format($total, 0, ',', ' ') . ' FCFA'
        ];
    }

    /**
     * Génère 5 demandes de devis réalistes pour l'étudiante
     */
    public static function seedTestData(): int
    {
        $samples = [
            [
                'company_name'    => 'Ivoire FinTech Hub',
                'contact_name'    => 'Aïssata Traoré',
                'email'           => 'aissata.traore@ivoirefintech.ci',
                'phone'           => '+225 05 98 76 54',
                'service_type'    => 'branding-logos',
                'budget_range'    => '500.000 - 1.000.000 FCFA',
                'urgency'         => 'Urgent (< 1 semaine)',
                'project_details' => 'Création complète de la charte graphique, du logo vectoriel et des déclinaisons pour lancement officiel de notre fintech.',
                'status'          => 'en_attente'
            ],
            [
                'company_name'    => 'Abidjan Distribution Logistics',
                'contact_name'    => 'Mamadou Diarra',
                'email'           => 'm.diarra@adl-ci.com',
                'phone'           => '+225 07 20 22 24',
                'service_type'    => 'community-management',
                'budget_range'    => '250.000 - 500.000 FCFA',
                'urgency'         => 'Normal (2-3 semaines)',
                'project_details' => 'Campagne LinkedIn B2B et modération de nos réseaux pour asseoir notre notoriété auprès des industriels de la zone portuaire.',
                'status'          => 'en_cours'
            ],
            [
                'company_name'    => 'Studio K Wellness',
                'contact_name'    => 'Kady Koné',
                'email'           => 'kady@studiok.ci',
                'phone'           => '+225 01 02 03 04',
                'service_type'    => 'studio-podcast',
                'budget_range'    => 'Moins de 250.000 FCFA',
                'urgency'         => 'Flexible',
                'project_details' => 'Tournage de 4 podcasts vidéo bien-être de 30 minutes avec montage pro et découpage en formats réels Instagram.',
                'status'          => 'valide'
            ],
            [
                'company_name'    => 'BTP Ivoire Construction',
                'contact_name'    => 'Serge Bamba',
                'email'           => 'serge.bamba@btpivoire.ci',
                'phone'           => '+225 05 11 22 33',
                'service_type'    => 'creation-entreprise',
                'budget_range'    => 'Plus de 1.000.000 FCFA',
                'urgency'         => 'Normal (2-3 semaines)',
                'project_details' => 'Pack complet de marque d\'entreprise avec plaquette institutionnelle, enseigne 3D et catalogue de réalisations immobilières.',
                'status'          => 'en_attente'
            ],
            [
                'company_name'    => 'Café Gourmand Plateau',
                'contact_name'    => 'Carine N\'Goran',
                'email'           => 'contact@cafegourmand.ci',
                'phone'           => '+225 27 21 00 11',
                'service_type'    => 'community-management',
                'budget_range'    => '250.000 - 500.000 FCFA',
                'urgency'         => 'Normal (2-3 semaines)',
                'project_details' => 'Animation quotidienne Instagram et Facebook pour attirer la clientèle business du Plateau le midi.',
                'status'          => 'rejete'
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

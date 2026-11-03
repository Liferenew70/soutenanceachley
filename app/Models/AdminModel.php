<?php
namespace App\Models;

use App\Config\Database;
use PDO;
use Exception;

class AdminModel
{
    /**
     * Récupère un administrateur par son nom d'utilisateur
     */
    public static function getByUsername(string $username): ?array
    {
        try {
            $pdo = Database::getConnection();
            try {
                $stmt = $pdo->prepare("SELECT a.*, a.mat_admin AS id FROM admins a WHERE a.username = :u LIMIT 1");
                $stmt->execute([':u' => $username]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($res) {
                    return $res;
                }
            } catch (Exception $e) {
                $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = :u LIMIT 1");
                $stmt->execute([':u' => $username]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($res) {
                    $res['mat_admin'] = $res['id'];
                    return $res;
                }
            }
            return null;
        } catch (Exception $e) {
            error_log("Erreur AdminModel::getByUsername : " . $e->getMessage());
            return null;
        }
    }

    /**
     * Récupère un administrateur par son identifiant
     */
    public static function getById(int $id): ?array
    {
        try {
            $pdo = Database::getConnection();
            try {
                $stmt = $pdo->prepare("SELECT a.*, a.mat_admin AS id FROM admins a WHERE a.mat_admin = :id LIMIT 1");
                $stmt->execute([':id' => $id]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($res) {
                    return $res;
                }
            } catch (Exception $e) {
                $stmt = $pdo->prepare("SELECT * FROM admins WHERE id = :id LIMIT 1");
                $stmt->execute([':id' => $id]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($res) {
                    $res['mat_admin'] = $res['id'];
                    return $res;
                }
            }
            return null;
        } catch (Exception $e) {
            error_log("Erreur AdminModel::getById : " . $e->getMessage());
            return null;
        }
    }

    /**
     * Vérifie les identifiants et retourne le compte si valide
     */
    public static function verifyLogin(string $username, string $password): ?array
    {
        $admin = self::getByUsername($username);
        if (!$admin) {
            return null;
        }

        if (password_verify($password, $admin['password_hash'])) {
            return $admin;
        }

        return null;
    }

    /**
     * Vérifie le mot de passe actuel d'un administrateur
     */
    public static function verifyPassword(int $id, string $password): bool
    {
        $admin = self::getById($id);
        if (!$admin) {
            return false;
        }

        return password_verify($password, $admin['password_hash']);
    }

    /**
     * Met à jour le nom d'utilisateur et/ou le mot de passe
     */
    public static function updateCredentials(int $id, string $newUsername, ?string $newPassword = null, ?string $newName = null): bool
    {
        try {
            $pdo = Database::getConnection();

            if (!empty($newPassword)) {
                $hash = password_hash($newPassword, PASSWORD_BCRYPT);
                try {
                    $sql = "UPDATE admins SET username = :u, password_hash = :p, name = COALESCE(:n, name) WHERE mat_admin = :id";
                    $stmt = $pdo->prepare($sql);
                    return $stmt->execute([
                        ':id' => $id,
                        ':u'  => $newUsername,
                        ':p'  => $hash,
                        ':n'  => $newName,
                    ]);
                } catch (Exception $e) {
                    $sql = "UPDATE admins SET username = :u, password_hash = :p, name = COALESCE(:n, name) WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    return $stmt->execute([
                        ':id' => $id,
                        ':u'  => $newUsername,
                        ':p'  => $hash,
                        ':n'  => $newName,
                    ]);
                }
            } else {
                try {
                    $sql = "UPDATE admins SET username = :u, name = COALESCE(:n, name) WHERE mat_admin = :id";
                    $stmt = $pdo->prepare($sql);
                    return $stmt->execute([
                        ':id' => $id,
                        ':u'  => $newUsername,
                        ':n'  => $newName,
                    ]);
                } catch (Exception $e) {
                    $sql = "UPDATE admins SET username = :u, name = COALESCE(:n, name) WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    return $stmt->execute([
                        ':id' => $id,
                        ':u'  => $newUsername,
                        ':n'  => $newName,
                    ]);
                }
            }
        } catch (Exception $e) {
            error_log("Erreur AdminModel::updateCredentials : " . $e->getMessage());
            return false;
        }
    }
}

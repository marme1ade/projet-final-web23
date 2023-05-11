<?php

namespace App\Domain\Usager\Repository;

use PDO;

/**
 * Repository.
 */
class UsagerRepository
{
    /**
     * @var PDO La connexion à la base de données
     */
    private $connection;

    /**
     * Constructeur
     *
     * @param PDO $connection La connexion à la base de données
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function selectUsagerById($id): array
    {
      $sql = "
      SELECT * FROM usager WHERE id = :id;
      ";
      $params = [
        'id' => $id,
      ];

      $query = $this->connection->prepare($sql);
      $query->execute($params);

      $result = $query->fetchAll(PDO::FETCH_ASSOC);

      return $result[0] ?? [];
    }

    public function insertUser($nom, $mdp): array
    {

      $sql = "
      INSERT INTO usager (nom, mdp, cle_api) VALUES (:nom, :mdp, :cle_api);
      ";

      $params = [
        'nom' => $nom ?? "",
        'mdp' => password_hash($mdp, PASSWORD_DEFAULT) ?? "",
        'cle_api' => $this->getRandomString(16),
      ];

      $query = $this->connection->prepare($sql);
      $query->execute($params);
      $usagerId = $this->connection->lastInsertId();
      $result = $this->selectUsagerById($usagerId);

      return $result;
    }

    function getRandomString($n)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-!$&';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

}

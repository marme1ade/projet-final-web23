<?php

namespace App\Domain\Cle\Repository;

use PDO;

/**
 * Repository.
 */
class CleRepository
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

    public function selectCle($nom): array
    {
      $sql = "
      SELECT * FROM usager WHERE nom = :nom;
      ";

      $params = [
        'nom' => $nom ?? "",
      ];

      $query = $this->connection->prepare($sql);
      $query->execute($params);

      $result = $query->fetchAll(PDO::FETCH_ASSOC);

      return $result[0] ?? [];
    }

    public function isTokenValid($cle_api): bool
    {
      $sql = "
      SELECT * FROM usager WHERE cle_api = :cle_api;
      ";

      $params = [
        'cle_api' => $cle_api ?? "",
      ];

      $query = $this->connection->prepare($sql);
      $query->execute($params);

      $result = $query->fetchAll(PDO::FETCH_ASSOC);


      return sizeof($result) != 0;
    }

    public function nouvelleCle($nom): array
    {
      $sql = "
      UPDATE usager SET cle_api = :cle_api WHERE nom = :nom;
      ";

      $params = [
        'cle_api' => $this->getRandomString(16),
        'nom' => $nom,
      ];

      $query = $this->connection->prepare($sql);
      $query->execute($params);

      $result = $this->selectCle($nom);

      return $result ?? [];
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

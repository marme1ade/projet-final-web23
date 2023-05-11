<?php

namespace App\Domain\Artiste\Repository;

use PDO;

/**
 * Repository.
 */
class ArtisteRepository
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

    public function selectArtisteById($id): array
    {
      $sql = "
      SELECT * FROM artiste WHERE id = :id;
      ";
      $params = [
        'id' => $id,
      ];

      $query = $this->connection->prepare($sql);
      $query->execute($params);

      $result = $query->fetchAll(PDO::FETCH_ASSOC);

      return $result[0] ?? [];
    }

    public function selectArtistes(): array
    {
      $sql = "
      SELECT * FROM artiste;
      ";

      $query = $this->connection->prepare($sql);
      $query->execute();

      $result = $query->fetchAll(PDO::FETCH_ASSOC);

      return $result ?? [];
    }

    public function insertArtiste($nom, $description): array
    {

      $sql = "
      INSERT INTO artiste (nom, description) VALUES (:nom, :description);
      ";

      $params = [
        'nom' => $nom ?? "",
        'description' => $description ?? "",
      ];

      $query = $this->connection->prepare($sql);
      $query->execute($params);
      $artisteId = $this->connection->lastInsertId();
      $result = $this->selectArtisteById($artisteId);

      return $result;
    }

}

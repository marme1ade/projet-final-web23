<?php

namespace App\Domain\Composition\Repository;

use PDO;

/**
 * Repository.
 */
class CompositionRepository
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

    public function modifyComposition($id, $id_periode, $nom, $description)
    {
      $sql = "
      UPDATE composition SET id_periode = :id_periode, nom = :nom, description = :description WHERE id = :id;
      ";
      $params = [
        'id' => $id,
        'id_periode' => $id_periode,
        'nom' => $nom,
        'description' => $description,
      ];

      $query = $this->connection->prepare($sql);
      $query->execute($params);

      $result = $query->fetchAll(PDO::FETCH_ASSOC);

      return $result ?? [];
    }

    public function selectCompositionById($id): array
    {
      $sql = "
      SELECT * FROM composition WHERE id = :id;
      ";
      $params = [
        'id' => $id,
      ];

      $query = $this->connection->prepare($sql);
      $query->execute($params);

      $result = $query->fetchAll(PDO::FETCH_ASSOC);

      return $result[0] ?? [];
    }

    public function selectCompositionByArtist($id_artiste): array
    {
      $sql = "
      SELECT * FROM composition WHERE id_artiste = :id_artiste;
      ";
      $params = [
        'id_artiste' => $id_artiste,
      ];

      $query = $this->connection->prepare($sql);
      $query->execute($params);

      $result = $query->fetchAll(PDO::FETCH_ASSOC);

      return $result ?? [];
    }

    public function insertComposition($id_periode, $id_artiste, $nom, $description): array
    {

      $sql = "
      INSERT INTO composition (id_periode, id_artiste, nom, description) VALUES (:id_periode, :id_artiste, :nom, :description);
      ";

      $params = [
        'id_periode' => $id_periode ?? "",
        'id_artiste' => $id_artiste ?? "",
        'nom' => $nom ?? "",
        'description' => $description ?? "",
      ];

      $query = $this->connection->prepare($sql);
      $query->execute($params);
      $compositionId = $this->connection->lastInsertId();
      $result = $this->selectCompositionById($compositionId);

      return $result;
    }

}

<?php

namespace App\Domain\Partition\Repository;

use PDO;

/**
 * Repository.
 */
class PartitionRepository
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

    public function deletePartition($id): array 
    {
      $sql = "
      DELETE FROM partition_musique WHERE id = :id;
      ";
      $params = [
        'id' => $id,
      ];

      $query = $this->connection->prepare($sql);
      $query->execute($params);

      $result = $query->fetchAll(PDO::FETCH_ASSOC);

      return $result ?? [];
    }

    public function selectPartitionById($id): array
    {
      $sql = "
      SELECT * FROM partition_musique WHERE id = :id;
      ";
      $params = [
        'id' => $id,
      ];

      $query = $this->connection->prepare($sql);
      $query->execute($params);

      $result = $query->fetchAll(PDO::FETCH_ASSOC);

      return $result[0] ?? [];
    }

    public function insertPartition($id_periode, $id_composition, $nom, $nom_fichier, $upload_par): array
    {
      $sql = "
      INSERT INTO partition_musique (id_periode, id_composition, nom, nom_fichier, upload_par) VALUES (:id_periode, :id_composition, :nom, :nom_fichier, :upload_par);
      ";

      $params = [
        'id_periode' => $id_periode ?? "",
        'id_composition' => $id_composition ?? "",
        'nom' => $nom ?? "",
        'nom_fichier' => $nom_fichier ?? "",
        'upload_par' => $upload_par ?? "",
      ];

      $query = $this->connection->prepare($sql);
      $query->execute($params);
      $partitionId = $this->connection->lastInsertId();
      $result = $this->selectPartitionById($partitionId);

      return $result;
    }

    public function selectPartitionByComposition($id_composition): array
    {
      $sql = "
      SELECT * FROM partition_musique WHERE id_composition = :id_composition;
      ";
      $params = [
        'id_composition' => $id_composition,
      ];

      $query = $this->connection->prepare($sql);
      $query->execute($params);

      $result = $query->fetchAll(PDO::FETCH_ASSOC);

      return $result ?? [];
    }

}

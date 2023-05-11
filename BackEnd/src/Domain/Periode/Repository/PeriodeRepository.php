<?php

namespace App\Domain\Periode\Repository;

use PDO;

/**
 * Repository.
 */
class PeriodeRepository
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

    public function selectPeriode(): array
    {
      $sql = "
      SELECT * FROM periode;
      ";

      $query = $this->connection->prepare($sql);
      $query->execute();

      $result = $query->fetchAll(PDO::FETCH_ASSOC);

      return $result ?? [];
    }

}

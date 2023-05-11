<?php

namespace App\Domain\Partition\Service;

use App\Domain\Partition\Repository\PartitionRepository;

/**
 * Service.
 */
final class PartitionViewByComposition
{
    /**
     * @var PartitionRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param PartitionRepository $repository
     */
    public function __construct(PartitionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Sélectionne une salutation aléatoire.
     *
     * @param string $codeLangue Le code de la langue
     *
     * @return string La salutation
     */
    public function viewPartitionByComposition($data): array
    {
        $compositions = $this->repository->selectPartitionByComposition($data['id_composition']);
        
        return $compositions ?? [];
    }
}

<?php

namespace App\Domain\Partition\Service;

use App\Domain\Partition\Repository\PartitionRepository;

/**
 * Service.
 */
final class PartitionDelete
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

    public function deletePartition($id): array
    {
        $result = $this->repository->deletePartition($id);
        
        return $result ?? [];
    }
}

<?php

namespace App\Domain\Partition\Service;

use App\Domain\Partition\Repository\PartitionRepository;

/**
 * Service.
 */
final class PartitionDownload
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

    public function downloadPartition($id): array
    {
        $partition = $this->repository->selectPartitionById($id);
        
        return $partition ?? [];
    }
}

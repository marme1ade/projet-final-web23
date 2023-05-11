<?php

namespace App\Domain\Composition\Service;

use App\Domain\Composition\Repository\CompositionRepository;

/**
 * Service.
 */
final class CompositionByArtistView
{
    /**
     * @var CompositionRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param CompositionRepository $repository
     */
    public function __construct(CompositionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function viewCompositionByArtist($data): array
    {
        $compositions = $this->repository->selectCompositionByArtist($data['artiste']);
        
        return $compositions ?? [];
    }
}

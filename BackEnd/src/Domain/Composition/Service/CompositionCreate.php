<?php

namespace App\Domain\Composition\Service;

use App\Domain\Composition\Repository\CompositionRepository;

/**
 * Service.
 */
final class CompositionCreate
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

    public function createComposition($data): array
    {
        $compo = $this->repository->insertComposition($data['id_periode'], $data['id_artiste'], $data['nom'], $data['description']);
        
        return $compo ?? [];
    }
}

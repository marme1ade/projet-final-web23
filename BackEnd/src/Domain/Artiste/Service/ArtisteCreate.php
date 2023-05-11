<?php

namespace App\Domain\Artiste\Service;

use App\Domain\Artiste\Repository\ArtisteRepository;

/**
 * Service.
 */
final class ArtisteCreate
{
    /**
     * @var ArtisteRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param ArtisteRepository $repository
     */
    public function __construct(ArtisteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createArtiste($data): array
    {
        $artiste = $this->repository->insertArtiste($data['nom'], $data['description']);
        
        return $artiste ?? [];
    }
}

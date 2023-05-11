<?php

namespace App\Domain\Artiste\Service;

use App\Domain\Artiste\Repository\ArtisteRepository;

/**
 * Service.
 */
final class ArtisteView
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

    public function viewArtiste(): array
    {
        $artistes = $this->repository->selectArtistes();
        
        return $artistes ?? [];
    }
}

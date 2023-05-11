<?php

namespace App\Domain\Usager\Service;

use App\Domain\Usager\Repository\UsagerRepository;

/**
 * Service.
 */
final class UsagerCreate
{
    /**
     * @var UsagerRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UsagerRepository $repository
     */
    public function __construct(UsagerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createUsager($data): array
    {
        $usager = $this->repository->insertUser($data['nom'], $data['mdp']);
        
        return $usager ?? [];
    }
}

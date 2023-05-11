<?php

namespace App\Domain\Composition\Service;

use App\Domain\Composition\Repository\CompositionRepository;

final class CompositionModify
{

    private $repository;

    public function __construct(CompositionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function modifyComposition($data): array
    {
        $compo = $this->repository->modifyComposition($data['id'], $data['id_periode'], $data['nom'], $data['description']);
        
        return $compo ?? [];
    }
}

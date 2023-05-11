<?php

namespace App\Domain\Periode\Service;

use App\Domain\Periode\Repository\PeriodeRepository;

/**
 * Service.
 */
final class PeriodeView
{
    /**
     * @var PeriodeRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param PeriodeRepository $repository
     */
    public function __construct(PeriodeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function viewPeriode(): array
    {
        $periodes = $this->repository->selectPeriode();
        
        return $periodes ?? [];
    }
}

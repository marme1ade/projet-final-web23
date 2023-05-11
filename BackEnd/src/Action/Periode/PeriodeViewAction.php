<?php

namespace App\Action\Periode;

use App\Domain\Periode\Service\PeriodeView;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class PeriodeViewAction
{
    private $periodeView;

    public function __construct(PeriodeView $periodeView)
    {
        $this->periodeView = $periodeView;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {
      
        // Invoke the Domain with inputs and retain the result
        $resultat = $this->periodeView->viewPeriode();

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}

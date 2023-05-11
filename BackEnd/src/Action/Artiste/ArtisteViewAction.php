<?php

namespace App\Action\Artiste;

use App\Domain\Artiste\Service\ArtisteView;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ArtisteViewAction
{
    private $artisteView;

    public function __construct(ArtisteView $artisteView)
    {
        $this->artisteView = $artisteView;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {
      
        // Invoke the Domain with inputs and retain the result
        $resultat = $this->artisteView->viewArtiste();

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}

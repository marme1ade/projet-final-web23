<?php

namespace App\Action\Composition;

use App\Domain\Composition\Service\CompositionByArtistView;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CompositionByArtistViewAction
{
    private $compositionByArtistView;

    public function __construct(CompositionByArtistView $compositionByArtistView)
    {
        $this->compositionByArtistView = $compositionByArtistView;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        $data = (array)$request->getParsedBody();

        $resultat = $this->compositionByArtistView->viewCompositionByArtist($data);

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}

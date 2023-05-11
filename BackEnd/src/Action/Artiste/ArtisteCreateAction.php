<?php

namespace App\Action\Artiste;

use App\Domain\Artiste\Service\ArtisteCreate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ArtisteCreateAction
{
    private $artisteCreate;

    public function __construct(ArtisteCreate $artisteCreate)
    {
        $this->artisteCreate = $artisteCreate;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $resultat = $this->artisteCreate->createArtiste($data);

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}

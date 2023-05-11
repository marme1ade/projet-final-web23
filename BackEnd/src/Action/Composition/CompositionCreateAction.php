<?php

namespace App\Action\Composition;

use App\Domain\Composition\Service\CompositionCreate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CompositionCreateAction
{
    private $compositionCreate;

    public function __construct(CompositionCreate $compositionCreate)
    {
        $this->compositionCreate = $compositionCreate;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $resultat = $this->compositionCreate->createComposition($data);

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}

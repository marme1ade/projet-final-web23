<?php

namespace App\Action\Usager;

use App\Domain\Usager\Service\UsagerCreate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class UsagerCreateAction
{
    private $usagerCreate;

    public function __construct(UsagerCreate $usagerCreate)
    {
        $this->usagerCreate = $usagerCreate;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $resultat = $this->usagerCreate->createUsager($data);

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}

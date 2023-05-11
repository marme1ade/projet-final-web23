<?php

namespace App\Action\Composition;

use App\Domain\Composition\Service\CompositionModify;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CompositionModifyAction
{
    private $compositionModify;

    public function __construct(CompositionModify $compositionModify)
    {
        $this->compositionModify = $compositionModify;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        $params = (array)$request->getQueryParams() ?? [];

        $resultat = $this->compositionModify->modifyComposition($params);

        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}

<?php

namespace App\Action\Cle;

use App\Domain\Cle\Service\CleView;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class CleViewAction
{
    private $cleView;

    public function __construct(CleView $cleView)
    {
        $this->cleView = $cleView;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        $data = (array)$request->getParsedBody();

        $resultat = null;

        if($data['nouvelle'] == true){
          $resultat = $this->cleView->nouvelleCle($data);
        }
        else
        {
          $resultat = $this->cleView->viewCle($data);
        }

        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}

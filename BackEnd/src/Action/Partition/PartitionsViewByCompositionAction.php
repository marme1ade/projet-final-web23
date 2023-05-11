<?php

namespace App\Action\Partition;

use App\Domain\Partition\Service\PartitionViewByComposition;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class PartitionsViewByCompositionAction
{
    private $partitionViewByComposition;

    public function __construct(PartitionViewByComposition $partitionViewByComposition)
    {
        $this->partitionViewByComposition = $partitionViewByComposition;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $resultat = $this->partitionViewByComposition->viewPartitionByComposition($data);

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}

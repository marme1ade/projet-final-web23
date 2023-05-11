<?php

namespace App\Action\Partition;

use App\Domain\Partition\Service\PartitionCreate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class PartitionCreateAction
{
    private $partitionCreate;

    public function __construct(PartitionCreate $partitionCreate)
    {
        $this->partitionCreate = $partitionCreate;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $resultat = $this->partitionCreate->createPartition($request, $data);

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}

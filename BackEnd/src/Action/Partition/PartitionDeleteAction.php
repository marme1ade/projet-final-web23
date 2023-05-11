<?php

namespace App\Action\Partition;

use App\Domain\Partition\Service\PartitionDelete;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class PartitionDeleteAction
{
    private $partitionDelete;

    public function __construct(PartitionDelete $partitionDelete)
    {
        $this->partitionDelete = $partitionDelete;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        $queryParams = $request->getQueryParams() ?? [];

        $resultat = $this->partitionDelete->deletePartition($queryParams['id']);

        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}

<?php

namespace App\Action\Partition;

use App\Domain\Partition\Service\PartitionDownload;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class PartitionDownloadAction
{
    private $partitionDownload;

    public function __construct(PartitionDownload $partitionDownload)
    {
        $this->partitionDownload = $partitionDownload;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        $queryParams = $request->getQueryParams() ?? [];

        // Invoke the Domain with inputs and retain the result
        $resultat = $this->partitionDownload->downloadPartition($queryParams['id']);
        $file = '/shared/httpd/brunellelou-webfinale/uploads/' . $resultat['nom_fichier'];
        
        $response = $response->withHeader('Content-Description', 'File Transfer')
            ->withHeader('Content-Type', 'application/octet-stream')
            ->withHeader('Content-Disposition', 'attachment;filename="'.basename($file).'"')
            ->withHeader('Expires', '0')
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file))
            ->withStatus(200);

        readfile($file);
        return $response;
    }
}

<?php

namespace App\Domain\Partition\Service;
use Psr\Http\Message\UploadedFileInterface;
use App\Domain\Partition\Repository\PartitionRepository;

/**
 * Service.
 */
final class PartitionCreate
{
    /**
     * @var PartitionRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param PartitionRepository $repository
     */
    public function __construct(PartitionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createPartition($request, $data): array
    {
        $directory = '/shared/httpd/brunellelou-webfinale/uploads';
        $uploadedFiles = $request->getUploadedFiles();

        // handle single input with single file upload
        $uploadedFile = $uploadedFiles['inputFile'];

        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            $filename = $this->moveUploadedFile($directory, $uploadedFile);
            $partition = $this->repository->insertPartition($data['id_periode'], $data['id_composition'], $data['nom'], $filename, $data['upload_par']);
        }
        
        return $partition ?? [];
    }

    function moveUploadedFile(string $directory, UploadedFileInterface $uploadedFile)
    {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);

        // voir http://php.net/manual/en/function.random-bytes.php
        $basename = bin2hex(random_bytes(8));
        $filename = sprintf('%s.%0.8s', $basename, $extension);

        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

        return $filename;
    }
}

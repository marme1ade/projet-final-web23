<?php

namespace App\Domain\Cle\Service;

use App\Domain\Cle\Repository\CleRepository;
use App\Domain\Usager\Service\UsagerCreate;

/**
 * Service.
 */
final class CleView
{
    /**
     * @var CleRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param CleRepository $repository
     */
    public function __construct(CleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function viewCle($data): array
    {
        $usagerCle = $this->getUsagerCle($data);
        if(password_verify($usagerCle['nohash'], $usagerCle['mdp']))
        {
            return [
                'cle' => $usagerCle['cle_api']
            ];
        }
        return [
            'cle' => "Erreur. Aucun utilisateur trouvé"
        ];
    }

    public function nouvelleCle($data): array
    {
        $usagerCle = $this->getUsagerCle($data);
        if(password_verify($usagerCle['nohash'], $usagerCle['mdp']))
        {
            $cle = $this->repository->nouvelleCle($usagerCle['nom']);
            return [
                'cle' => $cle['cle_api']
            ];
        }
        return [
            'cle' => "Erreur. Échec à la création d'une nouvelle clé"
        ];
    }

    function getUsagerCle($data)
    {
        $decoded = explode(" ", base64_decode($data['base']));

        $usagerCle = $this->repository->selectCle($decoded[0]);
        $usagerCle['nohash'] = $decoded[1];

        return $usagerCle;
    }
}

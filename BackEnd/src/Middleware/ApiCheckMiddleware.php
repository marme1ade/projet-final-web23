<?php
namespace App\Middleware;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

// Classe repository où je traite avec la BD
use App\Domain\Cle\Repository\CleRepository;

class ApiCheckMiddleware
{
    
    private $repository;
    
    public function __construct(CleRepository $cleRepository)
    {
        $this->repository = $cleRepository;
    }
    
    /**
     * Validation d'une clé api
     *
     * @param  ServerRequestInterface  $request PSR-7 request
     * @param  RequestHandler $handler PSR-15 request handler
     *
     * @return Response
     */
    public function __invoke(ServerRequestInterface $request, RequestHandler $handler): Response
    {
        $apiKey = explode(' ', $request->getHeaderLine('Authorization'))[1] ?? '';
        
        if(!$this->repository->isTokenValid($apiKey)) {
            // On retourne un message d'erreur, la requète ne sera pas exécuter
            $response = new Response();
            $response->getBody()->write(json_encode(["erreur" => "La clé est invalide. Accès non autorisé"]));
            return $response
                ->withStatus(403)
                ->withHeader('Content-Type', 'application/json');
        }     
        // la ligne suivante permet de lancer la requète
        return $handler->handle($request);
    }
}
<?php

use Slim\App;
use App\Middleware\ApiCheckMiddleware;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

return function (App $app) {

    // Documentation de l'api
    $app->get('/docs', \App\Action\Docs\SwaggerUiAction::class);

    $app->get('/', \App\Action\HomeAction::class)->setName('home');

    $app->put('/cle', \App\Action\Cle\CleViewAction::class);

    $app->post('/usager', \App\Action\Usager\UsagerCreateAction::class)
        ->add(ApiCheckMiddleware::class);
    $app->get('/periode', \App\Action\Periode\PeriodeViewAction::class)
        ->add(ApiCheckMiddleware::class);
    $app->post('/artiste', \App\Action\Artiste\ArtisteCreateAction::class)
        ->add(ApiCheckMiddleware::class);
    $app->get('/artiste', \App\Action\Artiste\ArtisteViewAction::class)
        ->add(ApiCheckMiddleware::class);
    $app->put('/composition', \App\Action\Composition\CompositionModifyAction::class)
        ->add(ApiCheckMiddleware::class);
    $app->post('/composition', \App\Action\Composition\CompositionCreateAction::class)
        ->add(ApiCheckMiddleware::class);
    $app->post('/compositions', \App\Action\Composition\CompositionByArtistViewAction::class)
        ->add(ApiCheckMiddleware::class);
    $app->get('/partitionDownload', \App\Action\Partition\PartitionDownloadAction::class)
        ->add(ApiCheckMiddleware::class);
    $app->post('/partition', \App\Action\Partition\PartitionCreateAction::class)
        ->add(ApiCheckMiddleware::class);
    $app->delete('/partition', \App\Action\Partition\PartitionDeleteAction::class)
        ->add(ApiCheckMiddleware::class);
    $app->post('/partitions', \App\Action\Partition\PartitionsViewByCompositionAction::class)
        ->add(ApiCheckMiddleware::class);

};

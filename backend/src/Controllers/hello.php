<?php

use Slim\Http\Request; //namespace
use Slim\Http\Response; //namespace

$app->get('/hello/{name}', function (Request $request, Response $response, array $arg){
    $name = $arg['name'];
    $response->getBody() -> write ("Hello World, $name");
    return $response;
});

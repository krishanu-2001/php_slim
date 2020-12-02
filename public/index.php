<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/../vendor/autoload.php';
require '../src/config/db.php';

$app = new Slim\App;

$app->get('/', function ($request, $response) {
    return 'hello world';
});

$app->get('/hello/{name}', function(Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->get('/api/coders', function(Request $request, Response $response) {
    $sql = "SELECT * FROM coders";
    try{
        //get db object
        $db = new db();
        //connnect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customers);

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'} }';
    }
    
    return $response;
});

$app->run();
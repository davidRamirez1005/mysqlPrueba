<?php
    header("Access-Control-Allow-Origin: *");
    require "../vendor/autoload.php";
    $dotenv = Dotenv\Dotenv::createImmutable("../")->load();
    $router = new \Bramus\Router\Router();

    $router->mount('/campers', function() use($router){
        $router->post('/', '\App\crub@postAll');
        $router->put('/', '\App\crub@putAll');
        $router->get("/", '\App\crub@getAll');
        $router->delete('/', function() { 
            $cox = new \App\connect();
            $_DATA = json_decode(file_get_contents("php://input"));
            $res = $cox->con->prepare("DELETE FROM person WHERE DNI=:dni");
            $res->bindParam(':dni', $_DATA->dni);
            $res->execute();
            print_r($res->rowCount());
        });
    });

    










    $router->run();
?>
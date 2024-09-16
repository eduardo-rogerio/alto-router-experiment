<?php

use Mixd\Src\PersonController;

require 'vendor/autoload.php';

$router = new AltoRouter();

$router->map('GET', '/', function() {
    echo pi();
});

$router->map('GET', '/person/[i:age]?/[a:name]?', [PersonController::class, 'me']);

$match = $router->match();

if ($match) {
    // Se o destino for uma função anônima (closure)
    if (is_callable($match['target'])) {
        // Chamar diretamente a closure passando os parâmetros
        call_user_func_array($match['target'], $match['params']);
    }
    // Se o destino for um array (controller e método)
    elseif (is_array($match['target']) && is_callable([new $match['target'][0], $match['target'][1]])) {
        // Criar uma instância do controller e chamar o método
        call_user_func_array([new $match['target'][0], $match['target'][1]], $match['params']);
    } else {
        // Se a rota não for encontrada ou não puder ser executada
        header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        echo '404 Not Found';
    }
} else {
    // Se a rota não for encontrada
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo '404 Not Found';
}

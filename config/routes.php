<?php 

declare(strict_types=1);

return [
    'GET|/' => \Carefy\Mvc\Controller\CensoListController::class,
    'GET|/importar' => \Carefy\Mvc\Controller\CensoController::class,
    'POST|/importar' => \Carefy\Mvc\Controller\CensoController::class,
    'GET|/visualizar' => \Carefy\Mvc\Controller\CensoController::class,
    'POST|/gravar' => \Carefy\Mvc\Controller\CensoController::class,
    'GET|/confirmacao' => \Carefy\Mvc\Controller\CensoController::class
];

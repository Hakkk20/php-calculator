<?php 

require_once __DIR__ . '/src/Controller/CalculatorController.php';
require_once __DIR__ . '/src/Model/Calculator.php';


use App\Controller\CalculatorController;

$controller = new CalculatorController();
$controller->handleRequest();

$result = $controller->result;
$error = $controller->error;

require_once __DIR__ . '/src/View/CalculatorView.php';

?>

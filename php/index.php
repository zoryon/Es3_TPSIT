<?php
use Slim\Factory\AppFactory;

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/controllers/AlunniController.php";

$app = AppFactory::create();

$app->get("/alunni", "AlunniController:index");
$app->get("/alunni/{id}", "AlunniController:view");
$app->post("/alunni", "AlunniController:create");
$app->put("/alunni/{id}", "AlunniController:update");
$app->delete("/alunni/{id}", "AlunniController:destroy");


$app->run();

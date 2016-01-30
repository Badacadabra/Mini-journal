<?php

/**
 * Contrôleur
 *
 * @file   index.php
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

session_start();

use Bv21411850\Emdn2\Utils\Autoload\Autoloader;
use Bv21411850\Emdn2\Controller\FrontController;
use Bv21411850\Emdn2\Routing\Router;
use Bv21411850\Emdn2\Http\Request;
use Bv21411850\Emdn2\Http\Response;

require_once "config/config.php";
require_once "classes/Bv21411850/Emdn2/Utils/Autoload/Autoloader.class.php";

$squelette = "ui/pages/squelette.html";
$authInfos = '';
$titre = '';
$contenu = '';

// Autoload des classes
$autoloader = new Autoloader();

try {
    // On crée les objets requête et réponse qui vont bien
    $request = new Request($_GET);
    $response = new Response('');
    $params = $request->getAllGetParams();
    if (!empty($params)) {
        // Routage
        $router = new Router();
        $router->parseRequest($request);
        // On lance le Front Controller
        $controller = new FrontController($router);
        $controller->run($request, $response);
        // On récupère les données à afficher
        $authInfos .= $controller->getAuthInfos();
        $titre .= $response->getPart('title');
        $contenu .= $response->getPart('content');
    } else {
        $titre = "Mini-journal de Baptiste Vannesson";
        $contenu = "<figure id=\"image-accueil\">";
        $contenu .= "<img src=\"ui/images/notepad.png\" alt=\"Mini-journal\" />";
        $contenu .= "</figure>";
        $response->setPart('title', $titre);
        $response->setPart('content', $contenu);
        $authInfos .= "<div id=\"accueil\"><p>Devoir EMDN2</p></div>";
    }
} catch (\Exception $e) {
    $titre .= "Une erreur s'est glissée dans cette page";
    $contenu .= $e->getMessage();
    $contenu .= "<pre>{$e->getTraceAsString()}</pre>";
}

// Fin

ob_start();
require_once $squelette;
$html = ob_get_contents();
ob_end_clean();

echo $html;

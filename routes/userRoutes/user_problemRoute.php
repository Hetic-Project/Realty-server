<?php
require_once './debug.php';
// inclure les controllers nécessaires
require_once './controllers/userControllers/user_problemController.php';

// Obtenir le chemin de l'URL demandée
$url = $_SERVER['REQUEST_URI'];

// Obtenir la méthode HTTP actuelle
$method = $_SERVER['REQUEST_METHOD'];

$matched = false;

switch ($url) {
    // Route utilisateur de l'API
    // preg_mag est utiliser pour les routes en GET qui on un paramettre dans l'url
    case '/user/problemUserAdd':
        $controller = new User_problem();
        if ($method == 'POST') {
            $controller->addUserProblem();
            $matched = true;
        } else {
            header('HTTP/1.1 405 Method Not Allowed');
            header('Allow: POST');
        };
        break;
    
    case preg_match('@^/user/problemUserGetOne/(\d+)$@', $url, $matches) ? $url : '':
        $controller = new User_problem();
        if ($method == 'GET') {
            $controller->getOneUserProblem($matches[1]);
            $matched = true;
        } else {
            header('HTTP/1.1 405 Method Not Allowed');
            header('Allow: GET');
        };
        break;
    

    case '/user/problemUserGetAll':
            $controller = new User_problem();
            if ($method == 'GET') {
                $controller->getAllUserProblem();
                $matched = true;
            } else {
                header('HTTP/1.1 405 Method Not Allowed');
                header('Allow: GET');
            };
            break;

    case '/user/problemUpdate':
            $controller = new User_problem();
            if ($method == 'POST') {
                $controller->updateUserProblemStatut();
                $matched = true;
            } else {
                header('HTTP/1.1 405 Method Not Allowed');
                header('Allow: GET');
            };
            break;
}
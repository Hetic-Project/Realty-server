<?php
require_once './debug.php';
// inclure les controllers nécessaires
require_once './controllers/apartmentControllers/apartment_rentalController.php';

// Obtenir le chemin de l'URL demandée
$url = $_SERVER['REQUEST_URI'];

// Obtenir la méthode HTTP actuelle
$method = $_SERVER['REQUEST_METHOD'];

$matched = false;

switch ($url) {
    // Route utilisateur de l'API
    // preg_mag est utiliser pour les routes en GET qui on un paramettre dans l'url
    case '/apartment/add/apartmentRental':
        $controller = new Apartment_rental();
        if ($method == 'GET') {
            $controller->addApartmentRental();
            $matched = true;
        } else {
            header('HTTP/1.1 405 Method Not Allowed');
            header('Allow: GET');
        };
        break;
        
    case preg_match('@^/apartment/get/oneApartmentRental/(\d+)$@', $url, $matches) ? $url : '':
        $controller = new Apartment_rental();
        if ($method == 'GET') {
            $controller->getOneApartmentRental($matches[1]);
            $matched = true;
        } else {
            header('HTTP/1.1 405 Method Not Allowed');
            header('Allow: GET');
        };
        break;

    case '/apartment/get/allApartmentRental':
        $controller = new Apartment_rental();
        if ($method == 'GET') {
            $controller->getAllApartmentRental();
            $matched = true;
        } else {
            header('HTTP/1.1 405 Method Not Allowed');
            header('Allow: GET');
        };
        break;
    
    case '/apartment/update/apartmentRental/':
        $controller = new Apartment_rental();
        if ($method == 'POST') {
            $controller->updateApartmentRental();
            $matched = true;
        } else {
            header('HTTP/1.1 405 Method Not Allowed');
            header('Allow: POST');
        };
        break;

    case preg_match('@^/delete/apartmentRental/(\d+)$@', $url, $matches) ? $url : '':
            $controller = new Apartment_rental();
            if ($method == 'GET') {
                $controller->deleteApartmentRental($matches[1]);
                $matched = true;
            } else {
                header('HTTP/1.1 405 Method Not Allowed');
                header('Allow: GET');
            };
            break;
}
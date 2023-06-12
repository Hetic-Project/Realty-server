<?php
//Inclusion du fichier pour afficher les erreurs 
require_once './debug.php';
//Inclusion du fichier pour la connexion a la BDD
require_once './database/client.php';

//Création d'un controller (objet) de la table apartment_service de la BDD
class Apartment_service {
    
    function getAllApartmentService($apartment_id){
        $db = new Database();

        $connexion = $db->getconnection();

        $request = $connexion->prepare("
            SELECT *
            FROM apartment_service
            WHERE apartment_id = :apartment_id
            );
        ");

        $request->execute([':apartment_id' => $apartment_id]);

        $apartmentInfos = $request->fetchAll(PDO::FETCH_ASSOC);

        $connexion = null;

        header('Content-Type: application/json');
        echo json_encode($apartmentInfos);
    }

    function addApartmentService(){
        
    }

    function updateOneApartmentService(){
        
    }

    function deleteOneApartmentService(){
        
    }

}
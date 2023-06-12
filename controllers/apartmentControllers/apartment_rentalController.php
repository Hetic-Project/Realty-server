<?php
//Inclusion du fichier pour afficher les erreurs 
require_once './debug.php';
//Inclusion du fichier pour la connexion a la BDD
require_once './database/client.php';

//Création d'un controller (objet) de la table apartment_rental de la BDD
class Apartment_rental {
    
    function addApartmentRental(){

    }

    function getOneApartmentRental($rental_id){
        $db = new Database();

        $connexion = $db->getconnection();

        $request = $conexion->prepare("
            SELECT *
            FROM apartment_renal
            JOIN apartment
            ON apartment_rental_apartment_id = apartment_id
            JOIN user
            ON apartment_rental_user_id = user_id
            WHERE rental_id = :rental_id
        ");

        $request->execute([':rental_id' => $rental_id]);

        $apartmentInfos = $request->fetch(PDO::FETCH_ASSOC);

        $connexion= null;

        header('Content-Type: application/json');
        echo json_encode($apartmentInfos);
    }

    function getAllApartmentRental(){
        
        $db = new Database();

        $connexion = $db->getconnection();
        
        $request = $connexion->prepare("
            SELECT 
            apartment_adress, 
            apartment_zip_code, 
            apartment_city,
            apartment_rental_start,
            apartment_rental_end,
            user_firstname,
            user_lastname
            FROM apartment_rental
            JOIN apartment ON apartment_rental_apartment_id = apartment_id
            JOIN user ON apartment_rental_user_id = user_id
            WHERE apartment_rental_start <= CURDATE()
            ORDER BY apartment_rental_start DESC;
        ");

        $request->execute();

        $apartmentInfos = $request->fetchAll(PDO::FETCH_ASSOC);

        $connexion = null;

        header('Content-Type: application/json');
        echo json_encode($apartmentInfos);

        
    }

    function updateApartmentRental($rental_id){
        
    }

    function deleteApartmentRental($rental_id){
        
    }
}
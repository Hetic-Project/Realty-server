<?php
//Inclusion du fichier pour afficher les erreurs 
require_once './debug.php';
//Inclusion du fichier pour la connexion a la BDD
require_once './database/client.php';

//Création d'un controller (objet) de la table apartment_rental de la BDD
class Apartment_rental {
    
    function addApartmentRental(){
        $db = new Database();

        $connexion = $db->getconnection();

        $user_id = $_POST["user_id"];
        $apartment_id = $_POST["apartment_id"];
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];

        $request = $conexion->prepare("
            SELECT *
            FROM apartment_rental
            WHERE apartment_rental.apartment_rental_apartement_id = :apartment_id
        ");
        $request->execute([":apartment_id" => $apartment_id]);

        $apartment_rental = $request->fetchAll(PDO::FETCH_ASSOC);

        if($apartment_rental){
            if(
                // si la date de départ du client est = a une date de départ d'une location en cours
                $start_date == $apartment_rental['apartment_rental_start']
                // si la date de retour d'un client est = a la date de départ d'une location
                || $end_date == $apartment_rental['apartment_rental_end']
                // si la date de départ et de retour du client est égale a une date de départ et de fin d'une location
                || $start_date == $apartment_rental['apartment_rental_start'] && $end_date == $apartment_rental['apartment_rental_end']
                // si une date de départ d'un client est comprise entre une date de début et de fin de location
                || $start_date > $apartment_rental['apartment_rental_start'] && $start_date < $apartment_rental['apartment_rental_end']
                // si la date de retour d'un client est comprise entre une date de départ ou de fin d'une location
                || $end_date < $apartment_rental['apartment_rental_end'] && $end_date > $apartment_rental['apartment_rental_start']
                // si la date de debut d'une location est comprise entre une date de départ et de retour d'un client
                || $apartment_rental['apartment_rental_start'] >  $start_date && $apartment_rental['apartment_rental_start'] < $start_date
                // si la date de fin d'une location est comprise entre une date de départ et de retour d'un client
                || $apartment_rental['apartment_rental_end'] < $end_date && $apartment_rental['apartment_rental_end'] > $end_date
            ){
                $connexion= null;
                $message = "la période choisie est indisponible";
                header('Location: http://localhost:3000/pages/location/locationdetails.php?message=' . urlencode($message));
                exit;

            }else{
                // sinon 
                $request = $conexion->prepare("

                ");
                $request->execute();

                $connexion= null;
                $message = "Votre location a été réserver avec succes";
                header('Location: http://localhost:3000/pages/location/locationdetails.php?message=' . urlencode($message));
                exit;
            }

        }else{
            // si il n'y a pas de résultat insérer les donnée
        }
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

    function getAllApartmentRental($apartment_id){
        
        $db = new Database();

        $connexion = $db->getconnection();
        
        $request = $connexion->prepare("
            SELECT
            apartment_id,  
            apartment_rental_start,
            apartment_rental_end
            FROM apartment_rental
            JOIN apartment ON apartment_rental.apartment_rental_apartement_id = apartment_id
            WHERE apartment.apartment_id = :apartment_id
            AND apartment_rental_start >= CURDATE()
            ORDER BY apartment_rental_start DESC;
        ");

        $request->execute([':apartment_id' => $apartment_id]);

        $apartmentsRentals = $request->fetchAll(PDO::FETCH_ASSOC);

        $connexion = null;

        header('Content-Type: application/json');
        echo json_encode($apartmentsRentals);

        
    }

    function updateApartmentRental($rental_id){
        
    }

    function deleteApartmentRental($rental_id){
        
    }
}
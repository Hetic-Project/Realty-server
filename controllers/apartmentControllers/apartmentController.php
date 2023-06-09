<?php
//Inclusion du fichier pour afficher les erreurs 
require_once './debug.php';
//Inclusion du fichier pour la connexion a la BDD
require_once './database/client.php';

//Création d'un controller (objet) de la table apartment de la BDD
class Apartment {
    
    function addApartment(){
        
        $db = new Database();

        $connexion = $db->getconnection();

        $title = $_POST["title"];
        $description = $_POST["description"];
        $mainPicture = $_POST["mainPicture"];
        $picture360 = $_POST["picture360"];
        $adress = $_POST["adress"];
        $zipCode = $_POST["zipCode"];
        $city = $_POST["city"];
        $price = $_POST["price"];
        $size = $_POST["size"];
        $bedroom = $_POST["bedroom"];
        $capacity = $_POST["capacity"];




    }

    function updateApartment(){
        
    }

    function getOneApartment($apartment_id){
        // get avec parametre
        $db = new Database();

        $connexion = $db->getconnection();

        // récupérer les infos d'un appartement 
        $request = $conexion->prepare("
            SELECT *
            FROM apartment
            WHERE apartment_id = :apartment_id
        ");
        
        $request->execute([':apartment_id' => $apartment_id]);

        $apartmentInfos = $request->fetch(PDO::FETCH_ASSOC);

        $connexion= null;

        header('Content-Type: application/json');
        echo json_encode($apartmentInfos);
    }

    function getAllApartment(){
        
        // 1. J'utilise l'objet Database
        $db = new Database();

        // 2. J'appelle la fonction getconnection de Database
        $connexion = $db->getconnection();

        // 3. je prépare ma requète
        $request = $connexion->prepare("
        SELECT *
        FROM apartment
        LEFT JOIN apartment_rental ON apartment_rental_apartement_id = apartment_id
        WHERE (
            CURDATE() < apartment_rental.apartment_rental_start
            OR CURDATE() > apartment_rental.apartment_rental_end
            OR apartment_rental.apartment_rental_start IS NULL
            OR apartment_rental.apartment_rental_end IS NULL
        );
        
        ");
        // 4. J'exécute ma requête
        $request->execute();

        // 5. je renvoie les données au front en json
        $apartmentInfos = $request->fetchAll(PDO::FETCH_ASSOC);

        $connexion= null;
        
        // je renvoie au front les données au format json
        header('Content-Type: application/json');
        echo json_encode($apartmentInfos);


    }

    function deleteApartment($apartment_id){

        $db = new Database();

        $connexion = $db->getconnection();
        
        $request = $connexion->prepare("
            DELETE FROM apartment
            WHERE apartment_id = :apartment_id
        ");

        $request->execute([':apartment_id' => $apartment_id]);

        $connexion= null;

        $message = "l'appartement à bien été suprimer";
        header('Location: http://localhost:3000/messagePages/viewAllMessages.php=' . urlencode($message));
        exit;

    }

}
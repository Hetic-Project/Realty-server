<?php
//Inclusion du fichier pour afficher les erreurs 
require_once './debug.php';
//Inclusion du fichier pour la connexion a la BDD
require_once './database/client.php';

//Création d'un controller (objet) de la table apartment de la BDD
class Apartment {
    
    function addApartment(){

    }

    function updateApartment(){
        
    }

    function getOneApartment(){
        
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
        ");
        // 4. J'exécute ma requête
        $request->execute();

        // 5. je renvoie les données au front en json
        $apartmentInfos = $request->fetch(PDO::FETCH_ASSOC);

        $connexion= null;
        
        // je renvoie au front les données au format json
        header('Content-Type: application/json');
        echo json_encode($apartmentInfos);


    }

    function deleteApartment(){
        
    }

}
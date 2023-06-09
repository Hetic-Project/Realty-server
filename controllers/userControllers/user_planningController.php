<?php
//Inclusion du fichier pour afficher les erreurs 
require_once './debug.php';
//Inclusion du fichier pour la connexion a la BDD
require_once './database/client.php';

//Création d'un controller (objet) de la table User_planning de la BDD
class User_planning {
    
    function getOnePlanningForOneUser(){
        // get
        // afficher le planning d'un utilisateur
    }

    function getAllPlanningForOneUser(){
        // Get
        // Afficher tous les planning d'un utilisateur
    }

    function getAllPlanningForOneApartment(){
        // get
        // Afficher tous les plannings d'un appartement
    }

    function getOnePlanningForOneApartement(){
        //get
        // afficher un planning d'un appartement
    }

    function addPlanning(){
        // post
        // ajouter un planning
    }

    function updateOnePlanning(){
        //post
        // modifier un planning
    }

    function deletePlanning(){
        // post
        // suprimer un planning
    }
    
}
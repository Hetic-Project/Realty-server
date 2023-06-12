<?php
//Inclusion du fichier pour afficher les erreurs 
require_once './debug.php';
//Inclusion du fichier pour la connexion a la BDD
require_once './database/client.php';

//Création d'un controller (objet) de la table user_problem de la BDD
class user_problem {
    
    class UserProblem {
    
        function addUserProblem(){
    
            // 1. Initialiser l'objet Database
            $db = new Database();
    
            // 2. Obtenir la connexion à la base de données
            $connexion = $db->getConnection();
    
            // 3. Récupérer les champs du formulaire
            $user_id = $_POST['user_id'];
            $user_problem_description = $_POST['user_problem_description'];
            $user_problem_date = $_POST['user_problem_date'];
    
            // 4. Préparer la requête pour insérer le problème d'utilisateur dans la base de données
            $request = $connexion->prepare("
                INSERT INTO user_problem (
                    user_id,
                    user_problem_description,
                    user_problem_date
                ) VALUES (
                    :user_id,
                    :user_problem_description,
                    :user_problem_date
                )
            ");
    
            // 5. Exécuter la requête
            $request->execute([
                ":user_id" => $user_id,
                ":user_problem_description" => $user_problem_description,
                ":user_problem_date" => $user_problem_date
            ]);

            $userInfos = $request->fetch(PDO::FETCH_ASSOC);
    
            // 6. Fermer la connexion à la base de données
            $connexion = null;
    
            // 7. Envoyer une réponse
            header('Content-Type: application/json');
            echo json_encode($userInfos);
        }
    }
    

    function getOneUserProblem(){
        
    }

    function getAllUserProblem(){
        
    }

    function updateUserProblemStatut(){
        
    }
    
}
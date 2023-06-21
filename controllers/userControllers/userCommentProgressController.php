<?php
//Inclusion du fichier pour afficher les erreurs 
require_once './debug.php';
//Inclusion du fichier pour la connexion a la BDD
require_once './database/client.php';

//Création d'un controller (objet) de la table user_review de la BDD
class Comment_progress {
    
    function addCommentProgress(){

        $db = new Database();
        $connexion = $db->getConnection();

        $user_id = $_POST['user_id'];
        $apartment_id = $_POST['apartment_id'];
        $comment = $_POST['comment'];

        $sql = $connexion->prepare(" 
            INSERT INTO comment_progress (
                comment_progress_user_id,
                comment_progress_apartment_id,
                comment_progress_comment
            )VALUES(
                :user_id,
                :apartment_id,
                :comment
            )
        ");
        // joignant le nom, le prénom et la date du message qui se trouve dans la table 
        // user

        $sql->execute([
            ':user_id' => $user_id,
            ':apartment_id' => $apartment_id,
            ':comment' => $comment
        ]
        );

        $logistic_id = '';
        $apartmentId = $apartment_id;


        $notification = $connexion->prepare("
        
        ");

        $message = $sql->fetchAll(PDO::FETCH_ASSOC);

        $connexion = null;

        header('Content-Type: application/json');
        echo json_encode($message);

    }

    function updateOneComment(){
        
    }

    function deleteOneComment(){
        
    }

    function addCommentForOneApartment(){
        
    }
    
}
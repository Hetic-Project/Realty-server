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

        $sql->execute([
            ':user_id' => $user_id,
            ':apartment_id' => $apartment_id,
            ':comment' => $comment
        ]
        );

        $commentProgress_id = $sql->lastInsertId();

        $logistic = $connexion->prepare("
            SELECT apartment_employee_logistique_user_id
            FROM apartment_employee
            WHERE apartment_employee_apartment_id = :apartment_id
        ");

        $logistic->execute([':apartment_id' => $apartment_id]);

        $idLogisticWant = $sql->fetch(PDO::FETCH_ASSOC);

        $logistic_id = $idLogisticWant['apartment_employee_logistique_user_id'];
        $apartmentId = $apartment_id;
        $message = 'Un nouveau commentaire est à valider';
        $link = 'url';
        $comment_id = $commentProgress_id;


        $notification = $connexion->prepare("
            INSERT INTO notification (
                notification_user_logistic_id,
                notification_apartment_id,
                notification_message,
                notification_link,
                notification_comment_id
            )VALUES(
                :logistic_id,
                :apartmentId,
                :message,
                :link,
                :comment_id
            )
        ");

        $notification->execute([
            ':logistic_id' => $logistic_id,
            ':apartmentId' => $apartmentId,
            ':message' => $message,
            ':link' => $link,
            ':comment_id' => $comment_id
        ]
        );

        $connexion = null;

    }

    function getAllCommentProgressForOneApartment($apartment_id){
        $db = new Database();
        $connexion = $db->getConnection();

        $sql = $connexion->prepare(" 
            SELECT *
            FROM comment_progress
            WHERE comment_progress_apartment_id = :apartment_id
        ");

        $sql->execute([':apartment_id' => $apartment_id]);

        $commentsProgress = $sql->fetch(PDO::FETCH_ASSOC);

        $connexion = null;

        header('Content-Type: application/json');
        echo json_encode($commentsProgress);
    }

    function commentProgressValidate(){
        $db = new Database();
        $connexion = $db->getConnection();

        $sql = $connexion->prepare(" 
            SELECT notification_id
            FROM notification
            WHERE 
        ");

        $notification_id = $_POST['notification_id'];
        
    }

    function commentProgressDelete($comment_id){
        
    }
    
}
<?php
//Inclusion du fichier pour afficher les erreurs 
require_once './debug.php';
//Inclusion du fichier pour la connexion a la BDD
require_once './database/client.php';

//Création d'un controller (objet) de la table user_review de la BDD
class User_review {
    
    function getAllCommentForOneApartment($apartment_id) {
        $db = new Database();
        $connection = $db->getConnection();
    
        // Vérification si l'appartement existe
        $checkApartmentQuery = $connection->prepare("
            SELECT COUNT(*) as count
            FROM apartment
            WHERE apartment_id = :apartment_id
        ");
        $checkApartmentQuery->execute([
            ":apartment_id" => $apartment_id
        ]);
        $apartmentExists = $checkApartmentQuery->fetchColumn();
    
        if (!$apartmentExists) {
            // Si l'appartement n'existe pas, vous pouvez effectuer une action ou renvoyer un message d'erreur approprié
            $message = "L'appartement spécifié n'existe pas.";
            // Vous pouvez rediriger l'utilisateur vers une page spécifique, afficher un message d'erreur, etc.
            $response = [
                "success" => false,
                "message" => $message
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            return;
        }
    
        // Récupération de tous les avis pour un appartement donné
        $getCommentsQuery = $connection->prepare("
            SELECT *
            FROM user_review
            WHERE apartment_id = :apartment_id
        ");
        $getCommentsQuery->execute([
            ":apartment_id" => $apartment_id
        ]);
        $comments = $getCommentsQuery->fetchAll(PDO::FETCH_ASSOC);
    
        // Fermeture de la connexion
        $connection = null;
    
        // Réponse JSON avec la liste des avis pour l'appartement donné
        $response = [
            "success" => true,
            "comments" => $comments
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    

    function updateOneComment(){
        
    }

    function deleteOneComment($comment_id) {
        $db = new Database();
        $connection = $db->getConnection();
    
        // Vérification si le commentaire existe
        $checkCommentQuery = $connection->prepare("
            SELECT COUNT(*) as count
            FROM user_review
            WHERE comment_id = :comment_id
        ");
        $checkCommentQuery->execute([
            ":comment_id" => $comment_id
        ]);
        $commentExists = $checkCommentQuery->fetchColumn();
    
        if (!$commentExists) {
            // Si le commentaire n'existe pas, vous pouvez effectuer une action ou renvoyer un message d'erreur approprié
            $message = "Le commentaire spécifié n'existe pas.";
            // Vous pouvez rediriger l'utilisateur vers une page spécifique, afficher un message d'erreur, etc.
            $response = [
                "success" => false,
                "message" => $message
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            return;
        }
    
        // Suppression du commentaire
        $deleteCommentQuery = $connection->prepare("
            DELETE FROM user_review
            WHERE comment_id = :comment_id
        ");
        $deleteCommentQuery->execute([
            ":comment_id" => $comment_id
        ]);
    
        // Fermeture de la connexion
        $connection = null;
    
        // Réponse JSON indiquant que le commentaire a été supprimé avec succès
        $response = [
            "success" => true,
            "message" => "Le commentaire a été supprimé avec succès."
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
    function addCommentForOneApartment() {
        // Vérifier si toutes les données requises sont présentes
        if (!isset($_POST['user_id']) || !isset($_POST['apartment_id']) || !isset($_POST['comment']) || !isset($_POST['rating'])) {
            // Les données requises sont manquantes, renvoyer une réponse d'erreur
            $response = [
                "success" => false,
                "message" => "Données manquantes. Veuillez fournir user_id, apartment_id, comment et rating."
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            return;
        }
    
        // Récupérer les données du formulaire
        $user_id = $_POST['user_id'];
        $apartment_id = $_POST['apartment_id'];
        $comment = $_POST['comment'];
        $rating = $_POST['rating'];
    
        // Connexion à la base de données
        $db = new Database();
        $connexion = $db->getConnection();
    
        // Vérification si l'utilisateur existe
        $checkUserQuery = $connexion->prepare("
            SELECT COUNT(*) as count
            FROM user
            WHERE user_id = :user_id
        ");
        $checkUserQuery->execute([
            ":user_id" => $user_id
        ]);
        $userExists = $checkUserQuery->fetchColumn();
    
        if (!$userExists) {
            // Si l'utilisateur n'existe pas, renvoyer une réponse d'erreur
            $response = [
                "success" => false,
                "message" => "L'utilisateur spécifié n'existe pas."
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            return;
        }
    
        // Vérification si l'appartement existe
        $checkApartmentQuery = $connexion->prepare("
            SELECT COUNT(*) as count
            FROM apartment
            WHERE apartment_id = :apartment_id
        ");
        $checkApartmentQuery->execute([
            ":apartment_id" => $apartment_id
        ]);
        $apartmentExists = $checkApartmentQuery->fetchColumn();
    
        if (!$apartmentExists) {
            // Si l'appartement n'existe pas, renvoyer une réponse d'erreur
            $response = [
                "success" => false,
                "message" => "L'appartement spécifié n'existe pas."
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            return;
        }
    
        // Ajout du commentaire
        $addCommentQuery = $connexion->prepare("
            INSERT INTO user_review (user_id, apartment_id, comment, rating)
            VALUES (:user_id, :apartment_id, :comment, :rating)
        ");
    
        $addCommentQuery->execute([
            ":user_id" => $user_id,
            ":apartment_id" => $apartment_id,
            ":comment" => $comment,
            ":rating" => $rating
        ]);
    
        // Fermeture de la connexion à la base de données
        $connexion = null;
    
        // Réponse JSON indiquant que le commentaire a été ajouté avec succès
        $response = [
            "success" => true,
            "message" => "Le commentaire a été ajouté avec succès."
        ];
       
    

    function addCommentForOneApartment() {
        $db = new Database();
        $connection = $db->getConnection();
    
        // Récupération des données du formulaire en POST
        $apartment_id = $_POST['apartment_id'];
        $user_id = $_POST['user_id'];
        $comment = $_POST['comment'];
    
        // Vérification si l'appartement existe
        $checkApartmentQuery = $connection->prepare("
            SELECT COUNT(*) as count
            FROM apartment
            WHERE apartment_id = :apartment_id
        ");
        $checkApartmentQuery->execute([
            ":apartment_id" => $apartment_id
        ]);
        $apartmentExists = $checkApartmentQuery->fetchColumn();
    
        if (!$apartmentExists) {
            // Si l'appartement n'existe pas, vous pouvez effectuer une action ou renvoyer un message d'erreur approprié
            $message = "L'appartement spécifié n'existe pas.";
            // Vous pouvez rediriger l'utilisateur vers une page spécifique, afficher un message d'erreur, etc.
            $response = [
                "success" => false,
                "message" => $message
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            return;
        }
    
        // Insertion du commentaire dans la base de données
        $addCommentQuery = $connection->prepare("
            INSERT INTO user_review (apartment_id, user_id, comment)
            VALUES (:apartment_id, :user_id, :comment)
        ");
        $addCommentQuery->execute([
            ":apartment_id" => $apartment_id,
            ":user_id" => $user_id,
            ":comment" => $comment
        ]);
    
        // Récupération de l'ID du commentaire ajouté
        $comment_id = $connection->lastInsertId();
    
        // Récupération des informations du commentaire ajouté
        $getCommentQuery = $connection->prepare("
            SELECT *
            FROM user_review
            WHERE comment_id = :comment_id
        ");
        $getCommentQuery->execute([
            ":comment_id" => $comment_id
        ]);
        $commentInfo = $getCommentQuery->fetch(PDO::FETCH_ASSOC);
    
        // Fermeture de la connexion
        $connection = null;
    
        // Réponse JSON indiquant que le commentaire a été ajouté avec succès
        $response = [
            "success" => true,
            "message" => "Le commentaire a été ajouté avec succès.",
            "comment" => $commentInfo
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
    
}
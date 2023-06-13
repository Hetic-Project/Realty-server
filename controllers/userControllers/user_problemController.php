<?php
//Inclusion du fichier pour afficher les erreurs 
require_once './debug.php';
//Inclusion du fichier pour la connexion a la BDD
require_once './database/client.php';

//Création d'un controller (objet) de la table user_problem de la BDD
class user_problem {

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
    
    function getOneUserProblem($problemId, $loggedInUserId){
        // 1. Utilisation de l'objet Database
        $db = new Database();
    
        // 2. Appel de la fonction getconnection de Database
        $connexion = $db->getconnection();
    
        // 3. Préparation de la requête pour récupérer un problème utilisateur spécifié
        $request = $connexion->prepare("SELECT * FROM user_problem WHERE user_problem_id = :problemId");
    
        // 4. Exécution de la requête en utilisant le problème ID spécifié
        $request->execute([":problemId" => $problemId]);
    
        // 5. Récupération des données du problème
        $userProblem = $request->fetch(PDO::FETCH_ASSOC);
    
        // 6. Vérification de l'existence du problème
        if ($userProblem) {
            // Vérification si l'utilisateur connecté est autorisé à accéder au problème
            if ($userProblem['user_id'] == $loggedInUserId) {
                // Problème trouvé et utilisateur autorisé, renvoyer les données au format JSON
                header('Content-Type: application/json');
                echo json_encode($userProblem);
            } else {
                // Problème introuvable ou accès non autorisé, renvoyer un message d'erreur
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Accès non autorisé au problème.']);
            }
        } else {
            // Problème introuvable, renvoyer un message d'erreur
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Le problème spécifié n\'existe pas.']);
        }
    }

    function getAllUserProblem($loggedInUserId){
        // 1. Utilisation de l'objet Database
        $db = new Database();
    
        // 2. Appel de la fonction getconnection de Database
        $connexion = $db->getconnection();
    
        // 3. Préparation de la requête pour récupérer tous les problèmes utilisateur
        $request = $connexion->prepare("
        SELECT *
        FROM user_problem");
    
        // 4. Exécution de la requête
        $request->execute();
    
        // 5. Récupération des données des problèmes utilisateur
        $userProblems = $request->fetchAll(PDO::FETCH_ASSOC);
    
        // 6. Vérification de l'existence des problèmes
        if ($userProblems) {
            // Tableau pour stocker les problèmes autorisés
            $authorizedProblems = [];
    
            // Parcours des problèmes
            foreach ($userProblems as $problem) {
                // Vérification si l'utilisateur connecté est autorisé à accéder au problème
                if ($problem['user_id'] == $loggedInUserId) {
                    $authorizedProblems[] = $problem;
                }
            }
    
            // Renvoyer les problèmes autorisés au format JSON
            header('Content-Type: application/json');
            echo json_encode($authorizedProblems);
        } else {
            // Aucun problème trouvé, renvoyer un message d'erreur
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Aucun problème utilisateur trouvé.']);
        }
    }
    

    function updateUserProblemStatut(){
        // Vérification si la méthode de la requête est bien POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('HTTP/1.1 405 Method Not Allowed');
            echo json_encode(['error' => 'Méthode non autorisée.']);
            return;
        }
    
        // Récupération des données du formulaire
        $problemId = $_POST['problemId'];
        $newStatus = $_POST['newStatus'];
    
        // Validation des données (ajoutez vos propres validations ici)
    
        // 1. Utilisation de l'objet Database
        $db = new Database();
    
        // 2. Appel de la fonction getconnection de Database
        $connexion = $db->getconnection();
    
        // 3. Préparation de la requête pour mettre à jour le statut du problème utilisateur
        $request = $connexion->prepare("UPDATE user_problem SET problem_statut = :newStatus WHERE problem_id = :problemId");
    
        // 4. Exécution de la requête avec les paramètres
        $request->execute([
            ":newStatus" => $newStatus,
            ":problemId" => $problemId
        ]);
    
        // 5. Vérification si la mise à jour a été effectuée
        if ($request->rowCount() > 0) {
            // Mise à jour réussie, renvoyer une réponse JSON avec un message de succès
            header('Content-Type: application/json');
            echo json_encode(['success' => 'Statut du problème utilisateur mis à jour avec succès.']);
        } else {
            // Aucune ligne affectée, le problème n'existe peut-être pas ou le statut est déjà le même
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Impossible de mettre à jour le statut du problème utilisateur. Vérifiez les informations fournies.']);
        }
    }
}
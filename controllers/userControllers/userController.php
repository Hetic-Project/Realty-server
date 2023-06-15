<?php
//Inclusion du fichier pour afficher les erreurs 
require_once './debug.php';
//Inclusion du fichier pour la connexion a la BDD
require_once './database/client.php';

//Création d'un controller (objet) de la table User de la BDD
class User {
    
    function createAccount(){

        // 1. j'initialise l'objet Database
        $db = new Database();

        // 2. j'utilise la fonction getconnection de l'objet Database
        $connexion = $db->getconnection();

        // 3. Si la méthod est en post, je récupère les champs du formulaire
        // ex. <input type='text' name='firstname />
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $birthday = $_POST['birthday'];


        // 4. Je hash le mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // 5. je prépare ma requète
        $request = $connexion->prepare("
        INSERT INTO user (
            user_firstname,
            user_lastname,
            user_mail,
            user_password,
            user_birth
        ) VALUES (
            :firstname,
            :lastname,
            :mail,
            :password,
            :birthday
        )");

        // 6. J'exécute le requète    
        $request->execute(
            [
                ":firstname" => $firstname,
                ":lastname" => $lastname,
                ":mail" => $mail,
                ":password" => $hashed_password,
                ":birthday" => $birthday
            ]
        );
        // 7. Fermeture de la connexion
        $connexion = null;

        // 8. J'envoie une réponse
        $message = "le compte a bien été créé";
        header('Location: http://localhost:3000/Page/login.php?message=' . urlencode($message));
        exit;

    }


    function loginAccount(){

        $db = new Database();

        $connexion = $db->getconnection();

        $mail = $_POST['mail'];
        $password = $_POST['password'];

        // si les champs son renseigner
        if($mail && $password) {
            // Requêtes SQL
            $request = $connexion->prepare("
                SELECT *
                FROM user 
                WHERE user_mail = :mail
            ");
            $request->execute([":mail" => $mail]);

            // je stock le résultat de la requete dans une variable
            $userInfos = $request->fetch(PDO::FETCH_ASSOC);

            // je vérifie le mot de passe
            if ($userInfos && password_verify($password, $userInfos['user_password'])) {
                // si le mot de passe est bon, je vérifi si le compte est active
                if ($userInfos['user_active'] == 1){
                    // j'ouvre une session
                    session_start();
                    // je stock dans la session l'id
                    $_SESSION['id'] = $userInfos['user_id'];
                    $_SESSION['statut'] = $userInfos['user_statut'];
                    header('HTTP/1.1 200 OK');
                    $message = "Connexion réussie";
                    header('Location: http://localhost:3000/Page/publications.php?message=' . urlencode($message));
                    exit;

                }else {
                    // si le compte est désactiver 
                    header('Location: http://localhost:3000/Page/login.php?id=' . urlencode($userInfos['id']));
                    exit;
                }
                
            } else {
                // si le mail ou le mot de passe est incorect
                header("HTTP/1.1 402");
                $message = "le nom d'utilisateur ou le mot de passe est incorrect";
                header('Location: http://localhost:3000/Page/login.php?message=' . urlencode($message));
                exit;
            }
        } else {
            // si il y a un champ qui n'est pas rempli
            $message = "Tout les champs sont requis";
            header('Location: http://localhost:3000/Page/login.php?message=' . urlencode($message));
            exit;
        }
        
        // Fermeture de la connexion
        $connexion = null;
    }

    function getAllUserWhereStatutIsMenage(){
        // 1. J'utilise l'objet Database
        $db = new Database();

        // 2. J'appelle la fonction getconnection de Database
        $connexion = $db->getconnection();

        // 3. je prépare ma requète attention je veut récupérer les users dont le statut 
        $request = $connexion->prepare("
            SELECT *
            FROM user
            WHERE user_statut = 'Menage'
        ");

        // 4. J'exécute ma requête
        $request->execute();

        // 5. je renvoie les données au front en json
        $userInfos = $request->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($userInfos);

    }

    function getOneUser($user_id){

        $db = new Database();

        // 2. J'appelle la fonction getconnection de Database
        $connexion = $db->getconnection();

        // 3. je prépare ma requète attention je veut récupérer un user
        $request = $connexion->prepare(" 
            SELECT *
            FROM user
            WHERE user_id = :user_id
        ");
        // 4. J'exécute ma requête
        $request->execute([ ":user_id" => $user_id]);

        $userInfos = $request->fetch(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($userInfos);

    }

    function searchUser($params){
        $db = new Database();

        // 2. J'appelle la fonction getconnection de Database
        $connexion = $db->getconnection();

        // 3. je prépare ma requète attention je veut rechercher les users
        $request = $connexion->prepare("
        SELECT user_firstname, user_lastname, user_id
        FROM user
        WHERE users_firstname LIKE :params 
        OR users_lastname LIKE :params
    ");

        // 4. J'exécute ma requête
        $request->execute([":params" => $params]);

        $userInfos = $request->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($userInfos);
    }

    function updateAccountForOneUser(){
        // Vérification si la méthode de la requête est bien POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('HTTP/1.1 405 Method Not Allowed');
            echo json_encode(['error' => 'Méthode non autorisée.']);
            return;
        }
    
        // Récupération des données du formulaire
        $userId = $_POST['userId'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $birthday = $_POST['birthday'];
    
        // Validation des données (ajoutez vos propres validations ici)
    
        // 1. Utilisation de l'objet Database
        $db = new Database();
    
        // 2. Appel de la fonction getconnection de Database
        $connexion = $db->getconnection();
    
        // 3. Préparation de la requête pour mettre à jour le compte utilisateur
        $request = $connexion->prepare("
            UPDATE user 
            SET user_firstname = :firstname,
                user_lastname = :lastname,
                user_mail = :mail,
                user_password = :password,
                user_birth = :birthday
            WHERE user_id = :userId
        ");
    
        // 4. Exécution de la requête avec les paramètres
        $request->execute([
            ":firstname" => $firstname,
            ":lastname" => $lastname,
            ":mail" => $mail,
            ":password" => $password,
            ":birthday" => $birthday,
            ":userId" => $userId
        ]);
    
        // 5. Vérification si la mise à jour a été effectuée
        if ($request->rowCount() > 0) {
            // Mise à jour réussie, renvoyer une réponse JSON avec un message de succès
            header('Content-Type: application/json');
            echo json_encode(['success' => 'Compte utilisateur mis à jour avec succès.']);
        } else {
            // Aucune ligne affectée, l'utilisateur peut ne pas exister ou les données sont les mêmes
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Impossible de mettre à jour le compte utilisateur. Vérifiez les informations fournies.']);
        }
    }

    function getAccountForOneUser($user_id){

        // j'appelle l'objet base de donnée
        $db = new Database();

        // je me connecte à la BDD avec la fonction getconnexion de l'objet Database
        $connexion = $db->getconnection();

        // je prépare la requête
        $sql = $connexion->prepare("
        SELECT * FROM user
        WHERE user.user_id = :user_id
        UNION ALL
        SELECT * FROM apartment_rental
        WHERE user.user_id = :user_id
        UNION ALL
        SELECT * FROM user_invoice
        WHERE user.user_id = :user_id;

        ");
        // j'exécute la requête
        $sql->execute([':user_id' => $user_id]);
        // je récupère tous les résultats dans users
        $user = $sql->fetch(PDO::FETCH_ASSOC);
        // je ferme la connexion
        $connexion = null;

        // je renvoie au front les données au format json
        header('Content-Type: application/json');
        echo json_encode($user);
    }   

    function desactiveAccountForOneUser($user_id) {
        $db = new Database();
        $connexion = $db->getconnection();
    
        // Vérification des conditions supplémentaires avant de désactiver le compte
    
        // 1. Vérifier si l'utilisateur est déjà désactivé
        $checkStatusQuery = $connexion->prepare("
            SELECT user_active
            FROM user
            WHERE user_id = :user_id
        ");
        $checkStatusQuery->execute([
            ":user_id" => $user_id
        ]);
        $userStatus = $checkStatusQuery->fetchColumn();
    
        if ($userStatus == 0) {
            // Si le compte est déjà désactivé, vous pouvez effectuer une action ou renvoyer un message d'erreur approprié
            $message = "Le compte est déjà désactivé.";
            // Vous pouvez rediriger l'utilisateur vers une page spécifique, afficher un message d'erreur, etc.
            $response = [
                "success" => false,
                "message" => $message
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            return;
        }

        $request = $connexion->prepare("
            UPDATE user 
            SET user_active = 0
            WHERE user_id = :user_id
        ");
    
        $request->execute([
            ":user_id" => $user_id
        ]);
    
        // Récupération des informations de l'utilisateur après la mise à jour
        $getUserQuery = $connexion->prepare("
            SELECT *
            FROM user
            WHERE user_id = :user_id
        ");
        $getUserQuery->execute([
            ":user_id" => $user_id
        ]);
        $userInfos = $getUserQuery->fetch(PDO::FETCH_ASSOC);
    
        // Fermeture de la connexion
        $connexion = null;
    
        // Réponse JSON indiquant le succès de l'opération et les informations de l'utilisateur
        $response = [
            "success" => true,
            "message" => "Le compte a été désactivé avec succès.",
            "user" => $userInfos
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    


    function reactiveAccountForOneUser($user_id, $user_statut) {
        $db = new Database();
        $connexion = $db->getconnection();
    
        // Vérification des conditions supplémentaires avant de réactiver le compte
    
        // 1. Vérifier si l'utilisateur est déjà actif
        $checkStatusQuery = $connexion->prepare("
            SELECT user_active
            FROM user
            WHERE user_id = :user_id
        ");
        $checkStatusQuery->execute([
            ":user_id" => $user_id
        ]);
        $userStatus = $checkStatusQuery->fetchColumn();
    
        if ($userStatus == 1) {
            // Si le compte est déjà actif, vous pouvez effectuer une action ou renvoyer un message d'erreur approprié
            $message = "Le compte est déjà actif.";
            // Vous pouvez rediriger l'utilisateur vers une page spécifique, afficher un message d'erreur, etc.
            $response = [
                "success" => false,
                "message" => $message
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            return;
        }
    
        $request = $connexion->prepare("
            UPDATE user 
            SET user_active = 1, user_statut = :user_statut
            WHERE user_id = :user_id
        ");
    
        $request->execute([
            ":user_id" => $user_id,
            ":user_statut" => $user_statut
        ]);
    
        // Récupération des informations de l'utilisateur après la mise à jour
        $getUserQuery = $connexion->prepare("
            SELECT *
            FROM user
            WHERE user_id = :user_id
        ");
        $getUserQuery->execute([
            ":user_id" => $user_id
        ]);
        $userInfos = $getUserQuery->fetch(PDO::FETCH_ASSOC);
    
        // Fermeture de la connexion
        $connexion = null;
    
        // Réponse JSON indiquant le succès de l'opération et les informations de l'utilisateur
        $response = [
            "success" => true,
            "message" => "Le compte a été réactivé avec succès.",
            "user" => $userInfos
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
    function updateStatutForOneUser($user_id, $new_statut) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('HTTP/1.1 405 Method Not Allowed');
            echo json_encode(['error' => 'Méthode non autorisée.']);
            return;
        }
    
        $db = new Database();
        $connexion = $db->getconnection();
    
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
            $message = "L'utilisateur spécifié n'existe pas.";
            $response = [
                "success" => false,
                "message" => $message
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            return;
        }
    
        $request = $connexion->prepare("
            UPDATE user 
            SET user_statut = :new_statut
            WHERE user_id = :user_id
        ");
    
        $request->execute([
            ":user_id" => $user_id,
            ":new_statut" => $new_statut
        ]);
    
        $getUserQuery = $connexion->prepare("
            SELECT *
            FROM user
            WHERE user_id = :user_id
        ");
        $getUserQuery->execute([
            ":user_id" => $user_id
        ]);
        $userInfos = $getUserQuery->fetch(PDO::FETCH_ASSOC);
    
        $connexion = null;
    
        $response = [
            "success" => true,
            "message" => "Le statut de l'utilisateur a été mis à jour avec succès.",
            "user" => $userInfos
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function deleteAccountForOneUser($user_id) {
        $db = new Database();
        $connexion = $db->getconnection();
    
        // Vérification des conditions supplémentaires avant de supprimer le compte de l'utilisateur
    
        // 1. Vérifier si l'utilisateur existe
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
            // Si l'utilisateur n'existe pas, vous pouvez effectuer une action ou renvoyer un message d'erreur approprié
            $message = "L'utilisateur spécifié n'existe pas.";
            // Vous pouvez rediriger l'utilisateur vers une page spécifique, afficher un message d'erreur, etc.
            $response = [
                "success" => false,
                "message" => $message
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            return;
        }
    
        $request = $connexion->prepare("
            DELETE FROM user 
            WHERE user_id = :user_id
        ");
    
        $request->execute([
            ":user_id" => $user_id
        ]);
    
        // Fermeture de la connexion
        $connexion = null;
    
        // Réponse JSON indiquant le succès de l'opération
        $response = [
            "success" => true,
            "message" => "Le compte de l'utilisateur a été supprimé avec succès."
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

}
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

        // 2. j'utilise la fonction getconnection de l'objet Database
        $connexion = $db->getconnection();

        // 2. J'appelle la fonction getconnection de Database
        $connexion = $db->getconnection();

        // 3. je prépare ma requète attention je veut récupérer les users dont le statut 
        $request = $connexion->prepare("
        SELECT user_id WHERE user_statut = Menage

    
        )");
        

        

        // est = a menage
        
        // 4. J'exécute ma requête

        // 5. je renvoie les données au front en json
    }

    function getOneUser(){
        
    }

    function searchUser(){
        
    }

    function updateAccountForOneUser(){
        
    }

    function getAccountForOneUser(){
        
    }

    function desactiveAccountForOneUser (){
        
    }

    function reactiveAccountForOneUser (){
        
    }

    function updateStatutForOneUser (){
        
    }

    function deleteAccountForOneUser (){
        
    }
    
}
<?php 
// Réalisé par Venance KAOU

    //Démarrer la session
    session_start();
    $_SESSION['statut'] = "";
?>


<?php
    $_SESSION['user'] = "";
    //Lorsque l'utilisateur clique sur le bouton de connexion
    if(isset($_POST['btn_connexion'])){
       //connecter notre base de données
       include('connexion_bdd.php');
       //extraire les infos de notre formulaire
       extract($_POST);
       if(isset($email) && isset($mdp) && $email!=null && $mdp != null){ 
            $mdp =  sha1 (htmlspecialchars($mdp));
            $req = $bdd -> query(" SELECT * FROM users WHERE identifiant = '$email' AND mdp='$mdp' "); 
            $data = $req -> fetch(); 
            if(isset($data) && $data != null){
                // $error = 'Identifiant vérifié';
                //récupérons le nom,prénoms le id de l'utilisateur par les variables de sessions
                $_SESSION['nom'] = $data['nom'];
                $_SESSION['prenoms'] = $data['prenoms'];
                $_SESSION['id_user'] = $data['id_user'];
                $_SESSION['connecté'] = true;
                header('Location:index.php');
            } else {
                $_SESSION['user'] = "";
                $error = 'Identifiant ou mot de passe incorect';
            }

       } else {
            $_SESSION['user'] = "";
            $error = 'Veuillez remplire tous les champs svp !';
       }
    }

    //Lorsque l'utilisateur clique sur le bouton de changement de mot de passe
    if(isset ($_POST['btn_forgot_password'])) {
        //connecter notre base de données
        include('connexion_bdd.php');
        //extraire les infos de notre formulaire
        extract($_POST);
        if (isset($email) && $email != null) {
            $req = $bdd -> query(" SELECT * FROM users WHERE identifiant = '$email' "); 
            $data = $req -> fetch(); 
            if (isset($data) && $data != null) {
                //Si l'identifiant est dans la base de donnés,on envoie un code de restauration à l'adresse e-mail
                $_SESSION['codeDeConfirmation'] =  mt_rand(100000,999999);
                $_SESSION['statut_restauration_de_mot_de_passe'] = true;
                $_SESSION['statut_inscription'] = false; 
                $_SESSION['email'] = $email;
                //On inclue la page d'envoi de code de confirmation par mail à l'adresse de l'utilisateur
                include('sendmail.php');
                // $_SESSION['statut'] = true;
                // header('Location:codeDeconfirmation.php');
                
            } else {
                //Si l'identifiant n'est pas dans la base de donnés, on affiche
                $error = "Aucun compte n'est associé à votre identifiant";
            }
        }
        
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="IE-edge">
     <title> Nouvelle connexion </title>
     <link rel="stylesheet" href="style/formulaires.css">
     <link rel="shortcut icon" href="images/0d9153844945192442c60da684700781.jpg">

</head>
<body>
<form class="form" action="" method="post">
    <p class="title"> MyChat </p>
    <p class="message_error"> <?php if(isset($error)){ echo $error; }?> </p>
    <label>
        <input class=" email " name="email" type="email" placeholder="Email" value= <?php if(isset($email)){echo $email;} ?> >  
    </label>        
    <label>
        <input class="password " name="mdp" type="password" placeholder="Password" maxlength="10" >
    </label>
    <input type="submit" name="btn_connexion" class="btn_connexion" value="Connexion">
    <button class="btn_forgot_password" name="btn_forgot_password"> Mot de passe oublié </button>
    
    <p class="msg_to_user">
        Vous n'avez pas un compte ? 
        <a href="inscription.php"> S'inscrire </a> 
    </p>
</form>


 <!-- Liaison du fichier javaScript à la page de connexion -->
 <script src="script.js"></script>
</body>
</html>

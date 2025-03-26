<?php 
//Venance KAOU

    //Démarrer la session
    session_start();
    $_SESSION['statut'] = "";
?>



<?php 
    if(isset($_POST['btn_inscrire'])){
        //Si le formulaire est envoyé
        // Connexion à la base de données
        include('connexion_bdd.php');
        //extraire les infos du formulaire
        extract($_POST);
        //vérifions si les champs sont remplis
        if(isset($nom) && isset($prenoms) && isset($email) && isset($mdp1)
             && isset($mdp2) && $nom!="" && $prenoms!="" && $email!=""
             && $mdp1!="" && $mdp2!=""){
                //si les deux mots de passe sont conformes
                if($mdp1==$mdp2){
                     //prendre des mésures contres les failles éventuelles
                $nom = strip_tags($nom);
                $prenoms = strip_tags($prenoms);
                $email = strip_tags($email);
                $mdp1 = sha1(htmlspecialchars(strip_tags($mdp1)));
                
                //si tout est bon , insérons les données dans la base de données avec une requette préparée
                // vérifions si l'utilisateur a déjà un compte, donc si cet identifiant existe déjà dans notre bdd ou pas
                $req = $bdd-> prepare('SELECT identifiant FROM users WHERE identifiant = (?) ');
                $req->execute(array($email));
                $data = $req -> fetch();
                if( isset($data) && $data == null ){
                    //si l'identifiant n'existe pas, on envoie un code de confirmation à l'adresse e-mail et on crée les variables de session
                    $_SESSION['codeDeConfirmation'] =  mt_rand(100000,999999);
                    $_SESSION['nom'] = $nom ;
                    $_SESSION['prenoms'] =  $prenoms;
                    $_SESSION['email'] = $email;
                    $_SESSION['mdp1'] = $mdp1;
                    $_SESSION['statut_restauration_de_mot_de_passe'] = false;
                    $_SESSION['statut_inscription'] = true;
                    //On inclue la page d'envoi de code de confirmation par mail à l'adresse de l'utilisateur
                    include('sendmail.php');
                    // $_SESSION['statut'] = true;
                    // header('Location:codeDeconfirmation.php');
                                        
                        } else {
                            // sinon , si l'identifiant existe déjà affiche
                                $error = 'Votre identifiant est déjà utilisé une fois <br>
                             <a href="connexion.php" class="message_error">Connectez-vous</a> à votre compte.';
                        }

                } else {
                    $error = 'Inscription échouée ! <br> Les deux mots de passe ne sont pas conformes.';
                }
                    }  else {        
                        // Dans le cas contraire affiche
                        $error = 'Veuillez remplir tous champs !';
                    }
                } 
?>
     



<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title> Nouvelle inscription </title>
     <link rel="stylesheet" href="style/formulaires.css">
     <link rel="shortcut icon" href="images/0d9153844945192442c60da684700781.jpg">
</head>
<body>


<form class="form" method="post" action="" >
    <p class="title"> MyChat </p>
    <p class="message_error">  <?php if(isset($error)) { echo $error;} ?>  </p>
    <div class="flex">
        <label>
            <input type="text" name="nom" class="nom" placeholder="Name" value= <?php if(isset($nom)){echo $nom;} ?>>
        </label>
        <label>
            <input type="text" name="prenoms" class="prenoms"  placeholder="Firstname" value= <?php if(isset($prenoms)){echo $prenoms;} ?> >
        </label>
    </div>              
    <label>
        <input type="email" name="email" class="email" placeholder = "Email" value= <?php if(isset($email)){echo $email;} ?> >
    </label>        
    <label>
        <input type="password" name="mdp1" class="mdp1" placeholder = "Password" minlength="6" maxlength="10">
    </label>
    <label>
        <input type="password" name="mdp2" class="mdp2" placeholder="Confirm password" minlength="6" maxlength="10">
    </label>
    <input type="submit" name="btn_inscrire" class="btn_inscription" value="S'inscrire" >
    <p class="msg_to_user">
        Avez-vous déjà un compte ? 
        <a href="connexion.php"> Connexion   </a> 
    </p>
</form>
 
    <!-- Liaison du fichier javaScript à la page inscription -->
     <script src="script.js"></script>

</body>
</html>

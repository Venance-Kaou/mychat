<?php 
//Réalisé par Venance KAOU

    //Démarrer la session
    session_start();
    //L'utilisateur n'a pas accès à cette page s'il n'a pas l'autorisation
    if ( !$_SESSION['statut'] ) { header('Location:connexion.php'); }
?>




<?php 
    //Lorsque l'utilisateur clique sur le bouton de confirmation pour envoyer le nouveau mot de passe
    if(isset($_POST['nouveauMotDePasse'])) {
        //Si l'utilisateur valide le code
        // Connexion à la base de données
        include('connexion_bdd.php');
        //extraire les infos du formulaire
        extract($_POST);
        //Si nouveauMotDePasse existe et est different de null alors on insère les infos dans la base de donnés
        if (isset($nouveauMotDePasse) && $nouveauMotDePasse !=null) {
            $nouveauMotDePasse = sha1(htmlspecialchars(strip_tags($nouveauMotDePasse)));
            //Lorsque tout va bien on insère le nouveau mot de passe dans la base de donnés
            $req = $bdd -> prepare (" UPDATE users SET mdp = :mdp WHERE identifiant = :email ");
            $req -> execute(array( 'mdp' => $nouveauMotDePasse  , 'email' => $_SESSION['email'] ,));
            //Redirection vers la page de connexion
            header('Location:connexion.php');

        }
        
    }

?>
  
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Restauration du mot de passe</title>
    <link rel="shortcut icon" href="images/0d9153844945192442c60da684700781.jpg">
    <link rel="stylesheet" href="style/formulaires.css">
</head>
<body>
    <div id="myModal" class="modal">
    
    <div class="form-container" >
        <span class="close"> <a href="connexion.php"> &times; </a> </span>
        <p class="modal-p">Veuillez entrer votre nouveau mot de passe</p>
    
        <form action="" id="confirmationForm" method="post">
            <div class="form-group">
                <label for="nouveauMotDePasse"> </label>
                <input type="text" id="nouveauMotDePasse" name="nouveauMotDePasse" required maxlength="10" placeholder="Nouveau mot de passe">
            </div>

            <div id="errorMessage" class="error-message">  </div>
            
            <button type="submit" name="btnConfirmation" class="btnConfirmation"> Envoyer </button> 
        </form>
        
    </div>

</div>

<script > 

        document.getElementById("confirmationForm").addEventListener("submit", function(event) {

            //Récupérer la valeur du code de confirmation 
            const confirmationCode = document.getElementById("nouveauMotDePasse").value;
            const errorMessage = document.getElementById("errorMessage");

            //Réinitialiser le message d'erreur
            errorMessage.style.display = "none";
            errorMessage.textContent = "";

            //Validation du code de confirmation
            if ( confirmationCode.length < 6) {
                errorMessage.textContent = "Votre mot de passe doit contenir au moins 6 caractères.";
                errorMessage.style.display = "block";
                event.preventDefault(); //Empêche la soumission du formulaire
                return; //Arrêter l'exécution si le code est invalide
            } 

        });

</script>


</body>
</html>
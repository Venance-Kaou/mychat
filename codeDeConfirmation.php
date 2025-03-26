<?php 
//Réalisé par Venance KAOU

    //Démarrer la session
    session_start();
    //L'utilisateur n'a pas accès à cette page s'il n'a pas l'autorisation
    // if ( !$_SESSION['statut'] ) { header('Location:connexion.php'); }
?>



<?php 


        
    //Lorsque l'utilisateur clique sur le bouton de confirmation pour pouvoir faire une nouvelle inscription
    if(isset($_POST['btnConfirmation']) && $_SESSION['statut_inscription'] ) {
       
        //Si l'utilisateur valide le code
        // Connexion à la base de données
        include('connexion_bdd.php');
        //extraire les infos du formulaire
        extract($_POST);
        //Vérifions si le code entré est égale au code envoyé sur l'adresse e-mail et que toutes les variables ont une valeur différente de null
        if(isset($_SESSION['nom']) && isset($_SESSION['prenoms']) && isset($_SESSION['email']) && 
            isset($_SESSION['mdp1']) && $confimationCode == $_SESSION['codeDeConfirmation'] ) {
                // Si tout va bien on insères les informations dans la base de données avec une requette préparée
            $req = $bdd->prepare('INSERT INTO users(nom,prenoms,identifiant,mdp)
                            VALUE(:nom,:prenoms,:identifiant,:mdp)');
                            $req -> execute(array(  'nom' => strtoupper($_SESSION['nom']),
                                            'prenoms' => ucfirst($_SESSION['prenoms']),
                                            'identifiant' => $_SESSION['email'],
                                            'mdp' => $_SESSION['mdp1']
                                        ));
                            //Redirection vers la page de connexion
                            header('Location:connexion.php');
            
            } 
    }

    //Lorsque l'utilisateur clique sur le bouton de confirmation dans le pour pouvoir restaurer un mot de passe
    if(isset($_POST['btnConfirmation']) && $_SESSION['statut_restauration_de_mot_de_passe'] ){
        //Si l'utilisateur valide le code
        // Connexion à la base de données
        include('connexion_bdd.php');
        //extraire les infos du formulaire
        extract($_POST);
        //Si le code de confirmation valide est entré 
        if($confimationCode == $_SESSION['codeDeConfirmation'] ) {
            $_SESSION['statut'] = true;
            //Redirection vers la page de changement de nouveau mot de passe       
            header('Location:nouveauMotDePasse.php');
        }
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Code de confirmation </title>
    <link rel="stylesheet" href="style/formulaires.css">
    <link rel="shortcut icon" href="images/0d9153844945192442c60da684700781.jpg">
</head>
<body>

    <div id="myModal" class="modal">
    
        <div class="form-container" >
            <span class="close"> <a href="connexion.php"> &times; </a> </span>
            <p class="modal-p"> Un code code de confimation a été envoyé à votre adresse e-mail. </p>
        
            <form action="" id="confirmationForm" method="post">
                <div class="form-group">
                    <label for="confimationCode"></label>
                    <input type="text" id="confirmationCode" name="confimationCode" required maxlength="6" placeholder="Entrer le code de confimation">
                </div>

                <div id="errorMessage" class="error-message">  </div>
                
                <button type="submit" name="btnConfirmation" class="btnConfirmation"> Confirmer </button> 
            </form>
            
        </div>

    </div>

    <script > 

            document.getElementById("confirmationForm").addEventListener("submit", function(event) {

                //Récupérer la valeur du code de confirmation 
                const confirmationCode = document.getElementById("confirmationCode").value;
                const errorMessage = document.getElementById("errorMessage");

                //Réinitialiser le message d'erreur
                errorMessage.style.display = "none";
                errorMessage.textContent = "";

                //Validation du code de confirmation
                if ( confirmationCode.length !==6) {
                    errorMessage.textContent = "Le code de confirmation doit contenir 6 caractères.";
                    errorMessage.style.display = "block";
                    event.preventDefault(); //Empêche la soumission du formulaire
                    return; //Arrêter l'exécution si le code est invalide
                }  else if (confirmationCode != <?php echo $_SESSION["codeDeConfirmation"] ?>) {
                        errorMessage.textContent = "Code de confirmation incorrect. Veuillez ressayer !";
                        errorMessage.style.display = "block";
                        event.preventDefault(); //Empêche la soumission du formulaire
                        return; //Arrêter l'exécution si le code est invalide
                } 
                
            });

    </script>

</body>
</html>
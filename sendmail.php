<?php 
//Réalisé par Venance KAOU


//Envoie d'un code de confirmation en local à l'utilisateur avec MailDev
$subject = ' CODE DE CONFIRMATION MYCHAT';
$message = $_SESSION['codeDeConfirmation']. "  est votre code de confirmation sur MyChat";
$headers = 'From: mychat@gmail.com';

if (mail($email, $subject, $message, $headers)) {

    //Si le code de confirmation est envoyé alors on redirige l'utilisateur vers la page de confimation de code
    $_SESSION['statut'] = true;
    header('Location:codeDeconfirmation.php');

} else {
    echo " Échec de l'envoi du code de confirmation. Erreur : " . print_r(error_get_last(), true);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envoi de code</title>
    <link rel="shortcut icon" href="images/0d9153844945192442c60da684700781.jpg">
</head>
<body>
    
</body>
</html>
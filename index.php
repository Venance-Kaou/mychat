<?php 
//Venance KAOU

     //Démarrer la session
     session_start();
     //si l'utilisateur n'est pas connecté , redirection vers la page de connexion
     if(!$_SESSION['connecté']){
     session_destroy();
     header('Location:deconnexion.php');
}
   
?>


   
     <?php 
               if(isset($_POST['envoyer_message'])){
                     //connexion à la bdd
                    include "connexion_bdd.php";
                    //extraire les infos du formulaire
                    extract($_POST);
                    if(isset($text) && $text!=null){
                         $text = nl2br(strip_tags($text));
                         $req = $bdd->prepare('INSERT INTO messages_box(id_auteur,messages,dates) VALUE(:id_auteur,:messages,:dates)');
                              $req->execute(array('id_auteur'=> $_SESSION['id_user'], 
                                                  'messages' => $text,
                                                  'dates' => date("Y-m-d h:i:s")
                                                 
                    ));
                         header("Location:index.php"); 

                    } else {
                              header("Location:index.php");  
                         }
               }
          ?>


<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="style/style.css">
     <link rel="shortcut icon" href="images/0d9153844945192442c60da684700781.jpg">
     <title>MyChat</title>
</head>
<body>
     

<!-- <button class="btn"> BOUTON </button> -->
         
<div class="chat">    
          <div class="user_account">
               <span> <?php  echo $_SESSION['prenoms'].'  '.$_SESSION['nom'];?> </span>
               <button> <a href="deconnexion.php"> Deconnexion </a> </button>
          </div>
          
          <div class="chat_box"> <span class="chargement_du_message"> Chargement... </span> </div>

          <form action="" method="post" class="send_message">
               <textarea name="text" id="text"  placeholder="Entrez votre message" rows="3"></textarea>
               <input type="submit" value="Envoyer" name="envoyer_message">
          </form>

     </div>


     <!-- javaScript de la page index -->
     <script > 
          // var chat = document.querySelector('.chat').style,
          //      btn = document.querySelector('.btn');
          //      btn.onclick = function(){
          //      chat.display = 'none';
          // };

          // const  = document.querySelector('.chat_box');


          var chat_box = document.querySelector('.chat_box');
               setInterval(function(){
               var xhr = new XMLHttpRequest();
               xhr.onreadystatechange = function(){
                    if(xhr.readyState == 4 && xhr.status == 200){
                         chat_box.innerHTML = xhr.responseText
                    }
               };
               xhr.open("GET", "messages.php",true )
               xhr.send()
              }, 500)  //recharger la page tous les 500 ms

     </script>

</body>
</html>
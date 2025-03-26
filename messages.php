<?php  
//Venance KAOU

 //Démarrer la session pour pouvoir afficher les messages 
 session_start();
 //si l'utilisateur n'est pas connecté , redirection vers la page de connexion
 if(!$_SESSION['connecté']){
     session_destroy();
     header('Location:deconnexion.php');
}
          
?>             
 <?php  
 
 if(isset($_SESSION['connecté'])){
     //connexion à la base de données
     include "connexion_bdd.php";
     // selectionner tous les élements de la table messages_box
     $n = $bdd->query("SELECT COUNT(messages) nbr_de_messages FROM messages_box");
                         
     $req = $bdd->query("SELECT LOWER(u.nom) nom,u.prenoms prenoms, m.id_message id_message,
                               m.messages messages,DATE_FORMAT(dates,'%d-%m-%Y à %H:%i:%s') dates,
                               u.id_user id_user, m.id_auteur id_auteur FROM users u INNER JOIN 
                               messages_box m ON u.id_user = m.id_auteur ORDER BY dates DESC");
                  
                  
      //Quand il n'y aucun message dans la boîte de messagerie
          $nbr_de_msg = $n->fetch();
               if(($nbr_de_msg['nbr_de_messages'])==0){
                    ?>
                         <div>
                              <p style="color:red;text-align:center;
                                                  font-weight:bolder;margin-top:90px">
                                                  Boîte de messagerie vide
                              </p>
                         </div>
                              
                    <?php
               }        
 
     while($data = $req->fetch()){

               if(isset($_SESSION['id_user']) && $_SESSION['id_user'] == $data['id_auteur']){
                    ?> 
                   <div class="my_message">
                   <!-- <span class="auteur_du_message"> Vous </span> -->
                         <p> <?php echo ($data['messages']); ?> </p>
                         <span class="spane"> <?php echo ($data['dates']); ?> </span>

                    </div> 


                    <?php 
              } else {
               ?>
                    <div class="other_message">
                         <!-- afficher le nom de l'auteur du message lorsque ce n'est pas moi qui l'ai écrit -->
                         <span class="auteur_du_message">
                              <?php 
                                   echo $data['prenoms'].' '.$data['nom'];
                              ?> 
                         </span>
                         <p> <?php echo ($data['messages']); ?>  </p>
                         <span class="spane"> <?php echo ($data['dates']); ?> </span>
                    </div>
               <?php
              }
     }
     
}

 ?> 
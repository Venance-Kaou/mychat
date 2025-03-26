//Venance KAOU

//SCRIPT SUR LA PAGE D'INSCRIPTION

var mdp1 = document.querySelector('.mdp1'),
     mdp2 = document.querySelector('.mdp2');
 
     mdp2.onkeyup = function(){ //Fonction au cours de la saisie du mot de passe
          var message_error = document.querySelector(".message_error");
          if(mdp2.value != mdp1.value && mdp2.value != 0){ //si les mots de passe ne sont pas égaux
               //on affiche
               message_error.textContent = "Les mots de passe ne sont pas conformes";
          } else { // sinon
               message_error.textContent = " ";
          }
     };
 

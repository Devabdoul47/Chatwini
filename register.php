<?php
  require_once('db.php');
  require_once('Isexpired.php');

  session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('PHPMailer-master/src/PHPMailer.php');
require_once('PHPMailer-master/src/SMTP.php');
require_once('PHPMailer-master/src/Exception.php');
?>
<!doctype html>
<html lang="fr">
<head>
  <title>Inscription à Chatwini</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="register.css">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>
<body>
<div class="col-md-6" id="secttion">
    <img src="media/IMG-20230522-WA0043.jpg" alt="" class="mt-3 mb-2 offset-md-5" id="logoo" >
    <span class="point"><div></div></span>
    <span class="point"><div></div></span>
    <span class="point"><div></div></span>
    <span class="point"><div></div></span>
    <span class="point"><div></div></span>
  </div>
  <header>
    <!-- place navbar here -->
  </header>
  <div class="container  responsive">
        <div class="col-md-6  offset-md-3">
        <a href="index.php"><img src="media/IMG-20230522-WA0043.jpg" alt="" class="mt-1 offset-md-5" id="logo" style="width:60px; height:60px; border-radius:100px 100px 0px 100px;"></a>
            <h3 class="text-center">Inscription</h3>
            <p class="text-center" style="font-size:15px; text-align:center;">Obtenez votre compte Chatwini maintenant</p>
           
           <?php
            function generate_tokenn($code){
              $token ='';
              $carateres = [
               '0',
               '1',
               '2',
               '3',
               '4',
               '5',
               '6',
               '7',
               '8',
               '9',
              ];
              for($i =0 ; $i<$code; $i++){
               $token.= $carateres[mt_rand(1, count($carateres))];
              };
              return $token;
            };

                if(isset($_POST['soumis'])){ 
                  $regist = [
                   'pseudo' =>  htmlspecialchars($_POST['pseudo']),
                   'email' =>  htmlspecialchars($_POST['email']),
                   'pass' => hash('sha512',$_POST['pass']),
                  ];
                  $_SESSION['personne'] =[
                    'email' => htmlspecialchars($_POST['email'])
                  ];
                 $request = $db->prepare("INSERT INTO utilisateur( pseudo, email, pass) VALUES (:pseudo, :email, :pass)");
                 $inser = $request->execute($regist); 
                  echo"<p class='alert alert-success'>Vous êtes inscrire avec succès !</p>";
                  if($inser){
                    $_SESSION['register']= [
                      'pseudo' =>  $inser['pseudo'],
                      'email' =>  $inser['email'],
                      'pass' =>  $inser['pass']
                    ];
                  };
                  
                  //envoie du code de vérification d'email 
                 $verification_email= [
                   'email'=> htmlspecialchars($_POST['email']),
                   'code_verification' => generate_tokenn(6),
                   'date_expire' => date('Y-m-d H:i:s'),
                 ];
                 $envoier = $db->prepare('INSERT INTO verification (email, code_verification,date_expire) VALUES (:email, :code_verification,:date_expire)');
                 $envoier->execute($verification_email);
                  
                 // Redirection pour la vérification de l'email  après inscription

                   header('location:verification.php');

                 // Create new instances 
        $mail = new PHPMailer(true);
   
        try {
       // Configuration du serveur SMTP
       $mail->isSMTP();
       $mail->Host = 'smtp.gmail.com'; // Le serveur gmail 
       $mail->SMTPAuth = true;
       $mail->Username = 'Abdoubachabikowiyou@gmail.com'; // votre email 
       $mail->Password = 'uczsphdtatovxwoz'; // votre mot de passe pour les applications
       $mail->SMTPSecure = 'ssl'; // la sécurité pour l'email doit être crypter 
       $mail->Port = 465; // le port 
   
       // Paramètres de l'e-mail
       $mail->setFrom('Abdoubachabikowiyou@gmail.com', 'Chatwini'); // Votre email et votre nom 
       $mail->addAddress($_POST['email'], $_POST['pseudo']); // addresse du destinateur  et son nom 
       $mail->Subject = 'Code de verification'; // Suject de l'email
       $mail->Body = 'Votre code de vérification est: '.$verification_email['code_verification'] ;   // Contenu de l'email cela peut être aussi du code html et stylisé 
   
       // Envoyer l'e-mail
       $mail->send();
       echo 'E-mail envoyé avec succès';
      } catch (Exception $e) {
       echo 'Erreur lors de l\'envoi de l\'e-mail : ', $mail->ErrorInfo;
      };
    };
            ?>
            <div class="card p-4" id="card">
                <div class="row">
             <form action="" method="post" enctype="multipart/form-data">
              
             <?php
             ?> 
      
        <div class="md-3">
          <label for="email"> E-mail</label>
          <input type="email" name="email" id="email"  class="form-control  mt-1 mb-3 bg-body-secondary"  required placeholder="Entrez votre email">
        </div>
        <div class="md-3">
          <label for="pseudo">Nom d'utilisateur</label>
          <input type="text" name="pseudo" id="pseudo"  class="form-control  mt-1 mb-3"   required placeholder="Entrez votre pseudo">
        </div>
        <div class="md-3">
          <label for="email">Mot de passe</label>
          <input type="password" name="pass" id="pass"  class="form-control form-text mt-1 mb-3"   required placeholder="Entrez un mot de passe">
        </div>
        <div class="md-3">
          <input type="submit" value="S'inscrire" class="btn btn-primary " name="soumis" id="soumis" style="width:100%;">
        </div>
        <div class="md-3">
         <p class="mt-2 text-center mb-0" id="terme">En vous inscrivant, vous accpetez les <a href="#">conditions d'utilisation de Chatwini</a></p>
        </div>
    </form>
    </div>
    </div>
   </div>
</div>
 <div class="col-md-6 offset-md-3 mt-4">
    <p class="text-center " style="font-size:15px;"> Avez-vous déjà un compte? 
     <a href="index.php" class="connec"> S'identifier</a>
    </p>
    <p class="text-center mt-2">&copy; <?= date('Y'); ?> Tous droits réservés créer par Abdoul</p>
 </div>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <script src="register.js"></script>
</body>
</html>
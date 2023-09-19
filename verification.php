<?php
require_once('db.php');
require_once('Isexpired.php');
session_start();
if(!$_SESSION['register']){
  header('location:register.php');
}
?>
<!doctype html>
<html lang="fr">
<head>
  <title>Vérification</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="verification.css">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
  <header>
    <!-- place navbar here -->
  </header>
<form action="" method="post">
<div class="container  responsive">
<div class="col-md-6 mt-5 offset-md-3">
<a href="index.php" class=""><img src="media/IMG-20230522-WA0043.jpg" alt="" class="mt-1 offset-md-5" id="logo" style="width:60px; height:60px; border-radius:100px 100px 0px 100px;"></a>
 
 <?php

    if(isset($_POST['verifier'])){
      // vérrifie si le code existe dans nos données 
      $dbb = $db->prepare('SELECT code_verification FROM verification WHERE code_verification= :code_verification ');
      $dbb->execute(['code_verification' => $_POST['code']]);
      $code_trouver = $dbb->fetch(); 
      
      //  Si un code du genre postuler a été trouver dans la base de données action à faire
      if($code_trouver){
        $elements =[
          'code_verification' => htmlspecialchars($_POST['code']),
        ];
        $affiche = $db->prepare('SELECT * FROM verification WHERE code_verification = :code_verification ');
        $affiche->execute($elements);
        $donnees_trouver = $affiche->fetch();

        $_SESSION['email']=[
          'email' => $donnees_trouver['email'],
        ];

        echo"<p class='alert alert-success mt-2'> Email <span style='color:blue;'> ".$_SESSION['email']['email']."</span> vérifier avec succès veillez vous <a href='index.php'>connectez maintenant</a> à chatwini</p>";
        $destruction = $_SESSION['register'];

         // suppression
        $sup_code = $db->prepare("DELETE FROM  verification  WHERE  code_verification = :code_verification");
        $sup_code->execute(['code_verification'=> $_POST['code']]);die();

      }else{
        echo"<p class='alert alert-danger mt-2'> Le code de vérification  ne correspond veuillez saisie le bon code de vérification</p>";
      }
    };
?> 
   <p class="text-center">Nous avons envoyez un code de vérification à votre email <span style="color:blue; font-size: 19px;"> <?= $_SESSION['personne']['email'] ?> </span></p>
    <div class="card p-4">
        <div class="md-3">
            <input type="text" name="code" id="code" autofocus maxlength="6" required placeholder="Entrez le code"  class="form-control p-2" style="text-align:center;">
        </div>
        <input class="btn btn-primary  mt-4 p-2 " type="submit" name="verifier" id="verifier" value="Vérifier maintenant">
    </div>
  </div>
</div>
</form>
<div class="col-md-6 offset-md-3 mt-3">
      <p class="text-center mt-2">&copy; <?= date('Y'); ?> Tous droits réservés créer par Abdoul</p>
</div>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <style>

  </style>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>
</html>
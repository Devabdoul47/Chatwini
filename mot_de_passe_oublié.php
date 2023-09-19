<?php
require_once('db.php');
require_once('Isexpired.php');
session_start();
?>
<!doctype html>
<html lang="fr">
<head>
  <title>réinstialisation avec Chatwini</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
  <header>
    <!-- place navbar here -->
  </header>
  <form action="" method="post">
    <div class="container responsive">
  <div class="col-md-6 offset-md-3">
  <a href="index.php"><img src="media/IMG-20230522-WA0043.jpg" alt="" class="mt-3 mb-2 offset-md-5" id="logo" style="width:60px; height:60px; border-radius:100px 100px 0px 100px;"></a>
  <h2 class="text-center" style="font-size:23px;">Réinstialisation du mot de passe</h2>
  <p class="text-center">réinstialiser votre mot de passe avec Chatwini</p>
  <div class="card p-3">
  <?php
            // On crée une fonction de générateur de token 
           // Avec une variable en parametre de la fonction 
           function generate_token($param){
            // on déclare une variable à rien 
             $token= '';
              // et une autre qui definie la liste des caracères dans un tableaux
             $carateres = [
              'A',
              'B',
              'C',
              'D',
              'E',
              'F',
              'G',
              'H',
              'I',
              'J',
              'K',
              'L',
              'M',
              'N',
              'O',
              'P',
              'Q',
              'R',
              'S',
              'T',
              'U',
              'V',
              'W',
              'X',
              'Y',
              'Z'
             ];
              //  on crée une boucle for pour la generation automatique avec les caractères aléatoires jusqu'à atteindre la valeur
             for($i = 0 ; $i <$param; $i++){
              $token.= $carateres[mt_rand(1, count($carateres))];
             };
            //  enfin on retourne le token
              return $token;
            };
    
// on vérifie si l'email saisie est dans la base de donneé si oui on génère un token ou lien qu'on envoie dans son email pour changer de mot de passe
     if(isset($_POST['recup'])){ 
    $re = [
     'email' => htmlspecialchars($_POST['email']),
    ];
    $recuperation = $db->prepare(" SELECT email FROM utilisateur  WHERE email= :email");
    $inser = $recuperation->execute($re); 
    $recuperation_find = $recuperation->fetch();

    if($recuperation_find){
        $recup_data = [
         'email' =>  $recuperation_find['email'],
         'token' =>  generate_token(10),
         'dateexpire' =>  date(' Y:m:d H:i:s'),
        ];
        // Après on insert cette email trouvé et le token dans notre base de donnée de réinstialisation de mot de passe 
        $request = $db->prepare("INSERT INTO reinstialisation (dateexpire, token, email) VALUES (:dateexpire, :token, :email)");
        $request->execute($recup_data); 
       echo"<p class='alert alert-info'> Un nouveau lien de récuperation a été envoyé à l'addresse email ".$_POST['email'].", prenez soin de vérifier dans votre SPAM si vous ne le trouver pas.</p>";
        
      }else{
      echo"<div class='alert alert-danger text-center'> Votre email  n'existe pas dans notre base de donnée !</div>";
    };
  };
?>
        <div class="mb-3">
          <input type="email" name="email" id="email" autofocus class="form-control" required placeholder="Entrez votre email">
        </div>
        <div class="mb-3">
          <input class="btn btn-primary  " name="recup" type="submit" value="Recevoir le lien de réinstialisation" style="width:100%;">
        </div>
    </div>
  </div>
  </div>
</form>
<div class="col-md-6 offset-md-3 mt-4">
    <p class="text-center " id="lien" style="">Vous vous souvenez de votre compte? 
     <a href="index.php">S'identifier</a>
    </p>
    <p class="text-center mt-2">&copy; <?= date('Y'); ?> Tous droits réservés créer par Abdoul</p>
 </div>

 <style>
#lien a{
  text-decoration:none;
}
#lien a:hover{
  text-decoration: underline;
}
 </style>
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
</body>
</html>
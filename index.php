<?php
require_once('db.php');
session_start();
?>
<!doctype html>
<html lang="fr">
<head>
  <title>Connexion à Chatwini</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS v5.2.1 -->
  <link rel="stylesheet" href="login.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
  <div class="col-md-6" id="secttion">
    <img src="media/IMG-20230522-WA0043.jpg" alt="" class="mt-3 mb-2 offset-md-5" id="logo" >
    <span class="point"><div></div></span>
    <span class="point"><div></div></span>
    <span class="point"><div></div></span>
    <span class="point"><div></div></span>
    <span class="point"><div></div></span>
  </div>
  <header>
    <!-- place navbar here -->
  </header>
    <form action="" method="post">
       <div class="container responsive">
        <div class="col-md-6 offset-md-3">
          <img src="media/IMG-20230522-WA0043.jpg" alt="" class="mt-3 offset-md-5"  style="width:60px; height:60px; border-radius:100px 100px 0px 100px;">
          <h3 class="text-center">Se connecter</h3>
          <p class="text-center text-primary">connectez-vous pour continuer avec Chatwini </p>
          <div class="card p-4" id="card">
        <?php     
      if(isset($_POST['soumis'])){
      $log = [
        'pseudo' => htmlspecialchars($_POST['pseudo']),
        'pass' => hash('sha512',$_POST['pass'])
        // password_verify($_POST['pass'], $_POST['pass'])
      ];
      $request = $db->prepare(" SELECT id, pseudo, nom, email, avatar, pass, role,dateadd,updatetime FROM utilisateur  WHERE pseudo= :pseudo AND pass= :pass");
      $request->execute($log);
      $userFind = $request->fetch();
     if($userFind){
       echo"<div class='alert alert-success text-center'> Vous êtes connecter avec succès !</div>";
      $_SESSION['users'] =[
        'id' =>$userFind['id'],
        'pseudo' =>$userFind['pseudo'],
        'nom' =>$userFind['nom'],
        'avatar' =>$userFind['avatar'],
        'pass' =>$userFind['pass'],
        'role' =>$userFind['role'],
        'email' =>$userFind['email'],
        'dateadd' =>$userFind['dateadd'],
        'updatetime' =>$userFind['updatetime']
      ];
      header('location:chatwini.php');
     }else{
    echo"<div class='alert alert-danger '> Votre pseudo ou mot de passse est incorrect</div>";
     };
    };
    ?>
    <div class="md-3">
      <label for="pass">Nom d'utilisateur</label>
      <input type="text" name="pseudo" id="pseudo"  autocomplete="false" class="form-control mt-1 mb-3" required placeholder="Entrez votre pseudo">
    </div>
    <div class="md-3">
      <label for="pass">Mot de passe</label>
     <input type="password" name="pass" id="pass"  autocomplete="false" class="form-control mt-1 mb-3"  required placeholder="Entrez votre mot de passe">
    </div>
    <div class="md-3">
      <input type="checkbox" name="souvenir"  class="mb-4"  required id="souvenir">
      <label for="souvenir">Souviens-toi de moi</label class="" style="margin-left:2px;">
    </div>
        <input  type="submit" name="soumis" class="btn btn-primary" id="soumis" value="S'identifier">
        </form>
          </div>
        </div>
       <div class="col-md-6 offset-md-3 mt-3">
       <p class="text-center" id="link" style=""><a href="mot_de_passe_oublié.php">Mot de passe oublié</a> / <a href="Register.php">Créer un compte </a> si vous n'avez pas.</p>
      <p class="text-center mt-2">&copy; <?= date('Y'); ?> Tous droits réservés créer par Abdoul</p>
    </div>
    </div>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <script src="index.js"></script>
</body>
</html>
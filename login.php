<?php
require_once('db.php');
session_start();
?>
<!doctype html>
<html lang="fr">
<head>
  <title>Connexion</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="login.css">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
  <header>
    <!-- place navbar here -->
  </header>
    <form action="" method="post">
        <h3>Se connecter à Chatwini</h3>
        <?php     
    if(isset($_POST['soumis'])){
      $log = [
        'email' => htmlspecialchars($_POST['email']),
        'pass' => hash('Sha512',$_POST['pass'])
      ];
      $request = $db->prepare(" SELECT  * FROM utilisateur  WHERE email= :email AND pass= :pass");
      $request->execute($log);
      $userFind = $request->fetch();
     if($userFind){
       echo"<div class='alert alert-info text-center'> Vous êtes connecter !</div>";
      $_SESSION['users'] =[
        'id' =>$userFind['id'],
        'nom' =>$userFind['nom'],
        'email' =>$userFind['email'],
        'pseudo' =>$userFind['pseudo'],
        'avatar' =>$userFind['avatar'],
        'dateadd' =>$userFind['dateadd'],
        'updatetime' =>$userFind['updatetime']
      ];
      header('location:chatgpt.php');
     }else{
    echo"<div class='alert alert-danger '> Votre email ou mot de passse est incorrect</div>";
     };
    };
    ?>
        <input type="email" name="email" id="email" required placeholder="Entrez votre email">
        <input type="password" name="pass" id="pass" required placeholder="Mot de passe">
        <p>J'ai <a href="mot_de_passe_oublié.php">oublié mon mot de passe</a> ou <a href="Register.php">Créez-en ici</a></p>
        <input  type="submit" name="soumis" id="soumis" value="Connecter">
    </form>
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
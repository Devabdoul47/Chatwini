<?php
require_once('db.php');
require_once('Isexpired.php');
session_start();
?>
<!doctype html>
<html lang="fr">

<head>
  <title>nouveau mot de passe Chatwini</title>
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
  <?php
// vérifier si l'email et le token envoyer vers l'addresse email est  dans le lien 
if(isset($_GET['email']) && isset($_GET['token'])){
   $changepass = [
    'email' => htmlspecialchars($_GET['email']),
    'token' => htmlspecialchars($_GET['token']),
   ];
//  si oui on verifie dans la base de donnée si l'email et le token correspond aux à celle qui a été envoyer dans la base de donner
  $datareset = $db->prepare("SELECT * FROM reinstialisation WHERE email= :email AND token= :token");
  $datareset->execute($changepass);
  $reset_find = $datareset->fetch();
//   si on le trouve et que le temps du lien est  expirer alors on renvoyer une autre encore
  if($reset_find){
   
  }else{
    echo"
    <div class='container responsive'>
    <div class='col-md-6 mt-1 offset-md-3'>
    
      <p class='alert alert-danger text-center mb-0'>Aucune action a effectué  <a href='mot_de_passe_oublié.php'> réinstialiser à nouveaux</a></p>    
      <video src='media/moque.mp4' autoplay repeat muted style='width:100%; height:auto;'></video>
      </div>
    </div>

    <div class='col-md-6 offset-md-3 mt-3'>
      <p class='text-center mt-2'>&copy; 
   ".date('Y')." Tous droits réservés créer par Abdoul</p></div>";die();
  };
  
// si le token et l'email n'est pas dans le lien on le redirige vers la page de connexion 
}else{
    header('location:index.php');
};


// Après changement du mot de passe on vérifie lors de l'envoie si les nouveaux mots de passe sont identifique avec la confirmation du mot de passe
if(isset($_POST['send'])){
if($_POST['pass'] == $_POST['pass_confirm']){
    $updatedata= [
        'email' => htmlspecialchars($_POST['email']),
        'pass' => hash('sha512',$_POST['pass'])
    ];
    // On met ajout maintenant le nouveau mot de passe en remplaçant par l'ancien
      $toto = $db->prepare(" UPDATE utilisateur  SET pass=:pass WHERE email= :email");
      $toto->execute($updatedata);
    // Une fois la mise à jour fait on supprime le token et l'email qui a servie de reinstialisation dans la table de resset_password
      $sup_recup = $db->prepare("DELETE FROM  reinstialisation  WHERE  token= :token");
      $sup_recup->execute(['token'=>$_GET['token']]);
    }else{
        echo"<div class='alert alert-danger text-center'> Les mots de passe saisies sont différents !</div>";
    };
    echo "
    <div class='container responsive'>
    <div class='col-md-6 mt-5 offset-md-3'>
    <a href='index.php'><img src='media/IMG-20230522-WA0043.jpg' alt='' class='mt-3 mb-3 offset-md-5' id='logo' style='width:60px; height:60px; border-radius:100px 100px 0px 100px;'></a>
    <div class='card p-3'>
    <p class='alert alert-success text-center'>Félicitation votre mot de passe a été changer avec succès vueillez <a href='index.php'>vous connectez</a>  à présent !</p>
    </div>
    </div>
    </div>
    <div class='col-md-6 offset-md-3 mt-3'>
      <p class='text-center mt-2'>&copy; 
   ".date('Y')." Tous droits réservés créer par Abdoul</p></div>"; die();
};
?>
 <form action="" method="post">
<div class="container responsive">
 <div class="col-md-6 mt-3 offset-md-3">
 <a href="index.php"><img src="media/IMG-20230522-WA0043.jpg" alt="" class="mt-3 mb-0 offset-md-5" id="logo" style="width:60px; height:60px; border-radius:100px 100px 0px 100px;"></a>
<h2 class="text-center mt-3">Nouveau mot de passe</h2>
<div class="card p-3">
        <div class="md-3">
            <input type="email" name="email" id="email" value=" <?= $_GET['email'] ?>"  placeholder="Vtoken"  class="form-control ">
        </div>
        <div class="md-3">
            <input type="password" name="pass" id="pass" autofocus required placeholder="Nouveau mot de passe" class="form-control mt-3 mb-3">
        </div>
        <div class="md-3">
            <input type="password" name="pass_confirm" id="pass" autofocus required placeholder="confirmer votre mot de passe" class="form-control mt-3 mb-3">
        </div>
        <input class="btn btn-primary" type="submit" name="send" value="Changer maintenant">
    </div>
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
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>
</html>
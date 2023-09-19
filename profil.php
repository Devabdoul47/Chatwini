<?php
 require_once('db.php');
require_once('Isexpired.php');
 session_start();
 if(!$_SESSION['users']){
  header('location:index.php');
 };
 ?>
<!doctype html>
<html lang="fr">

<head>
  <title>Mon profil</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="style.css">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light ">
           <div class="container d-flex">
            <?php
                $chercheur = $db->prepare('SELECT avatar FROM utilisateur WHERE avatar= :user');
                $Ungars = $chercheur->execute(['user'=> $_SESSION['users']['avatar']]);
                $il_trouve = $chercheur->fetch(); 
            ?>
            <?php if($il_trouve):?>
             <a class="navbar-brand" href="profil.php"><img src="<?= $_SESSION['users']['avatar']?>" style="width:60px;  height:60px; border-radius:100px"></a>
             <?php else :?>
             <a class="navbar-brand" href="profil.php"><img src="media/user-286.png"  style="width:60px;  height:60px; border-radius:100px"></a>
             <?php endif ;?> 

             <button class="navbar-toggler hidden-lg-up bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                 aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon "></span></button>
             <div class="collapse navbar-collapse offset-md-2" id="collapsibleNavId">
              <div class="md-3 p-0">
                <i class="fa-solid fa-user fa-lg d-flex" style="position:relative;  left:23px;" id="icon"></i>
                <a href="chatwini.php" class="btn btn-primary m-3" id="deconnec">Actualités</a>
               </div>
               <div class="md-3 p-0">
                <a href="amis.php" class="btn btn-primary m-3" id="deconnec">Amis</a>
               </div>
               <div class="md-3 p-0">
                <i class="fa-solid fa-comment fa-lg d-flex" style="position:relative;  left:23px;" id="icon"></i>
                <a href="messagerie.php" class="btn btn-primary m-3" id="deconnec">Messagerie</a>
               </div>
               <div class="md-3 p-0">
                <i class="fa-solid fa-comment fa-lg d-flex" style="position:relative;  left:23px;" id="icon"></i>
                <a href="groupe.php" class="btn btn-primary m-3" id="deconnec">Groupes</a>
               </div>
               <div class="md-3 p-0">
                <i class="fa-solid fa-gear fa-lg d-flex" style="position:relative;  left:23px;" id="icon"></i>
                <a href="paramètre.php" class="btn btn-primary m-3"  id="deconnec">Paramètres</a>
               </div>
               <div class="md-3 p-0 m-4">
                    <img src="media/logout (1).png" width="30" height="30" class="" alt="" id="deconnecter">
               </div>
             </div>
           </div>
         </nav>
  </header>
  <main>

  </main>
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
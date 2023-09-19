<?php
 require_once('db.php');
require_once('Isexpired.php');
 session_start();
 if(!$_SESSION['users']){
  header('location:index.php');
 };
//  if(isset($_FILES['avatar'])){

//   //  Créer une variable qui porte l'extension de l'image (png, jpeg, jpg etc..)
//       $image_ext = explode('/',$_FILES['avatar']['type']);

//       //  on crée  une varible pour le nom du fichier en incrémentant 'av-'.date('YmdHis').'.' avec l'extension du fichier pour plus de sécuriter 
//       $avatar_name = 'av-'.date('YmdHis').'.'.$image_ext['1'];

//       //  On crée le chemin du fichier à télécharger concatener au nom du fichier 
//       $chemin = 'Upload_avatar/'.$avatar_name;

//       // Avec la fonction move_uploaded_file on cherche la clé avatar et son temple name et le déplacer vers notre chemin 
//       move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
    
// };
  
 ?>
<!doctype html>
<html lang="fr">
<head>
  <title>Chatwini</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>
<body>
<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                <a href="#" class="btn btn-primary m-3" id="deconnec">Actualités</a>
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
<div style="position:relative;"> 
  <div class=" p-3 mt-5 col-md-4 offset-md-4 bg-secondary" style="position:absolute; top:140px; border:1px solid #ddd; border-radius:8px; display:none;" id="boiteu">
  <p class="text-center text-white fs-5">Souhaitez-vous vraiment vous déconnecter ?</p>
  <a href="deconnexion.php" class="btn btn-info   m-1 col-md-3 text-center" style="float: right;" id="oui">Oui</a>
  <button type="button" class="btn btn-danger m-1  text-center col-md-3" style="float: right;" id="non">Non</button>
  </div>
</div>
<!-- Modal  !-->
<div class="modal fade bg-dark" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
      <img src=""  style="width:60px;  height:60px; border-radius:100px">
      <h1 class="modal-title fs-5 " id="exampleModalLabel" style="position:relative; left:130px;">Paramètres</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
          <div class="">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
           <button type="submit" class="btn btn-primary">Sauvegarder</button>
          </div>
        </form>
      </div>
    </div>
    </div>
   </div>
<!-- Fin modal  !-->
<div id="carouselId" class="carousel slide" data-bs-ride="carousel">
  <ol class="carousel-indicators">
    <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
    <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
    <li data-bs-target="#carouselId" data-bs-slide-to="2" aria-label="Third slide"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img src="holder.js/900x500/auto/#777:#555/text:First slide" class="w-100 d-block" alt="First slide">
    </div>
    <div class="carousel-item">
      <img src="holder.js/900x500/auto/#666:#444/text:Second slide" class="w-100 d-block" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img src="holder.js/900x500/auto/#666:#444/text:Third slide" class="w-100 d-block" alt="Third slide">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
    </button>
</div>





<footer>
  <div class="col-md-6 offset-md-3 mt-4 p-1">
    <p class="text-center mt-2">&copy; <?= date('Y'); ?> | Tous droits réservés propulsé par Abdoul</p>
 </div>
</footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <script src="chatwini.js"></script>
  <script src="https://kit.fontawesome.com/3a537738e0.js" crossorigin="anonymous"></script>
</body>
</html>
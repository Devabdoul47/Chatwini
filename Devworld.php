<?php
require_once('db.php');
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="devworld.css">
    <title>Devworld</title>
</head>
<body>
<a href="chatgpt.php">Retour</a>
 &nbsp;
  <a href="deconnexion.php" id="deconnecte">Déconnecter</a>
<?php
  if(isset($_POST['envoie'])){
      $message = [ 'message' => htmlspecialchars($_POST['message']) ];
      $request = $db->prepare("INSERT INTO messagerie(message) VALUES(:message)");
      $request->execute($message);
    };

    $sms =[ ];
    $req = $db->prepare('SELECT message, dateadd  FROM messagerie');
    $req->execute($sms);
    $sms = $req->fetchall();
    ?>

   <div id="sectsms"> 
    
  <?php for($i=0; $i <count($sms); $i++): ?>
    <img src="media/user.png" alt="" title="">
    <div id="datte">
    <div id="contenu">
    <p><?= $sms[$i]['message'] ?></p>
   </div>
   <h5><?= $sms[$i]['dateadd'] ?></h5>
    </div>
   <br>
  <?php endfor; ?>
  </div>
  <form action="" method="post">
       <textarea name="message" id="message" placeholder="Écrivez votre message ici..." title="le champs messagerie ne peut pas être vide" cols="30" rows="10" required></textarea>
       <input type="submit" value="Envoyez"  name="envoie" id="envoie">
</form>
<script src="devworld.js"></script>
</body>
</html>
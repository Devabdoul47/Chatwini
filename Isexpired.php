<?php
//  Fonction d'expiration de temps

$startTime = date('Y-m-d H:i:s'); // Heure de début recupérer dynamique
$expirationMinutes = 1; // Minute d'expiration 
$currentTime = time(); // Le timestamp actuel

function isExpired($startTime, $expirationMinutes = 1){ // La fonction `isExpired` prend deux paramètres : `$startTime`, qui est l'heure de début de la fonction, et `$expirationMinutes`, qui est la durée d'expiration en minutes (par défaut, 30 minutes).
 $expirationTime = strtotime($startTime . ' +' . $expirationMinutes.'minute'); //`strtotime($startTime . ' +' . $expirationMinutes . ' minutes')` calcule l'heure d'expiration en ajoutant la durée d'expiration en minutes à l'heure de début.
 $currentTime = time(); //`time()` est utilisé pour obtenir le timestamp actuel.
  if ($currentTime > $expirationTime) {
      return true; // La fonction a expiré
  } else {
      return false; // La fonction est encore valide
  }
};
// $isExpired = isExpired($startTime, $expirationMinutes);
// if ($isExpired) {
//     echo "La fonction a expiré.";
// } else {
//     echo "La fonction est encore valide.";
// }

?>
<?php
try{
    $db = new PDO("mysql:host=localhost;dbname=chatwini",'root','');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die(" <img style='height:100vh;width:100%' src='https://i0.wp.com/learn.onemonth.com/wp-content/uploads/2017/08/1-10.png?fit=845%2C503&ssl=1' />");
}
?>
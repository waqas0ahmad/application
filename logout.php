<?php
try{
    session_start();
    $_SESSION["LOGGED_IN"]='FALSE';
    $_SESSION["LOGIN_ERROR"]='';
    header('Location: ./');
  }catch(Exception $e){
      header('Location: ./');
    }
    ?>

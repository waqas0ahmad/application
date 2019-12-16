<?php

session_start();
if(isset($_GET['link']))
{
    $var_1 = $_GET['link'];   
    chmod ("./uploads/$var_1", 0777);
    
    if(copy("./uploads/$var_1" , "./recycle-bin/$var_1")){
        unlink("./uploads/$var_1") or die("Couldn't delete file");
        $_SESSION["deleteFile"]="yes";        
        header('location: ./');
    }else{
        $_SESSION["deleteFile"]="";      
        header('location: ./');
    }
}else{
    $_SESSION["deleteFile"]="";    
    header('location: ./');
}
?>
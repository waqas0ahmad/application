<?php
if(isset($_GET['link']))
{
    $var_1 = $_GET['link'];
    if(!file_exists("./permDeleted/"))
    mkdir("./permDeleted/",0777,true);
    chmod("./permDeleted/$var_1",0777);
    if(copy("../recycle-bin/$var_1","./permDeleted/$var_1")){
        $myFileLink = fopen("../recycle-bin/$var_1", 'w') or die("can't open file");
    fclose($myFileLink);    
    unlink("../recycle-bin/$var_1") or die("Couldn't delete file");
    header('location: ./');
    }else{
        header('location: ./');
    }
    // $file = $var_1;
    
    // $myFileLink = fopen("../recycle-bin/".$file, 'w') or die("can't open file");
    // fclose($myFileLink);    
    // unlink('../recycle-bin/'.$file) or die("Couldn't delete file");
    // // chmod ("./uploads/$file", 0777);
    // // if(copy("./uploads/$file" , "./recycle-bin/$file")){
    // //     unlink("./uploads/$file") or die("Couldn't delete file");
    //      header('location: ./');
    // // }
}else{

}
?>
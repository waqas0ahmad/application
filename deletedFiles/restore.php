<?php
if(isset($_GET['link']))
{
    $var_1 = $_GET['link'];
    $file = $var_1;
    
    $myFileLink = fopen("../uploads/".$file, 'w') or die("can't open file");
    fclose($myFileLink);    
    //unlink($file) or die("Couldn't delete file");
    chmod ("../uploads/$file", 0777);
    if(copy( "../recycle-bin/$file","../uploads/$file" )){
        unlink("../recycle-bin/$file") or die("Couldn't delete file");
        header('location: ./');
    }
}else{

}
?>
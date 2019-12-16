<?php
class Helper {
    public function GetFile($fileName){
        $myfile = fopen("$fileName", "r") or die("Unable to open file!");
        $readData=fread($myfile,filesize("$fileName"));
        fclose($myfile);
        return $readData;
    }
}
?>
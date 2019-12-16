<?php
class Helper {
    public function GetFile($fileName){
        $myfile = fopen("$fileName", "r") or die("Unable to open file!");
        $readData=fread($myfile,filesize("$fileName"));
        fclose($myfile);
        echo $readData;
    }
    static function getDirContents($dir, &$results = array()){
        $files = scandir($dir);
        foreach($files as $key => $value){
            $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
            if(!is_dir($path)) {
                $results[] = $path;
            } else if($value != "." && $value != "..") {
                Helper::getDirContents($path, $results);
                $results[] = $path;
            }
        }
        return $results;
    }
    public static function GetFtpTable()
    {
        $files=Helper::getDirContents('./uploads/') ;
        sort($files);
        if(count($files)>0){
        foreach ($files as $value ) {
            echo "<tr><td title='".pathinfo($value,2)."'><img src=".(is_dir($value)?'./images/folder.png':'./images/file.png')." style='max-width:24px;width:24px;margin-right:15px'/>".pathinfo($value,2)."</td>";
            if(filetype($value)!=="dir")
            echo "<td class='text-right'>".calCulate($value)." </td>";
            else echo "<td class='text-right'></td>";
            echo "<td class='text-center'><a href='download.php?link=./uploads/".pathinfo($value,2)."' target='_blank'><img src='./images/download.png'/></a>&nbsp;";
            echo"|&nbsp;<a href='javascript:;;' onclick=\"DeleteAlert('".pathinfo($value,2)."')\"><img src='./images/delete.png'/></a></td>";
        }
      }else{
        echo '<tr><td colspan="3" class="text-center"><span class="text-danger">No file found</span></td></tr>';
      }
    }
}
?>
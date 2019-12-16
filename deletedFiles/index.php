<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>

  <link href="../bootstrap/css/bootstrap.min.css" rel = "stylesheet"
   type = "text/css"/>
  <link href="../css//style.css" rel = "stylesheet"
   type = "text/css"/>
   <script src="../jquery/jquery.min.js"></script>
   <script src="../bootstrap/js/bootstrap.min.js"></script>
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/javascript.util/0.12.12/javascript.util.min.js"></script> -->

   <?php
    function LoggedIn()
   {
     if(isset($_SESSION["LOGGED_IN"])){
       if(!empty($_SESSION["LOGGED_IN"])){
         if($_SESSION["LOGGED_IN"]=="TRUE") return true;
       }
     }
     return false;
   }
   ?>
   <script>
    var deleteFile=(name)=>{
      if (confirm(`Do you want to delete ${name}?`)) {
        location.href=`./delete.php?link=${name}`;
      }
    }
   </script>
   <body>
   <?php if(!LoggedIn()):?>
   <div class="login-out">
      <div class="login-in">
         <form class="row" method="post" action="../login.php">
           <div class="col-md-12 text-center form-group">
             <label style="font-size: 45px;border-bottom: 5px solid #738bff;">Login</label>
           </div>
            <div class="col-md-12 form-group">
              <label>Username:</label>
               <input type="text" class="form-control" name="U_NAME" placeholder="e.g. WA201" required/>
            </div>
            <div class="col-md-12 form-group">
              <label>Password:</label>
            <input type="password" class="form-control" name="U_PASS" placeholder="Your password" required/>
            </div>
            <div class="col-md-12">
              <input type="submit" value="Login" class="btn btn-primary button pull-right"/>
            </div>
         </form>
      </div>
   </div>
   <div role="alert" aria-live="assertive" aria-atomic="true" class="toast " id="toast-error" data-delay="1500"
     data-autohide="true">
     <div class="toast-header bg-danger text-white">
       <i class="glyphicon glyphicon-user"></i>
       <strong class="mr-auto">Error</strong>

       <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="alert-danger  toast-body">
       <span id="error"></span>
     </div>
   </div>
   <?php
   if(isset($_SESSION["LOGIN_ERROR"])){
       if(!empty($_SESSION["LOGIN_ERROR"])){
         if($_SESSION["LOGIN_ERROR"]!=""){
           echo "<script>$('#error').text('".$_SESSION["LOGIN_ERROR"]."');$('#toast-error').toast('show');</script>";
           $_SESSION["LOGIN_ERROR"]="";
         }
       }
   }
   ?>
   <?php else: ?>
<span style="font-size:30px;cursor:pointer;position: absolute;z-index: 1;" class="text-white p-2 pl-3 pr-3 bg-primary" onclick="openNav()">&#9776;</span>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="../">Home</a>
  <a href="./">Deleted Files</a>
  <a href="../logout.php">Logout</a>
</div>
    <div class="container box background-container">
        <div class="p-2 top">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." style="width:100% !important;" title="Type in a name" class="m-0 p-2 pl-5 w-75">
        <!-- <button type="button" class="btn btn-primary button pull-right" data-toggle="modal" data-target="#myModal">Upload a file</button> -->
        </div>
        <?php
        function getDirContents($dir, &$results = array()){
            $files = scandir($dir);
            foreach($files as $key => $value){
                $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
                if(!is_dir($path)) {
                    $results[] = $path;
                } else if($value != "." && $value != "..") {
                    getDirContents($path, $results);
                    $results[] = $path;
                }
            }
            return $results;
        }
        ?>

        <table class="table table-bordered table-hover table-striped mt-2" cellspacing="0" id="myTable">
            <tr><th>File Name</th><th class="text-center">Action</th></tr>
            <?php
                $files=getDirContents('../recycle-bin/') ;
                if(count($files)<1){
                    echo '<tr><td colspan="2" class="text-center"><span class="text-danger">No record found</span></td></tr>';
                }else{
                sort($files);
                foreach ($files as $value ) {
                    echo '<tr>
                    <td title="'.pathinfo($value,2).'"><img src='.(is_dir($value)?"../images/folder.png":"../images/file.png").' style="max-width:24px;width:24px;margin-right:15px"/>'.pathinfo($value,2)."</td>
                    <td class='text-center'><a href='./restore.php?link=".pathinfo($value,2)."' target=''><img src='../images/restore.png'/></a>
                    &nbsp;|&nbsp;<a href='javascript:;;' onClick='PermanentDeleteAlert(\"".pathinfo($value,2)."\")'><img src='../images/delete.png'/></a></td>";
//./delete.php?link=".."
                }
            }
            ?>
        </table>

    </div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title">Upload a file</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="input-container">
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <button class="browse-btn btn btn-outline-primary" type="button">
                            Browse Files
                        </button>
                        <span class="file-info">Upload file</span>
                    </div>
                    <input type="submit" value="Upload" style="margin-left:5px;padding: 10px;" class="btn btn-outline-primary" name="submit">
                </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

    <script>
        const uploadButton = document.querySelector('.browse-btn');
        const fileInfo = document.querySelector('.file-info');
        const realInput = document.getElementById('fileToUpload');
        uploadButton.addEventListener('click', (e) => {
            realInput.click();
        });
        realInput.addEventListener('change', () => {
            const name = realInput.value.split(/\\|\//).pop();
            const truncated = name.length > 20
                ? name.substr(name.length - 20)
                : name;
            fileInfo.innerHTML = truncated;
        });
        function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
    </script>
    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast " data-delay="5000" data-autohide="true">
  <div class="toast-header">
    <i class="glyphicon glyphicon-user"></i>
    <strong class="mr-auto">File</strong>

    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
    Your file has been uploaded.
  </div>
</div>
<?php
if(isset($_SESSION["addFile"])){
    if(!empty($_SESSION["addFile"])){
        echo "<script>$('.toast').toast('show');</script>";
        $_SESSION["addFile"]="";
    }
}
?>

</div>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
<?php endif; ?>
<script src='../jquery/site.js'></script>
</body>

</html>

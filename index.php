<?php
session_start();
require "helper.php";
?>
<!DOCTYPE html>
<html>

<head>

  <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="./css//style.css" rel="stylesheet" type="text/css" />
  <script src="./jquery/jquery.min.js"></script>
  <script src="./bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/javascript.util/0.12.12/javascript.util.min.js"></script>
  <script>
    function deleteFile(filename) {
      if (confirm(`do do want to delete "${filename}" ?`)) {
        location.href = `delete.php?link=${filename}`;
      }
    }
  </script>
</head>
<?php
function LoggedIn()
{
  if (isset($_SESSION["LOGGED_IN"])) {
    if (!empty($_SESSION["LOGGED_IN"])) {
      if ($_SESSION["LOGGED_IN"] == "TRUE") return true;
    }
  }
  return false;
}
function calCulate($value)
{
  return ceil(filesize($value) / 1024) > 1024 ? ceil((filesize($value) / 1024) / 1024) . " MB" : (ceil(filesize($value) / 1024) . " KB");
}
?>

<body class="scrollbar">
  <div class='back-img'></div>
  <div id="cus-bd" class="cus-back-drop fade"></div>
  <?php if (!LoggedIn()) : ?>
    <?php include_once('./login.view.php') ?>
    <?php

      // Helper::GetFile("login.view.php");
      if (isset($_SESSION["LOGIN_ERROR"])) {
        if (!empty($_SESSION["LOGIN_ERROR"])) {
          if ($_SESSION["LOGIN_ERROR"] != "") {
            echo "<script>$('#error').text('" . $_SESSION["LOGIN_ERROR"] . "');$('#toast-error').toast('show');</script>";
            $_SESSION["LOGIN_ERROR"] = "";
          }
        }
      }
      ?>
  <?php else : ?>
    <span style="font-size:30px;cursor:pointer;position: absolute;z-index: 1;" class="text-white p-2 pl-3 pr-3 bg-primary" onclick="openNav()">&#9776;</span>
    <div id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <a href="./">Home</a>
      <a href="./deletedFiles/">Deleted Files</a>
      <a href="./logout.php">Logout</a>
    </div>



    <div class="container box background-container">
      <div class="p-2 top input-group">
        <input type="text" class="m-0 p-2 pl-5 w-custom myInput form-control" style="height: 42px;" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." aria-label="Search for names.." aria-describedby="button-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary button" type="button" id="button-addon2" data-toggle="modal" data-target="#myModal">Upload a
            file</button>
        </div>
      </div>
      <!-- <div class="p-2 top input-group">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" class="m-0 p-2 pl-5 w-custom myInput">

        <div class="input-group-append">
          <button type="button" class="btn btn-primary button" data-toggle="modal" data-target="#myModal">Upload a
            file</button>
        </div>
      </div> -->


      <table class="table table-bordered table-hover table-striped mt-2" cellspacing="0" id="myTable">
        <tr>
          <th>File Name</th>
          <th>File Size</th>
          <th class="text-center">Action</th>
        </tr>
        <?php
          Helper::GetFtpTable();
          ?>
      </table>

    </div>
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">

            <h4 class="modal-title">Upload a file</h4>
            <a class="close" data-dismiss="modal">&times;</a>
          </div>
          <div class="modal-body">
            <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="input-group mb-3">
              <label class="form-control p-0"> <input type="file" name="fileToUpload" class="form-control" id="fileToUpload" onchange="onFileSelect(this)" required>
                <!-- <button class="btn btn-outline-primary" type="button">
                  Browse Files
                </button> -->
                <span class="file-info btn btn-outline-primary">Upload file</span>
              <span id="file"></span>
              </label>
  <!-- <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2"> -->
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Upload</button>
  </div>
</div>
              <!-- <div class="input-container">
                <input type="file" name="fileToUpload" class="form-control" id="fileToUpload" required>
                <button class="browse-btn btn btn-outline-primary" type="button">
                  Browse Files
                </button>
                <span class="file-info">Upload file</span>
              </div>
              <input type="submit" value="Upload" style="margin-left:5px;padding: 10px;" class="btn btn-outline-primary" name="submit"> -->
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-outline-danger mr-1" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
    <script src="./jquery/jquery.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/javascript.util/0.12.12/javascript.util.min.js"></script>
    <script>
      const uploadButton = document.querySelector('.browse-btn');
      const fileInfo = document.querySelector('.file-info');
      const realInput = document.getElementById('fileToUpload');
      uploadButton.addEventListener('click', (e) => {
        realInput.click();
      });
      realInput.addEventListener('change', () => {
        const name = realInput.value.split(/\\|\//).pop();
        const truncated = name.length > 20 ?
          name.substr(name.length - 20) :
          name;
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

    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast " id="toast-upload" data-delay="1500" data-autohide="true">
      <div class="toast-header bg-success text-white">
        <i class="glyphicon glyphicon-user"></i>
        <strong class="mr-auto">File</strong>

        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="alert-success  toast-body">
        Your file has been uploaded.
      </div>
    </div>
    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" id="toast-delete" data-delay="1500" data-autohide="true">
      <div class="bg-danger text-white toast-header">
        <i class="glyphicon glyphicon-user"></i>
        <strong class="mr-auto">File</strong>

        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="alert-danger toast-body">
        Your file has been moved to recyle bin.
      </div>
    </div>
    <?php
      if (isset($_SESSION["addFile"])) {
        if (!empty($_SESSION["addFile"])) {
          if ($_SESSION["addFile"] == "yes") {
            echo "<script>$('#toast-upload').toast('show');</script>";
            $_SESSION["addFile"] = "";
          }
        }
      }
      if (isset($_SESSION["deleteFile"])) {
        if (!empty($_SESSION["deleteFile"])) {
          if ($_SESSION["deleteFile"] == "yes") {
            echo "<script>$('#toast-delete').toast('show');</script>";
            $_SESSION["deleteFile"] = "";
          }
        }
      }
      ?>

    </div>

    <script>
      function openNav() {
        document.getElementsByTagName('body')[0].classList.add("modal-open");
        document.getElementById("mySidenav").style.width = "250px";
        $("#cus-bd").addClass("show");
      }

      function closeNav() {
        document.getElementsByTagName('body')[0].classList.remove("modal-open");
        document.getElementById("mySidenav").style.width = "0";
        $("#cus-bd").removeClass("show")
      }
      $('#mySidenav').on('focusout', function() {
        $(this).removeClass('modal-open');
        $(this).css({
          width: 0
        });
      });
      <?php endif; ?>
    </script>
    <script src='./jquery/site.js'></script>
</body>

</html>
<?php
//if(){
    $servername = "sql301.move.pk";
    $username = "mov_23834279";
    $password = "Pampalak";
    $dbname = "mov_23834279_notepad";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $data=$_POST['html'];
    $sql = "update notepad_tbl set text='$data' where id='ekaur45'";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
  //  }
?>
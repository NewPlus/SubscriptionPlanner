<?php

    $host = '';
    $dbuser = '';
    $dbpw = '';
    $dbname = '';

    $conn = new mysqli($host, $dbuser, $dbpw, $dbname);

    session_start();
    if(empty($_SESSION['id'])) {
        header('Location: login.php');
    }
    else {
        $u_id = $_SESSION['id'];
        $u_name = $_SESSION['name'];
        $_SESSION['id'] = $u_id;
        $_SESSION['name'] = $u_name;
    }

    $strOttName = $_GET['ottname'];
    $query_delete = "DELETE FROM ottList_t WHERE strId = '".$u_id."' and strOttName = '".$strOttName."';";
    mysqli_query($conn, $query_delete);

    $query_resort = "ALTER TABLE ottList_t AUTO_INCREMENT=1; SET @COUNT = 0; UPDATE ottList_t SET intNumber = @COUNT:=@COUNT+1;";
    mysqli_query($conn, $query_resort);
    $query_resort = "SET @COUNT = 0;";
    mysqli_query($conn, $query_resort);
    $query_resort = "UPDATE ottList_t SET intNumber = @COUNT:=@COUNT+1;";
    mysqli_query($conn, $query_resort);
?>
<script>
    window.close();
</script>
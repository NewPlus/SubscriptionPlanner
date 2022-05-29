<?php
    $host = '';
    $dbuser = '';
    $dbpw = '';
    $dbname = '';

    $conn = new mysqli($host, $dbuser, $dbpw, $dbname);

    $OttName = $_GET["ottname"]; 
    $u_id = $_GET["id"];
    
    $q_img = "select intOttPay, intOttDate, strOttName from ottList_t where strId = '".$u_id."' and strOttName ='".$OttName."';";
    $r_img = mysqli_query($conn, $q_img);
    while($row = mysqli_fetch_array($r_img)){
        $OttPay = $row['intOttPay'];
        $OttDate = $row['intOttDate'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>See more</title>
</head>

<body>
    <div align="center">
        <p><?php echo $OttName ?></p>
        <p>매월 <?php echo $OttPay ?>\</p>
        <p>매월 <?php echo $OttDate ?>일 결제</p>

        
        <a href=  >수정하기</a>
        &nbsp;&nbsp;&nbsp;
        <a href=  >삭제하기</a>

    </div>

</body>

</html>
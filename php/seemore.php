<?php
    $host = '';
    $dbuser = '';
    $dbpw = '';
    $dbname = '';

    $conn = new mysqli($host, $dbuser, $dbpw, $dbname);

    session_start();
    if(empty($_GET['id'])) {
        header('Location: login.php');
    }
    else {
        $u_id = $_GET['id'];
        $OttName = $_GET["ottname"];
        $_SESSION['id'] = $u_id;
        $_SESSION['name'] = $u_name;
    }
    
    $q_img = "select intOttPay, intOttDate from ottList_t where strId = '".$u_id."' and strOttName ='".$OttName."';";
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
        <?php 
            if($OttDate > 100){
                ?>
                <p>매년 <?php echo intdiv($OttDate,100) ?>월 <?php echo fmod($OttDate, 100) ?>일 결제</p>
                <?php
            }
            else{
                ?>
                <p>매월 <?php echo $OttDate ?>일 결제</p>
                <?php
            }
        ?>

        
        <a href="http://ottplanner.kro.kr/pro1/fin/ottmodify.php?ottname=<?php echo $OttName ?>">수정하기</a>
        &nbsp;&nbsp;&nbsp;
        <a href="http://ottplanner.kro.kr/pro1/fin/ottdelete.php?ottname=<?php echo $OttName ?>" >삭제하기</a>

    </div>

</body>

</html>
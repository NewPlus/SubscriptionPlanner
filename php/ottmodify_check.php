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
    }
    
    $flag = 0;
    
    if($_POST['selectMonth'] == "0"){
        $flag = 1;
    }
    else if($_POST['tbPays'] == ""){
        $flag = 2;
    }

    if($flag == 0){

        $strOttName = $_POST['strOttNames'];
        
        $intOttDate = "";
        if($_POST['intOttDate'] == "0") $intOttDate = $_POST['selectDays'];
        else if($_POST['intOttDate'] == "1") $intOttDate = (($_POST['selectMonth'] - 1) * 100) + $_POST['selectDays'];

        $intOttPay = 0;
        $intOttPay = $_POST['tbPays'];

        $query_add_ott = "UPDATE ottList_t SET intOttPay = '".$intOttPay."', intOttDate = '".$intOttDate."' WHERE strId = '".$u_id."' and strOttName = '".$strOttName."';";
        mysqli_query($conn, $query_add_ott);

        ?>
            <script>
                window.close();
            </script>
        <?php
    }
    else if($flag == 1){
        ?>
            <script>
                alert('날짜를 제대로 선택해주세요!');
                window.location.href = "http://ottplanner.kro.kr/pro1/fin/ottmodify.php";
            </script>
        <?php
    }
    else if($flag == 2){
        ?>
            <script>
                alert('지불 금액을 입력해주세요!');
                window.location.href = "http://ottplanner.kro.kr/pro1/fin/ottmodify.php";
            </script>
        <?php
    }
?>
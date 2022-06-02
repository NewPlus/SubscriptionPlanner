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
    $q_img = "select strOttName from ottList_t where strId = '".$u_id."';";
    $r_img = mysqli_query($conn, $q_img);
    while($row = mysqli_fetch_array($r_img)){
        $ottNames = $row['strOttName'];
        if($ottNames == $_POST['strOttNames']){
            $flag = 1;
            break;
        }
        else if($_POST['strOttNames'] == "기타" && $_POST['tbOthers'] == ""){
            $flag = 2;
            break;
        }
        else if($_POST['selectMonth'] == "0"){
            $flag = 3;
            break;
        }
        else if($_POST['tbPays'] == ""){
            $flag = 4;
            break;
        }
    }

    if($flag == 0){
        $ImgList = array('Youtube Premium'=>'img/youtube_pre.jpg', 
                        'Netflix'=>'img/netflix.jpg', 
                        'Disney Plus'=>'img/disney_plus.jpg', 
                        'Apple tv Plus'=>'img/appletv.png', 
                        'Tving'=>'img/tving.jpg', 
                        'Watcha'=>'img/watcha.png', 
                        'Wavve'=>'img/wavve.jpg', 
                        'Coupang play'=>'img/coupangplay.jpg', 
                        'Ms office 365'=>'img/office365.png');

        $SrcList = array('Youtube Premium'=>'https://www.youtube.com/premium', 
                        'Netflix'=>'https://www.netflix.com/kr/', 
                        'Disney Plus'=>'https://www.disneyplus.com/ko-', 
                        'Apple tv Plus'=>'https://www.apple.com/kr/apple-tv-plus/', 
                        'Tving'=>'https://www.tving.com/onboarding', 
                        'Watcha'=>'https://watcha.com/', 
                        'Wavve'=>'https://www.wavve.com/', 
                        'Coupang play'=>'https://www.coupangplay.com/', 
                        'Ms office 365'=>'https://www.microsoft.com/ko-kr/microsoft-365');

        $strOttName = "";
        $strOttImg = "";
        $strSrc = "";
        if($_POST['strOttNames'] != "기타"){
            $strOttName = $_POST['strOttNames'];
            $strOttImg = $ImgList[$strOttName];
            $strSrc = $SrcList[$strOttName];
        }
        else{
            $strOttName = $_POST['tbOthers'];
            $strOttImg = "img/default.jpg";
        }
        
        $intOttDate = "";
        if($_POST['intOttDate'] == "0") $intOttDate = $_POST['selectDays'];
        else if($_POST['intOttDate'] == "1") $intOttDate = (($_POST['selectMonth'] - 1) * 100) + $_POST['selectDays'];

        $intOttPay = 0;
        $intOttPay = $_POST['tbPays'];

        $query_add_ott = "INSERT INTO ottList_t(strId, strOttName, intOttPay, intOttDate, strOttImg, strSrc) VALUES ('".$u_id."','".$strOttName."','".$intOttPay."','".$intOttDate."','".$strOttImg."','".$strSrc."');";
        mysqli_query($conn, $query_add_ott);

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
        <?php
    }
    else if($flag == 1){
        ?>
            <script>
                alert('이미 가입된 구독 상품입니다!');
                window.location.href = "http://ottplanner.kro.kr/pro1/fin/ottadd.php";
            </script>
        <?php
    }
    else if($flag == 2){
        ?>
            <script>
                alert('구독명을 선택하거나 입력해주세요!');
                window.location.href = "http://ottplanner.kro.kr/pro1/fin/ottadd.php";
            </script>
        <?php
    }
    else if($flag == 3){
        ?>
            <script>
                alert('날짜를 제대로 선택해주세요!');
                window.location.href = "http://ottplanner.kro.kr/pro1/fin/ottadd.php";
            </script>
        <?php
    }
    else if($flag == 4){
        ?>
            <script>
                alert('지불 금액을 입력해주세요!');
                window.location.href = "http://ottplanner.kro.kr/pro1/fin/ottadd.php";
            </script>
        <?php
    }
?>
<?php
    $u_id = $_POST['u_id'];
    $u_pw = $_POST['u_pw'];
    $u_name = $_POST['u_name'];
    $u_pw_check = $_POST['u_pw_check'];

    
    $host = '175.195.88.135';
    $dbuser = 'root';
    $dbpw = 'leeyonghwan';
    $dbname = 'ottdb';

    if (!is_null($u_id)) {
        $conn = new mysqli($host, $dbuser, $dbpw, $dbname);
        $querys = "select * from members_t where strId = '".$u_id."';";
        $query_result = mysqli_query($conn, $querys);
        while($row = mysqli_fetch_array($query_result)){
            $q_id = $row['strId'];
        }
        if($u_id == $q_id){
            $double_id = 1;
        }
        elseif($u_pw != $u_pw_check){
            $wrong_pw = 1;
        }
        else{
            $e_pw = password_hash($u_pw, PASSWORD_DEFAULT);
            $query_add_user = "INSERT INTO members_t(strName, strId, strPw) VALUES ('".$u_name."','".$u_id."','".$e_pw."');";
            mysqli_query($conn, $query_add_user);
            header('Location: login.php');
        }
    }
?>
</body>
<!DOCTYPE html>
<html>
<head>
    <title>SubscriptionPlanner Sign Up</title>
    <link rel="stylesheet" href="style.css">  
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap"> 
</head>
<body>
    <body background="배경.jpg">
    <div class="signUp_main">
        <div class="signUp_title">
                <p>회원가입</p>
        </div>
        <form action="register.php" method="POST">
            <div class="signUp_name">
                <input type="text" name="u_name" placeholder="사용자 이름" onfocus="this.placeholder=''" onblur="this.placeholder='사용자 이름'"  required>
            </div>
            <div class="signUp_id">
                <input type="text" name="u_id" placeholder="사용자 ID" onfocus="this.placeholder=''" onblur="this.placeholder='사용자 ID'" required>
            </div>
            <div class="signUp_pw">
                <input type="password" name="u_pw" placeholder="비밀번호 "onfocus="this.placeholder=''" onblur="this.placeholder='비밀번호'" required>
            </div>
            <div class="signUp_pw_check">
                <input type="password" name="u_pw_check" placeholder="비밀번호 확인" onfocus="this.placeholder=''" onblur="this.placeholder='비밀번호 확인'" required>
            </div>
            <div class="signUp_checkIdpw">
                <?php
                    if ( $double_id == 1 ) {
                        echo "<p>사용자 ID가 중복되었습니다.</p>";
                    }
                    if ( $wrong_pw == 1 ) {
                        echo "<p>비밀번호가 일치하지 않습니다.</p>";
                    }
                ?>
            </div>
            <button class="signUp_button" type="summit">Sign Up</button>
        </form>
        <button class="OB_signIn" onclick="location.href='login.php' ">Sign In</button>
    </div>
</body>
</html>
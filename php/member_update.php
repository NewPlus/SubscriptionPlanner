<?php
    session_start();
    $u_id_origin = $_POST['u_id_origin'];
    $u_id = $_POST['u_id'];
    $u_name = $_POST['u_name'];
    $u_pw = $_POST['u_pw'];
    $u_pw_check = $_POST['u_pw_check'];

    $wrong_pw = 0;

    $host = '';
    $dbuser = '';
    $dbpw = '';
    $dbname = '';

    $conn = new mysqli($host, $dbuser, $dbpw, $dbname);
    if(!empty($u_id_origin)){
        $querys = "select * from members_t where strId = '".$u_id_origin."';";
    }
    else{
        $querys = "select * from members_t where strId = '".$u_id."';";
    }
    $query_result = mysqli_query($conn, $querys);
    while($row = mysqli_fetch_array($query_result)){
        $q_id = $row['strId'];
        $q_name = $row['strName'];
        $q_pw = $row['strPw'];
    }
    if (!empty($u_pw)) {
        if($u_pw == $u_pw_check){
            $e_pw = password_hash($u_pw, PASSWORD_DEFAULT);
            $query_add_user = "UPDATE members_t SET strName='".$u_name."', strId='".$u_id."', strPw='".$e_pw."' WHERE strId='".$u_id_origin."';";
            mysqli_query($conn, $query_add_user);
            $_SESSION['id'] = $u_id;
            $_SESSION['name'] = $u_name;
            header('Location: login_check.php');
        }
        else{
            $wrong_pw = 1;
        }
    }
?>
</body>
<!DOCTYPE html>
<html>
<head>
    <title>SubscriptionPlanner Sign Up</title>
    <link rel="stylesheet" href="style.css">  
</head>
<body>
    <div class="signUp_main">
        <section class="input_section">
            <div class="signUpTitle">
                <label>회원정보 변경</label>
            </div>
            <form action="member_update.php" method="POST">
                <input type="hidden" value="<?php echo $q_id ?>" name="u_id_origin">
                <div class="signUp_name">
                    <input type="text" name="u_name" value="<?php echo $q_name; ?>" placeholder="사용자 이름" onfocus="this.placeholder=''" onblur="this.placeholder='사용자 이름'"  required>
                </div>
                <div class="signUp_id">
                    <input type="text" name="u_id" value="<?php echo $q_id; ?>" placeholder="사용자 ID" onfocus="this.placeholder=''" onblur="this.placeholder='사용자 ID'" required>
                </div>
                <div class="signUp_pw">
                    <input type="password" name="u_pw" placeholder="비밀번호 변경"onfocus="this.placeholder=''" onblur="this.placeholder='비밀번호'" required>
                </div>
                <div class="signUp_pw_check">
                    <input type="password" name="u_pw_check" placeholder="비밀번호 변경 확인" onfocus="this.placeholder=''" onblur="this.placeholder='비밀번호 확인'" required>
                </div>
  
                <button class="signUp_button" type="summit">정보수정</button>
                <?php
                    if ( $wrong_pw == 1 ) {
                        echo "<p> 변경할 비밀번호가 일치하지 않습니다.</p>";
                    }
                ?>
            </form>
        </section>
        <section class="otherButtons_section">
            <button class="OB_signIn1" onclick="location.href='login_check.php' ">Main</button>
            <button class="OB_signUp0"><?php echo $q_id; ?>정보수정</button>
        </section>
    </div>
</body>
</html>
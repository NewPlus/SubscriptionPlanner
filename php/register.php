<?php
    $u_id = $_POST['u_id'];
    $u_pw = $_POST['u_pw'];
    $u_name = $_POST['u_name'];
    $u_pw_check = $_POST['u_pw_check'];

    
    $host = '';
    $dbuser = '';
    $dbpw = '';
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
<!DOCTYPE html>
<html>
<head>
    <title>SubscriptionPlanner Sign Up</title> 
</head>
<body>
<h1>회원 가입</h1>
    <form action="register.php" method="POST">
        <p><input type="text" name="u_id" placeholder="사용자 ID" required></p>
        <p><input type="text" name="u_name" placeholder="사용자 이름" required></p>
        <p><input type="password" name="u_pw" placeholder="비밀번호" required></p>
        <p><input type="password" name="u_pw_check" placeholder="비밀번호 확인" required></p>
        <p><input type="submit" value="회원 가입"></p>
        <?php
            if ( $double_id == 1 ) {
                echo "<p>사용자 ID가 중복되었습니다.</p>";
            }
            if ( $wrong_pw == 1 ) {
                echo "<p>비밀번호가 일치하지 않습니다.</p>";
            }
      ?>
    </form>
</body>
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
            header('Location: main.php');
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
    <link rel="stylesheet" href="update_style.css">  
</head>
<header>
    <div class="etcccc">
    <?php
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
    ?>

    <button class = "header_buttons" type="summit" onclick="location.href='logout.php'"> ๋ก๊ทธ์์ </button>
    <form action="member_update.php" method="POST">
                    <input type="hidden" value="<?php echo $u_id ?>" name="u_id">
                    <button class="header_buttons" type="summit">์?๋ณด ์์?</button>
    </form>
    <label><?php echo $u_name; ?>๋ ํ์ํฉ๋๋ค.</label>
    </div>
    <div class="main_logo">
    <a href="main.php"><img src="img/title1.png"></a>
    </div>
  </header>
<body>
    <div class="update_main">
            <div class="updateTitle">
                <label><?php echo $q_name; ?>๋์ ํ์์?๋ณด ์์?</label>
            </div>
            <div class="update_input">
            <form action="member_update.php" method="POST">
                <input type="hidden" value="<?php echo $q_id ?>" name="u_id_origin">
                <div class = "input_label">
                <label> ์ฌ์ฉ์ ์ด๋ฆ </label>
                </div>
                <p></p>
                <div class="update_name">
                    <input type="text" name="u_name" value="<?php echo $q_name; ?>" placeholder="์ฌ์ฉ์ ์ด๋ฆ" onfocus="this.placeholder=''" onblur="this.placeholder='์ฌ์ฉ์ ์ด๋ฆ'"  required>
                </div>
                <div class = "input_label">
                <label> ์ฌ์ฉ์ ID </label>
                </div>
                <p></p>
                <div class="update_id">
                    <input type="text" name="u_id" value="<?php echo $q_id; ?>" placeholder="์ฌ์ฉ์ ID" onfocus="this.placeholder=''" onblur="this.placeholder='์ฌ์ฉ์ ID'" required>
                </div>
                <div class = "input_label">
                <label> ๋น๋ฐ๋ฒํธ ๋ณ๊ฒฝ </label>
                </div>
                <p></p>
                <div class="update_pw">
                    <input type="password" name="u_pw" placeholder="๋น๋ฐ๋ฒํธ"onfocus="this.placeholder=''" onblur="this.placeholder='๋น๋ฐ๋ฒํธ'" required>
                </div>
                <div class = "input_label">
                <label> ๋น๋ฐ๋ฒํธ ๋ณ๊ฒฝ ํ์ธ </label>
                </div>
                <p></p>
                <div class="update_pw_check">
                    <input type="password" name="u_pw_check" placeholder="๋น๋ฐ๋ฒํธ ํ์ธ" onfocus="this.placeholder=''" onblur="this.placeholder='๋น๋ฐ๋ฒํธ ํ์ธ'" required>
                </div>
  
                <button class="update_button" type="summit">์งํ</button>
                <?php
                    if ( $wrong_pw == 1 ) {
                        echo "<p> ๋ณ๊ฒฝํ? ๋น๋ฐ๋ฒํธ๊ฐ ์ผ์นํ์ง ์์ต๋๋ค.</p>";
                    }
                ?>
            </form>
        </div>
    </div>
    <footer>
    <div class = "copyright">
        <h4>COPYRIGHT IT์?๋ณด๊ณตํ๊ณผ ์ฐฝ์์?๊ณตํ์ค๊ณ 11์กฐ</h4>
    </div>
</footer>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>SubscriptionPlanner Sign In</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
     <?php
          $u_id = $_POST['u_id'];
          $u_pw = $_POST['u_pw'];
          if (!is_null($u_id)) {
               $host = '';
               $dbuser = '';
               $dbpw = '';
               $dbname = 'ottdb';

               $conn = new mysqli($host, $dbuser, $dbpw, $dbname);
               $querys = "select * from members_t where strId = '".$u_id."';";

               $query_result = mysqli_query($conn, $querys);
               while($row = mysqli_fetch_array($query_result)){
                    $q_pw = $row['strPw'];
               }

               if(is_null($q_pw)){
                    $empty_u = 1;
               }
               else{
                    if(password_verify($u_pw, $q_pw)){
                         header('Location: login_check.php');
                    }
                    else{
                         $wrong_pw = 1;
                    }
               }
          }
     ?>
     <div class="signIn_main">
          <section class="input_section">
               <div class="logo_art">
                    <img src="title.png">
               </div>
               <form action="login.php" method="POST">
               <div class="signIn_id">
                  <input type = "text" name = "u_id" placeholder="ID" onfocus="this.placeholder=''" onblur="this.placeholder='ID'" ><br>
               </div>
               <div class="signIn_pw">
                  <input type = "password" name = "u_pw" placeholder="Password" onfocus="this.placeholder=''" onblur="this.placeholder='Password'"><br>
               </div>
               <div class="rememberMe_checkbox">
                    <?php
                         if($empty_u == 1){
                              echo "<p>사용자 ID가 존재하지 않습니다.</p>";
                         }
                         if($wrong_pw == 1){
                              echo "<p>비밀번호가 틀렸습니다.</p>";
                         }
                    ?>
               </div>
               <button class="signIn_button" type="summit">로그인</button>
               </form>
          </section> 
          <section class="other_buttons">
             <button class="OB_signIn0">Sign In</button>
             <button class="OB_signUp1" onclick="location.href='register.php' ">Sign up</button>
          </div>
     </div>
</body>
</html>
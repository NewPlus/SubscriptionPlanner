<?php
    $host = '';
    $dbuser = '';
    $dbpw = '';
    $dbname = '';

    $conn = new mysqli($host, $dbuser, $dbpw, $dbname);
?>
<!DOCTYPE html>


  <!-- Session & UserId & Logout -->
  <html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div align="center">
            <div>
                <?php
                    session_start();
                    if(empty($_SESSION['id'])) {
                        header('Location: login.php');
                    }
                    else {
                        $u_id = $_SESSION['id'];
                        $u_name = $_SESSION['name'];
                    } 
                ?>
                
                <form action="member_update.php" method="POST">
                    <input type="hidden" value="<?php echo $u_id ?>" name="u_id">
                    <button class="signUp_button" type="summit"><?php echo $u_id; ?></button>
                </form>

                <input type="button" value="Logout" onclick="location.href='logout.php'">
        </div>
    </body>
    
    <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        SubscriptionPlanner
    </title>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
</html>
  <!-- Session & UserId & Logout end -->

  <!-- Image Swipe -->
  <div>
    <h4>당신이 구독한 상품들</h4>
</div>
<div class="swiper">
<div class="swiper-wrapper">
    <?php
        $q_img = "select strOttImg, strOttName from ottList_t where strId = '".$u_id."';";
        $r_img = mysqli_query($conn, $q_img);
        while($row = mysqli_fetch_array($r_img)){
            $ottNames = $row['strOttName'];
    ?>
    <script>
        function showPopup(ottNames) { window.open("seemore.php?id=<?php echo $_SESSION['id']?>&ottname="+ottNames, "더보기", "width=400, height=300, left=100, top=50"); }
    </script>
                <div class="swiper-slide">
                    <a href = "#">
                        <div class = "text-wrap">
                        </div>
                        <img src="<?php echo $row['strOttImg'] ?>" onclick = "showPopup('<?php echo $ottNames ?>');" height="300" width="300">
                    </a>
                </div>
    <?php
        }
    ?>
    
      ...
    </div>
    <div class="swiper-pagination"></div>

    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <div class="swiper-scrollbar"></div>
  </div>

  <script src="js/main_upper.js"></script>
  <!-- Image Swipe end -->

  <!-- Calendar -->
<html>
<script src = "js/calendar.js"></script>
<link rel="stylesheet" href="calendar_style.css">
<body onload="showCalendar();">

	<table align="center" id="calendar">
<thead>
		<tr>
			<th colspan="1"> </th>
			<th>
                          <button id="before" onclick="location.href='javascript:beforeMonth()' ">◀</button>
			</th>
			<th colspan="3" align="center">
			<div id="yearmonth"></div>
			</th>
			<th>
                          <button id="next" onclick="location.href='javascript:nextMonth()' ">▶</button>
			</th>
			<th colspan="1"> </th>
		</tr>
</thead>
		<tr>
			<th class="sun" align="center" width="14.3%"> 일 </th>
			<th align="center" width="14.3%"> 월 </th>
			<th align="center" width="14.3%"> 화 </th>
			<th align="center" width="14.2%"> 수 </th>
			<th align="center" width="14.3%"> 목 </th>
			<th align="center" width="14.3%"> 금 </th>
			<th class="satur" align="center" width="14.3%"> 토 </th>
		</tr>

	</table>
</body>
    <!-- Calendar end -->
    
    <!-- main_under -->
        <!-- 추천 알고리즘 -->
        <?php
            $q_maxOttName = "select strOttName from ottList_t group by strOttName having count(*)=(select max(OttCount) from (select strOttName, count(*) as OttCount from ottList_t group by strOttName) as result);";
            $r_maxOttName = mysqli_query($conn, $q_maxOttName);
            while($row = mysqli_fetch_array($r_maxOttName)){
                $maxOttName = $row['strOttName'];
            }

            $q_a_maxOttCount = "select count(*) from ottList_t where strOttName='".$maxOttName."';";
            $r_a_maxOttCount = mysqli_query($conn, $q_a_maxOttCount);
            while($row = mysqli_fetch_array($r_a_maxOttCount)){
                $a_maxOttCount = $row['count(*)'];
            }

            $q_b_allCount = "select intNumber from ottList_t order by intNumber desc limit 1;";
            $r_b_allCount = mysqli_query($conn, $q_b_allCount);
            while($row = mysqli_fetch_array($r_b_allCount)){
                $b_allCount = $row['intNumber'];
            }

            $q_src = "select strSrc from ottList_t where strOttName = '".$maxOttName."' limit 1;";
            $r_src = mysqli_query($conn, $q_src);
            while($row = mysqli_fetch_array($r_src)){
                $src = $row['strSrc'];
            }

            $q_userOtt = "select strOttName from ottList_t where strId = '".$u_id."';";
            $userOtt = mysqli_query($conn, $q_userOtt);

            $cnt = 0;
            $flag = 0;
            while($userOttList = mysqli_fetch_array($userOtt)){
                $cnt = $cnt + 1;
                if($maxOttName == $userOttList['strOttName']){
                    $flag = 1;
                    break;
                }
            }
            
        ?>
    <div align="center">
        <?php
            if($flag == 0){
                echo "<h4> ".$u_name."님! 전체의 ".($a_maxOttCount/$b_allCount*100)."%가 선택한 '".$maxOttName."'을 추천합니다!</h4><br>";
                echo "<a href=".$src." target='_blank'>더 보기</a> ";
            }
        ?>
    </div>

    <div>
    
    <h4>YouTube Premium / 월 8,900원/ 매월 15일 / 오늘 납부</h4>
    <h4>Netflix / 월 9,500원 / 매월 15일 / 오늘 납부</h4>
    <h4>Diseny+ / 9,900원 / 매월 17일 / 2일 후 납부</h4>
    <h4>Microsoft Office / 연 119,000원 / 매년 8월 19일 / 4일 후 납부</h4>
    <p><a href=  >+</a></p>
    
    <!-- main_under end -->
</html>
        
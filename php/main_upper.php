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
<script>

var today = new Date();         
var date = new Date();
  
  //이전 달
  function beforeMonth() { 
      today = new Date(today.getFullYear(), today.getMonth() - 1, today.getDate());
      showCalendar(); 
  }
  
  //다음 달
  function nextMonth() {
      today = new Date(today.getFullYear(), today.getMonth() + 1, today.getDate());
      showCalendar();
  }
  
  //이번 달
  function thisMonth(){
      today = new Date();
      showCalendar();
  }

  function showCalendar()
  {
      var nMonth = new Date(today.getFullYear(), today.getMonth(), 1);
      var lastDate = new Date(today.getFullYear(), today.getMonth() + 1, 0); 
      var tbcal = document.getElementById("calendar"); 
      var yearmonth = document.getElementById("yearmonth"); 
      yearmonth.innerHTML = today.getFullYear() + "년 "+ (today.getMonth() + 1) + "월"; 


      while (tbcal.rows.length > 2) {
          tbcal.deleteRow(tbcal.rows.length - 1);
      }
      var row = 0;

      row = tbcal.insertRow();

      var cnt = 0;
      if(nMonth.getDay()==0){
          var dayCheck = 7;
      }else{
          var dayCheck = nMonth.getDay();
      }
      
      for (i = 0; i < nMonth.getDay(); i++) {
          cnt = cnt + 1;	
          cell = row.insertCell();
      }


      // 달력 생성
      for (i = 1; i <= lastDate.getDate(); i++)
      { 
          cell = row.insertCell();
          
          var str="";
          
          str += "<div>"+i+"</div>";
          if(i<10){
              var day = "0"+i; 
          }else{
              var day = i;
          }              	
          str += "<div id='"+day+"'></div>";
          cell.innerHTML = str;
          
          cnt = cnt + 1;

          if (cnt % 7 == 0) { //주말
              var str="";
              str += "<div>"+i+"</div>";
              if(i<10){
                  var day = "0"+i; 
              }else{
                  var day = i;
              }                	
              str += "<div id='"+day+"'>"+"</div>";
              cell.innerHTML = "<font color = #3737FF>" + str;
              row = calendar.insertRow();
          }
          if (cnt % 7 == 1) { //주말
              var str="";
              str += "<div>"+i+"</div>";
              if(i<10){
                  var day = "0"+i; 
              }else{
                  var day = i;
              }       	
              str += "<div id='"+day+"'>"+"</div>";
              cell.innerHTML = "<font color = #FF3737>" + str;                
          }
          
          if(today.getFullYear()==date.getFullYear()&&today.getMonth()==date.getMonth()&&i==date.getDate()) 
          {
              cell.innerHTML = "<div><font color = #AFAF7F>" + "<font size = 5px>" + str + "</div>";
          }
      }
      <?php
          $q_img = "select intOttDate, strOttName from ottList_t where strId = '".$u_id."';";
          $r_img = mysqli_query($conn, $q_img);

          $dateMonth = 0;
          $dateDay = 0;
          while($row = mysqli_fetch_array($r_img)){
              $ottDate = $row['intOttDate'];
              if($ottDate > 100){
                  $dateMonth = $ottDate / 100;
                  $dateDay = $ottDate % 100;
              }
              if($ottDate < 10){
                  $ottDate_10 = "0" + strval($ottDate);
              }
              $ottNames = $row['strOttName'];
              if($ottDate < 100){
      ?>
      var tdId = "<?php
          if($ottDate < 10){
              echo "0{$ottDate}";
          }
          else{
              echo $ottDate;
          }
      ?>"; 
      var str = "<?php echo $ottNames ?>";
      <?php
              }
              else{
      ?>
      var tdId = "<?php echo $ottDate ?>"; 
      var str = "<?php echo $ottNames ?>";
      <?php
              }
          ?>
          document.getElementById(tdId).innerHTML = str;
          <?php
          }
      ?>
  }



</script>
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
  <?php
      $q_img = "select intOttPay, intOttDate, strOttName from ottList_t where strId = '".$u_id."';";
      $r_img = mysqli_query($conn, $q_img);
      
      $dateMonth = 0;
      $dateDay = 0;
      while($row = mysqli_fetch_array($r_img)){
          $ottPay = $row['intOttPay'];
          $ottDate = $row['intOttDate'];
          if($ottDate > 100){
              $dateMonth = $ottDate / 100;
              $dateDay = $ottDate % 100;
          }
          $ottNames = $row['strOttName'];
          if($ottDate < 100){
  ?>
  <h4><?php echo $ottNames ?> / 월 <?php echo $ottPay ?>원/ 매월 <?php echo $ottDate ?>일 납부</h4>
  <?php
          }
          else{
  ?>
  <h4><?php echo $ottNames ?> / 연 <?php echo $ottPay ?>원/ <?php echo $dateMonth ?>월 <?php echo $ottDate ?>일 납부</h4>
  <?php
          }
      }
  ?>
  
  <p><a href=  >+</a></p>
  
  <!-- main_under end -->
</html>
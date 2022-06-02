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
    $strOttName = $_GET['ottname'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>구독 서비스 수정하기</title> 
    <link rel="stylesheet" href="popup_style.css">
</head>
<body>

    <script>
        function jsChselect(value){
            if(value=="기타"){
                document.getElementById("tbOthers").style.display = "block";
            }
            else{
                document.getElementById("tbOthers").style.display = "none";
            }
        }

        var arr_days = 0;
        function jsChselect_month(value){
            if(value == "2"){
                arr_days = 29;
                document.getElementById("selectDays").style.display = "block";
            }
            else if(value == "1" || value == "3" || value == "5" || value == "7" || value == "8" || value == "10" || value == "12"){
                arr_days = 31;
                document.getElementById("selectDays").style.display = "block";
            }
            else{
                arr_days = 30;
                document.getElementById("selectDays").style.display = "block";
            }

            var target = document.getElementById("selectDays");
            for(var i=1; i<=arr_days; i++){
                var opt = document.createElement("option");
                opt.value = i;
                opt.innerHTML = i;
                target.appendChild(opt);
            }
        }
    </script>

    <div class = "popup_main" align="center">
        <form action="ottmodify_check.php" method="POST">
        <div class = "sub_name">    
            <label><?php echo $strOttName ?></label>
            <input type="hidden" name="strOttNames" value="<?php echo $strOttName ?>" />
        </div>
        <div class = "sub_mory">
            <label>결제 기간 종류</label>
            <select name="intOttDate">
                <option value="0">월</option>
                <option value="1">년</option>
            </select>
        </div>
        <div class = "sub_pay">
            <label>결제금액</label>
            <input type="text" name="tbPays" id="tbPays" value="" placeholder="금액입력" />
        </div>    
        <div class = "sub_start">
            <label> 결제 시작일 </label>
          <p></p>
            <select name="selectMonth" id="selectMonth" onchange="jsChselect_month(this.value);">
                <option value="0">월 선택</option>
                <option value="1">1</option>       
                <option value="2">2</option> 
                <option value="3">3</option> 
                <option value="4">4</option> 
                <option value="5">5</option> 
                <option value="6">6</option> 
                <option value="7">7</option> 
                <option value="8">8</option> 
                <option value="9">9</option> 
                <option value="10">10</option> 
                <option value="11">11</option> 
                <option value="12">12</option> 
            </select>
            <h4> 월 </h4>
            <select name="selectDays" id="selectDays">
            <option value="0">일 선택</option>
            </select>
            <h4> 일 </h4>
        </div>
            <button class = "subplus_button" type="summit"> 수정 </button>
        </form>
    </div>
</body>
</html>
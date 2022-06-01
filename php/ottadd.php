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

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>구독 프로그램 추가화면</title> 
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

    <div align="center">
        <form action="ottadd_check.php" method="POST">
        <div>    
            <label>구독 프로그램 이름</label>
            <select name="strOttNames" id="strOttNames" value="Youtube Premium" onchange="jsChselect(this.value);">
                <option value="Youtube Premium">Youtube Premium</option>       
                <option value="Netflix">Netflix</option> 
                <option value="Disney Plus">Disney+</option> 
                <option value="Apple tv Plus">Apple tv+</option> 
                <option value="Tving">Tving</option> 
                <option value="Watcha">Watcha</option> 
                <option value="Wavve">Wavve</option> 
                <option value="Coupang play">Coupang play</option> 
                <option value="Ms office 365">Ms office 365</option> 
                <option value="기타">기타</option> 
            </select>
            <input type="text" name="tbOthers" id="tbOthers" value="" style="display:none" placeholder="기타 (직접입력)" /> 
        </div>
        <div>
            <label>결제 기간 종류</label>
            <select name="intOttDate">
                <option value="0">월</option>
                <option value="1">년</option>
            </select>
        </div>
        <div>
            <label>결제금액</label>
            <input type="text" name="tbPays" id="tbPays" value="" placeholder="금액입력" />
        </div>    
        <div>
            <label> 결제 시작일 </label>
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
            </select> 월 
            <select name="selectDays" id="selectDays" style="display:none">
                            
            </select>
        </div>
        <div>
            <button type="summit"> 완료 </button>
        </div>
        </form>
    </div>
</body>
</html>
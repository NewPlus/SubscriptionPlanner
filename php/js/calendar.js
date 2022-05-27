var today = new Date();         
var date = new Date();
	
	//이전달
	function beforeMonth() { 
		today = new Date(today.getFullYear(), today.getMonth() - 1, today.getDate());
		showCalendar(); 
	}
	
	//다음달
	function nextMonth() {
		today = new Date(today.getFullYear(), today.getMonth() + 1, today.getDate());
		showCalendar();
	}
	
	//오늘선택
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

		if(today.getMonth()+1==12) {
			before.innerHTML="<";
			next.innerHTML=">";
		}
		else if(today.getMonth()+1==1) {
			before.innerHTML="<";
			next.innerHTML=">";
		}
		else {
			before.innerHTML="<";
			next.innerHTML=">";
		}


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
		for (i = 0; i < (dayCheck-1); i++) {
			cnt = cnt + 1;	
			cell = row.insertCell();
		}


		// 달력 출력
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
			if (cnt % 7 == 6) { //토요일
				var str="";
				str += "<div>"+i+"</div>";
                if(i<10){
                    var day = "0"+i; 
                }else{
                    var day = i;
                }       	
				str += "<div id='"+day+"'>"+"</div>";
				cell.innerHTML = str;                
			}
			if (cnt % 7 == 0) { //일요일
				var str="";
				str += "<div>"+i+"</div>";
                if(i<10){
                    var day = "0"+i; 
                }else{
                    var day = i;
                }                	
				str += "<div id='"+day+"'>"+"</div>";
				cell.innerHTML = str;
				row = calendar.insertRow();
			}
			
			
			  
		}
		
		var tdId = "22"; 
		var str = "";
		str += "넷플릭스  ";
		str += "왓차 ";
		document.getElementById(tdId).innerHTML = str;
	}


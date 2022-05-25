var today = new Date();         
var date = new Date();
	
	//������
	function beforeMonth() { 
		today = new Date(today.getFullYear(), today.getMonth() - 1, today.getDate());
		showCalendar(); 
	}
	
	//������
	function nextMonth() {
		today = new Date(today.getFullYear(), today.getMonth() + 1, today.getDate());
		showCalendar();
	}
	
	//���ü���
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
		yearmonth.innerHTML = today.getFullYear() + "�� "+ (today.getMonth() + 1) + "��"; 


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


		// �޷� ���
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

			if (cnt % 7 == 0) { //�����
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
			if (cnt % 7 == 1) { //�Ͽ���
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
				cell.innerHTML = "<font color = #AFAF7F>" + "<font size = 5px>" + str;
            }
		}
		
		var tdId = "22"; 
		var str = "";
		str += "���ø���  ";
		str += "���� ";
		document.getElementById(tdId).innerHTML = str;
	}


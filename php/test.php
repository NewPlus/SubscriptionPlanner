<?php
  error_reporting( E_ALL );
  ini_set( "display_errors", 1 );
?>
<?php
$host = '';
$dbuser = '';
$dbpw = '';
$dbname = '';

$conn = new mysqli($host, $dbuser, $dbpw, $dbname);

$u_id = 'aa';
$u_pw = 'aa';

$querys = "select * from members_t where strId = '".$u_id."';";
$query_result = mysqli_query($conn, $querys);
while($row = mysqli_fetch_array($query_result)){    
    print_r($row['strPw']);
    $q_pw = $row['strPw'];
}
if(password_verify($u_pw,$q_pw)){
    print_r('YES');
}
else{
    print_r('NO!');
}
?>
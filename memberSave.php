<?php
 $host = 'localhost';
 $user = 'root';
 $pw = 'root';
 $dbName = 'signup';
 $mysqli= new mysqli($host, $user, $pw, $dbName);

 $id=$_POST['id'];
 $password=md5($_POST['pw']); /*md5(): 암호화함수*/
 $passwordCheck=$_POST['pwCheck'];
 $name=$_POST['username'];
 $birthday=$_POST['birthday'];
 $tel=$_POST['usertel'];
 $address=$_POST['useraddr'];

 mysqli_set_charset($mysqli,"utf8"); /*한글설정*/


 $sql = "insert into member (id, pw, username, birthday, usertel, useraddr)";
 $sql = $sql. "values('$id','$password','$name','$birthday','$tel','$address')";
 if($mysqli->query($sql))
 {
  echo "<script language=javascript>
    alert('등록성공!');
    location.href='dbmain.html';
    </script>";
 }
 else{
  echo '등록실패!';
 }
?>

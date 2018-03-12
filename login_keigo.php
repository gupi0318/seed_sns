<?php 
  session_start();
  require('dbconnect.php');

  if(!empty($_POST)){
  	$sql = 'SELECT * FROM `members` WHERE `email`=? AND `password`=?';
  	$data= array($_POST['email'],sha1($_POST['password']));
  	$stmt = $dbh->prepare($sql);
  	$stmt->execute($data);

  	$member = $stmt->fetch(PDO::FETCH_ASSOC);
  }




   ?>

   <!DOCTYPE html>
   <html lang="ja">
   <head>
   	<meta charset="UTF-8">
   	<title>Document</title>
   </head>
   <body>
   	<form action="">
   		<label for="emaill">メールアドレス：</label>
   		<p>keigoooooooooo</p>
   		<input type="email" name="email" id=emaill>
   	</form>
   </body>
   </html>
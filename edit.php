<?php 

 session_start();
 require('dbconnect.php');

  $sql = 'SELECT * FROM `tweets` WHERE `id`=?';
 $data = array($_SESSION['id']);
 $stmt = $dbh->prepare($sql);
 $stmt->execute($data);
 $edit = $stmt->fetch(PDO::FETCH_ASSOC);



 ?>
 <!DOCTYPE html>
 <html lang="ja">
 <head>
 	<meta charset="UTF-8">
 	<title>Document</title>
 </head>
 <body>


 	<?php foreach($edit as $key=>$edit){
	  echo $key.' : '.$edit.'<br>';
    }?>
 	<form method = 'GET' action="index.php">
    	<br>
        <p>Nickname</p>
        <input type="text" name='renew_nickname'>
        <p>Comment</p>

    	<textarea name="renew_comment" id="" cols="30" rows="10"></textarea>
    	<input type="submit" value="更新する">
    </form>
 </body>
 </html>
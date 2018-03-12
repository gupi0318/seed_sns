<?php

    session_start();
    require('../dbconnect.php');

    if(!empty($_POST)){
    	$nickname= $_SESSION['joint']['nickname'];
    	$email= $_SESSION['joint']['email'];
    	$password= $_SESSION['joint']['password'];
    	$picture_path= $_SESSION['joint']['picture_path'];
    

    $sql = 'INSERT INTO `members` SET `nick_name`=?,`email`=?,password=?,`picture_path=?`';
    $data=array($nickname,$email,$password,$picture_path);
    $stmt = $dbh->prepare($sql);
      $stmt->execute($data);
       unset($_SESSION);

      header('Location: thanks_keigo.php');
      exit;
    }
?>

   <!DOCTYPE html>
   <html lang="ja">
   <head>
   	<meta charset="UTF-8">
   	<title>Document</title>
   </head>
   <body>

   	<h3>登録内容を確認してね</h3>
   	<br>
   	<br>
   	<p>ニックネーム</p>
   	<p><?php echo $_SESSION['joint']['nickname']; ?></p>
   	<p>メールアドレス</p>
   	<p><?php echo $_SESSION['joint']['email']; ?>/</p>
   	<p>パスワード</p>
   	<p><?php echo $_SESSION['joint']['password']; ?></p>
   	<p>プロフィール写真</p>
   	<img src="../picture_path/<?php echo $_SESSION['joint']['picture_path']; ?>" alt="" width="240" height="160">
   	<br>
   	<a href="keigo.php">&laquo;&nbsp;前のページの戻り、入力する</a>
   	<br>
   	<input type="submit" value="会員登録">

   </body>
   </html>
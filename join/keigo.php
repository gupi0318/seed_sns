<?php
  session_start();
  require('../dbconnect.php');

  echo '<br>';
  echo '<br>';
  var_dump($_POST);



  if(!empty($_POST)){
  	if(empty($_POST['nickname'])){
  		$error['nickname']='blank';
  	}
  	if(empty($_POST['email'])){
      $error['email'] = 'blank';
    }
    if(empty($_POST['password'])) {
      $error['password'] = 'blank';
    }elseif(strlen($_POST['password'])<4){
    	$error['password']='length';
    }

    $ext= substr($_FILES['picture_path']['name'],-3);
    if($ext=='jpg' || $ext == 'png' || $ext == 'gif'){
      $picture_path = date('YmdHis'). $_FILES['picture_path']['name'];

     move_uploaded_file($_FILES['picture_path']['tmp_name'],'../picture_path/'.$picture_path);

     // move_uploaded_file(ファイルの指定,保存先〜ファイル名も指定)
     $_SESSION['joint']= $_POST;
     $_SESSION['joint']['picture_path']= $picture_path;
      }else{$error['image']='type';
     }






    $sql='SELECT COUNT(*) AS `mail_count` FROM `members` WHERE `email`=?';
    $data=array($_POST['email']);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    if($count['mail_count']>=1){
    	$error['email']='duplicated';
    }

    $sql='SELECT COUNT(*) AS `nickcount` FROM `members` WHERE `nick_name`=?';
    $data=array($_POST['nickname']);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $nickcount = $stmt->fetch(PDO::FETCH_ASSOC);
    if($nickcount['nickcount']>=1){
    	$error['nickname']='duplicated';
    }
   if(!isset($error)){
    header('Location: check_keigo.php');
         exit();
   }



  }

  




 ?>


 <!DOCTYPE html>
 <html lang="ja">
 <head>
 	<meta charset="UTF-8">
 	<title>会員登録ページ</title>
 </head>
 <body>
 	<h1>会員登録</h1>

 	<form action="" method="post" enctype="multipart/form-data">
 		<p>ニックネーム</p>

 		<?php if((isset($error['nickname']))&& $error['nickname']=='duplicated') {?>
 		      <p>ニックネームが使われてるよ</p>
 		  <?php } ?>

 		<?php if((isset($error['nickname'])) && $error['nickname']=='blank'){ ?> 
 		<p>ニックネーム入力されていないよ</p>
 		<?php } ?>
 		<input type="text" name="nickname">


 		<p>メールアドレス</p>

 		<?php if((isset($error['email']))&& $error['email']=='duplicated') {?>
 		      <p>そのメールアドレスもう使われてるよ</p>
 		  <?php } ?>

 		<?php if((isset($error['email']))&& $error['email']=='blank'){?>
 		<p>メールアドレスが入力されていないよ</p>
 		 <?php } ?>
 		<input type="email" name="email">


 		<p>パスワード</p>

 		<?php  if((isset($error['password']))&&$error['password']=='blank'){?>
 		         <p>パスワードが入力されていないよ</p>
 		 <?php }elseif((isset($error['password']))&&$error['password'] == 'length'){ ?>
 		         <p>４文字以上で入力せよ。</p>
 		 <?php } ?>
 		 <input type="password" name="password">
 		<p>プロフィール写真</p>
 		<input type="file" name="picture_path">
 		<p>確認画面へ</p>
 		<input type="submit" value="確認画面へ">
 	</form>
 </body>
 </html>
<?php
mb_internal_encoding("UTF-8");

//DB接続
$pdo = new PDO("mysql:dbname=abcde;host=localhost;", "root", "root");

//prepared statementでSQL文の型を作る
$stmt = $pdo->prepare("insert into login_mypage( name,mail,password,picture,comments)value(?,?,?,?,?)");

//bindValueを使用し、実際に各カラムに何をinsertするかを記述
$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['picture']);
$stmt->bindValue(5,$_POST['comments']);

//executeえクエリを実行
$stmt->execute();
$pdo = NULL;

header('Location:after_register.html');
?>









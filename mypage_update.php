

<?php
mb_internal_encoding("UTF-8");
session_start();

try{
//try catch文。DBに接続できなければエラーメッセージを表示
$pdo = new PDO("mysql:dbname=abcde;host=localhost;", "root", "root");
}catch(PDOException $e){
  die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスできません。<br>しばらくしてから再度ログインをしてください。</p>
  <a href='//localhost/login_mypage/login.php'>ログイン画面へ</a>");
}


echo $_SESSION['id'];
echo $_POST['hensyu_password'];
echo $_POST['hensyu_comments'];



//prepared statementでSQL文の型を作る
$stmt = $pdo->prepare("update login_mypage set name = ?, mail = ?, password = ?, comments = ? where id = ?");

// //bindValueメソッドでパラメータをセット
$stmt->bindValue(1,$_POST['hensyu_name']);
$stmt->bindValue(2,$_POST['hensyu_mail']);
$stmt->bindValue(3,$_POST['hensyu_password']);
$stmt->bindValue(4,$_POST['hensyu_comments']);
$stmt->bindValue(5,$_SESSION['id']);


//executeでクエリを実行
$stmt->execute();

//fetch・while文でデータ取得し、sessionに代入
$stmt = $pdo->prepare("select * from login_mypage WHERE id = ?");

$stmt->bindValue(1,$_SESSION['id']);

//executeでクエリを実行
$stmt->execute();

//データベースを切断
$pdo = NULL;


//fetch・while文でデータ取得し、sessionに代入
while ($row=$stmt->fetch()){
  $_SESSION['id']=$row["id"];
  $_SESSION['name']=$row["name"];
  $_SESSION['mail']=$row["mail"];
  $_SESSION['picture']=$row["picture"];
  $_SESSION['password']=$row["password"];
  $_SESSION['comments']=$row["comments"];
}

//mypage.phpへリダイレクト
header('Location:mypage.php');
?>












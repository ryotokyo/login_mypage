

<?php
mb_internal_encoding("UTF-8");
session_start();

if(empty($_SESSION['id'])){

  try{
    //try catch文。DBに接続できなければエラーメッセージを表示
    $pdo = new PDO("mysql:dbname=abcde;host=localhost;", "root", "root");
  }catch(PDOException $e){
    die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスできません。<br>しばらくしてから再度ログインをしてください。</p>
    <a href='//localhost/login_mypage/login.php'>ログイン画面へ</a>");
  }

  //prepared statmentでSQL文の型を作る(DBとpostデータを照合させる。)
  $stmt = $pdo->prepare("select * from login_mypage where mail = ? && password = ?");

  //bindValueメソッドでパラメータをセット
  $stmt->bindValue(1,$_POST["login_mail"]);
  $stmt->bindValue(2,$_POST["login_password"]);

  //executeでクエリを実行
  $stmt->execute();

  //データベースを切断
  $pdo = NULL;

  //fetch・while文でデータ取得し、sessionに代入
  while ($row=$stmt->fetch()){
    // echo $row["mail"];
    // echo $row["password"];
    $_SESSION['id']=$row["id"];
    $_SESSION['name']=$row["name"];
    $_SESSION['mail']=$row["mail"];
    $_SESSION['picture']=$row["picture"];
    $_SESSION['password']=$row["password"];
    $_SESSION['comments']=$row["comments"];


  }

  //データが取得できずにsessionがなければ、リダイレクト
  if(empty($_SESSION['name'])){
    header('Location: login_error.php');
    exit;
  }

}

setcookie(mail,$_SESSION["mail"],time()+60*60*24*7,"/");
setcookie(password,$_SESSION["password"],time()+60*60*24*7,"/");
?>


<!DOCTYPE html>
<html lang=“ja”>

<head>
  <meta charset="UTF-8">
  <title>マイページ</title>
  <link rel="stylesheet" type="text/css" href="mypage.css">
</head>

<body>
  <!-- フォーム欄 -->
  <header>
    <img src="4eachblog_logo.jpg">
    <div class="logout"><a href="log_out.php">ログアウト</a></div>
  </header>

  <main>
    <div class="contents">
      <h2>会員情報</h2>
      <div class="aisatsu">
        <p>こんにちは！ <?php echo $_SESSION['name']?>さん</p>
      </div>

      <div class="gazou">
        <img src="<?php echo $_SESSION['picture']?>">
      </div>

      <div class="profile">
        <p>氏名： <?php echo $_SESSION['name']?></p>
        <p>メール： <?php echo $_SESSION['mail']?></p>
        <p>パスワード： <?php echo $_SESSION['password']?></p>
      </div>

      <div class="comments">
        <?php echo $_SESSION['comments']?>
      </div>

      <form action="mypage_hensyu.php" method="post" class="form_center">
        <input type="hidden" value="<?php echo rand(1,10);?>" name="from_mypage">
        <div class="henshu">
          <input type="submit" class="button1" value="編集する">
        </form>
      </div>

    </div>
  </main>
  <!-- フッター -->
  <footer>
    © 2018 InterNous.inc. All right reserved
  </footer>

</body>
</html>






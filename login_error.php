
<?php

session_start();
if(isset($_SESSION['id'])){
  header("Location:mypage.php");
}
?>


<!DOCTYPE html>
<html lang=“ja”>

<head>
  <meta charset="UTF-8">
  <title>ログイン</title>
  <link rel="stylesheet" type="text/css" href="login_error.css">
</head>

<body>
  <!-- フォーム欄 -->
<header>
  <img src="4eachblog_logo.jpg">
  <div class="login"><a href="login.php">ログイン</a></div>
</header>

<main>
  <form action="mypage.php" method="post">
    <div class="error_message">
      <p>メールまたはパスワードが間違っています。</p>
    </div>
    <div class="login_form">
      <label>メールアドレス</label><br>
      <div class="login_mail">
          <input type="text" class="formbox" size="90" name="login_mail"
          pattern="^[a-z0-9._%+-]+@[a-z0-9._]+\.[a-z]{2,3}$" value= "<?php echo $_COOKIE['mail']; ?>" required>
      </div>
      <label>パスワード</label><br>
      <div class="login_password">
          <input type="password" class="formbox" size="90" name="login_password" value="<?php echo $_COOKIE['password']; ?>" required>
      </div>
      <div class="submit_button">
        <input type="submit" class="login_button" size=35 value="ログイン">
      </div>
    </div>
  </form>
</main>
<!-- フッター -->
<footer>
© 2018 InterNous.inc. All right reserved
</footer>

</body>
</html>




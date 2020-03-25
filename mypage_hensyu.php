
<?php
mb_internal_encoding("UTF-8");

//セッションスタート
session_start();

//mypage.phpからの導線以外は、「login_error」へリダイレクト

if(empty($_POST['from_mypage'])){
header("Location:login_error.php");
}

?>


<!DOCTYPE html>
<html lang=“ja”>

<head>
  <meta charset="UTF-8">
  <title>マイページ編集</title>
  <link rel="stylesheet" type="text/css" href="mypage_hensyu.css">
</head>

<body>
  <!-- フォーム欄 -->
<header>
  <img src="4eachblog_logo.jpg">
  <!-- <div class="login"><a href="login.php">ログイン</a></div> -->
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

    <form action ="mypage_update.php" method="post">
    <div class="profile">
      <p>
        氏名：
        <input type="text" class="formbox" size="40" name="hensyu_name" value="<?php echo $_SESSION['name']?>" required>
      </p>
      <p>
        メール：
        <input type="text" class="formbox" size="40" name="hensyu_mail" pattern="^[a-z0-9._%+-]+@[a-z0-9._]+\.[a-z]{2,3}$" value="<?php echo $_SESSION['mail']?>" required>
      </p>
      <p>
        パスワード：
        <input type="text" class="formbox" size="40" name="hensyu_password" value="<?php echo $_SESSION['password']?>" required>
      </p>
    </div>

    <div class="comments">
      <textarea name="hensyu_comments"><?php echo $_SESSION['comments']?></textarea>
    </div>
    <div class="henshu">
      <input type="submit" class="button1" value="この内容に変更する">
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




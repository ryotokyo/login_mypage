
<?php
mb_internal_encoding("utf8");

//仮保存されたファイル名で画像ファイルを取得（サーバーへ仮アップロードされたディレクトリとファイル名）
$temp_pic_name = $_FILES['picture']['tmp_name'];

//元のファイル名で画像ファイルを取得、事前に画像を格納する「image」という名前のフォルダを作成しておく必要あり
$original_pic_name = $_FILES['picture']['name'];
$path_filename = './image/'.$original_pic_name;
print_r($_FILES);
//仮保存のファイル名を、imageフォルダに、元のファイル名を移動させる
move_uploaded_file($temp_pic_name,'./image/'.$original_pic_name);
?>


<!DOCTYPE html>
<html lang=“ja”>

<head>
  <meta charset="UTF-8">
  <title>マイページ登録</title>

  <link rel="stylesheet" type="text/css" href="register_confirm.css">

</head>

<body>

  <header>
    <img src="4eachblog_logo.jpg">
    <div class="login"><a href="login.php">ログイン</a></div>
  </header>

  <main>
    <div class="confirm">
    <h2>会員登録 確認</h2>

    <p>こちらの内容で登録しても宜しいでしょうか？</p>

    <div class="confirm_contens">
    <label>氏名：</label>
    <?php echo $_POST['name'];?><br>
    </div>

    <div class="confirm_contens">
    <label>メール：</label>
    <?php echo $_POST['mail'];?><br>
    </div>

    <div class="confirm_contens">
    <label>パスワード：</label>
    <?php echo $_POST['password'];?><br>
    </div>

    <div class="confirm_contens">
    <label>プロフィール写真：</label>
    <?php echo $original_pic_name;?><br>
    </div>

    <div class="confirm_contens">
    <label>コメント：</label>
    <?php echo $_POST['comments'];?><br>
    </div>

    <div class="button">
      <form action ="register.php">
        <input type="submit" class="button1" value="戻って修正する">
      </form>

      <form action="register_insert.php" method="post" enctype="multipart/form-data">
        <input type="submit" class="button2" value="登録する">
        <input type="hidden" value="<?php echo $_POST['name'];?>" name="name">
        <input type="hidden" value="<?php echo $_POST['mail'];?>" name="mail">
        <input type="hidden" value="<?php echo $_POST['password'];?>" name="password">
        <input type="hidden" value="<?php echo $path_filename;?>" name="picture">
        <input type="hidden" value="<?php echo $_POST['comments'];?>" name="comments">
      </form>
    </div>
    </div>
  </main>

  <footer>
    © 2018 InterNous.inc. All right reserved
  </footer>

</body>
</html>


<!-- コメント -->








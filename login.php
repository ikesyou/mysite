<?php
require_once("mysql.php");

session_start();
 $errorMessage="";
 $email="";
if(isset($_POST["email"])&&isset($_POST["password"])){
  $db="tackle-select-user";
  //入力値をもとにユーザーの呼び出し
  $sql="SELECT * FROM users WHERE email='{$_POST['email']}'AND password='{$_POST['password']}'";
  $result=executeQuery($db,$sql);
  $rows=mysqli_fetch_array($result);
  //呼び出したものと入力値が一致しているか確認
  if($rows[2]==$_POST["email"]&&$rows[3]==$_POST["password"]){
    $_SESSION["inputdata"]=$rows;
  }else{
    $errorMessage="メールアドレスまたはパスワードが間違っています";
    $email=$_POST["email"];
  }
  mysqli_free_result($result);

}

?>

<!DOCTYPE html>
<html>


<head>
  <meta charset="utf-8">
  <title>Tackle Select</title>
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="javascript/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="javascript/login.js"></script>
  
  <script src="https://kit.fontawesome.com/7a01031b9a.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
<div class="header">
<p class="title">Tackle Select</p>
</div>

<a id="open-btn">
<i class="fas fa-bars icon"></i>
</a>
<div id="right-wrapper">
<div class="wrapper-content">
<a href="home.php">ホーム</a><br>
<?php if(!(isset($_SESSION["inputdata"]))):?>
<a href="new-acount.php">新規登録</a><br>
<?php else:?>
<a href="user-page.php">マイページ</a><br>
<a href="logout.php">ログアウト</a><br>
<a href="new-post.php">新規投稿</a><br>
<?php endif?>
<a href="place-search.php">釣り場検索</a><br>
<a href="fish-photo.php">魚図鑑</a><br>
<a href="post-index.php">投稿一覧</a><br>
<a href="introduce.php">Tackle Selectとは</a><br>
<p class="name">@2021/1/30<br>produced by  shota_ikeda</p>
</div>
</div>

</header>
<main>
<?php if(!(isset($_SESSION["inputdata"]))):?>
<div class="login">
<p class="login-title">ログイン</p>
<form action="login.php" method="post">
<?php echo "<p class='error'>{$errorMessage}</p>";?>
  <p>メールアドレス</p>
  <input type="email" name="email" value="<?php echo $email?>" required>
  <p>パスワード ※半角英数字6~12文字</p>
  <input type="password" name="password" required><br>
  <input class="btn" type="submit" value="ログイン">
</form>
</div>
<?php else:?>
<div class="user-link">
<p>ログインしました</p>
<a href="user-page.php">ユーザーページへ</a>
</div>
<?php endif;?>

</main>
<footer>

</footer>


</body>



</html>
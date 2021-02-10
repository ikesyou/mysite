<?php

 session_start();
 session_destroy();

?>

<!DOCTYPE html>
<html>


<head>
  <meta charset="utf-8">
  <title>Tackle Select</title>
  <link rel="stylesheet" type="text/css" href="css/logout.css">
  <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="javascript/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="javascript/logout.js"></script>
  
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
<a href="login.php">ログイン</a><br>
<a href="new-acount.php">新規登録</a><br>
<a href="place-search.php">釣り場検索</a><br>
<a href="fish-photo.php">魚図鑑</a><br>
<a href="post-index.php">投稿一覧</a><br>
<a href="introduce.php">Tackle Selectとは</a><br>
<p class="name">@2021/1/30<br>produced by  shota_ikeda</p>
</div>
</div>

</header>
<main>
<div class="logout">
<p>ログアウトしました</p>
<a href="home.php">ホームへ</a>

</div>

</main>
<footer>

</footer>


</body>



</html>
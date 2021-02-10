<?php

 session_start();

?>

<!DOCTYPE html>
<html>


<head>
  <meta charset="utf-8">
  <title>Tackle Select</title>
  <link rel="stylesheet" type="text/css" href="css/introduce.css">
  <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="javascript/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="javascript/introduce.js"></script>
  
  <script src="https://kit.fontawesome.com/7a01031b9a.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
<div class="header">
<p class="title">Tackle Select</p>
</div><br>
<a id="open-btn">
<i class="fas fa-bars icon"></i>
</a>
<div id="right-wrapper">
<div class="wrapper-content">
<a href="home.php">ホーム</a><br>
<?php if(!(isset($_SESSION["inputdata"]))):?>
<a href="login.php">ログイン</a><br>
<a href="new-acount.php">新規登録</a><br>
<?php else:?>
<a href="user-page.php">マイページ</a><br>
<a href="logout.php">ログアウト</a><br>
<a href="new-post.php">新規投稿</a><br>
<?php endif?>
<a href="place-search.php">釣り場検索</a><br>
<a href="fish-photo.php">魚図鑑</a><br>
<a href="post-index.php">投稿一覧</a><br>
<p class="name">@2021/1/30<br>produced by  shota_ikeda</p>
</div>
</div>
<main>
<p class="main-title">Tackle Select とは</p>
<p class="introduce">Tackle Select は、多くの方に釣りの楽しんでいただくために作成しました。当サイトでは、釣りに行く際に皆様がお悩みになるであろうことに対して、1つの解決策を提供いたします。このサイトを利用して、一人でも多くの方に、釣りを楽しんでいただけると幸いです。</p>
<div class="content">
    <h1 class="use">>ご利用方法</h1>
    <p class="use-content">当サイトは完全無料でご利用いただけます。また、無料会員登録もございます。無料会員登録をしていただければ、釣った魚の投稿機能、マイ魚図鑑などをご利用いただけます。1年に一回、投稿に対しての「いいね」数の上位30名の会員様をご招待し、釣りの大会を開催いたします。大会では豪華景品をご用意しておりますので、ぜひ、色々な投稿をしてみてください。</p>
    <h1 class="function">>機能</h1>
    <p class="function-content">当サイトには、魚種・釣り場より最適なタックルをご紹介するサービス、釣った魚をご投稿いただくサービス(ログイン必須)、投稿の閲覧サービス、位置情報・過去の釣果をもとにした釣り場検索サービス、釣った魚の名前を調べるサービスなどがございます。ぜひご利用ください。</p>
    <h1 class="terms">>ご利用規約</h1>
    <p class="terms-content">当サイトのご利用にあたりまして、他ユーザー様に対して不快感を与える行為、釣り場を汚す行為、周辺住民の方のご迷惑となる行為を確認した場合には、会員資格の停止、刑法や民法上の処分が適応される場合には法的機関への通報を行います。また、登録いただいた個人情報に関しましては、データの集計、釣り大会へのご招待に利用させていただくことをあらかじめご了承ください。</p>
    <h1 class="question">>お問い合わせ</h1>
    <div class="question-content">
      <?php if(!isset($_POST["contents"])): ?>
        <form method="post" action="introduce.php">
          <h2>ニックネーム</h2>
          <input name="name" required>
          <h2>メールアドレス</h2>
          <input type="email" name="mail" required>
          <h2>ご質問・ご意見</h2>
          <textarea name="contents" required></textarea><br>
          <input type="submit" value="送信">
        </form>
      <?php else:?>
        <h2 class="thankyou">お問い合わせありがとうございました</h2>
      <?php endif;?>
    </div>
</div>
</main>
<footer>
  

</footer>


</body>



</html>
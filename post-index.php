<?php
 require_once("mysql.php");
 session_start();

 $fish_number="";
 $place_number="";
 $search="";
 $db="tackle-select-user";

 if(isset($_POST["fish-number"])&&isset($_POST["place-number"])){
  //homeからの遷移の場合
  $fish_number=$_POST["fish-number"];
  $place_number=$_POST["place-number"];
  $sql="SELECT * FROM posts JOIN users ON posts.user_id=users.id WHERE fish_number='{$fish_number}' AND place_number='{$place_number}' ORDER BY posts.created_at DESC LIMIT 20;";
  $result=executeQuery($db,$sql);
 }elseif(isset($_POST["search"])){
  $search=$_POST["search"];
  $sql="SELECT * FROM posts JOIN users ON posts.user_id=users.id WHERE fish LIKE '%{$search}%' ORDER BY posts.created_at DESC LIMIT 20;";
  $result=executeQuery($db,$sql);
 }else{
   //通常
  $sql="SELECT * FROM posts JOIN users ON posts.user_id=users.id ORDER BY posts.created_at DESC LIMIT 20;";
  $result=executeQuery($db,$sql);
 }

 //いいねが押されたとき
 if(isset($_POST["post-id"])&&isset($_POST["user-id"])){
  $sql_like="SELECT * FROM likes WHERE user_id='{$_POST['user-id']}' AND post_id='{$_POST['post-id']}';";
  $result_like=executeQuery($db,$sql_like);
  $likes=mysqli_fetch_array($result_like);
  mysqli_free_result($result_like);
  //過去に押されていないかチェック
  if(!(isset($likes))){
  $sql_like="INSERT INTO likes(user_id,post_id) VALUES ('{$_POST['user-id']}','{$_POST['post-id']}');";
  $result_like=executeQuery($db,$sql_like);
  }
 }
 
?>

<!DOCTYPE html>
<html>


<head>
  <meta charset="utf-8">
  <title>Tackle Select</title>
  <link rel="stylesheet" type="text/css" href="css/post-index.css">
  <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="javascript/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="javascript/post-index.js"></script>
  
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
<a href="login.php">ログイン</a><br>
<a href="new-acount.php">新規登録</a><br>
<?php else:?>
<a href="user-page.php">マイページ</a><br>
<a href="logout.php">ログアウト</a><br>
<a href="new-post.php">新規投稿</a><br>
<?php endif;?>
<a href="place-search.php">釣り場検索</a><br>
<a href="fish-photo.php">魚図鑑</a><br>
<a href="introduce.php">Tackle Selectとは</a><br>
<p class="name">@2021/1/30<br>produced by  shota_ikeda</p>
</div>
</div>

<?php if(isset($_SESSION["inputdata"])):?>
<a class="new-post" href="new-post.php">
<i class="fas fa-marker new"></i>
</a>
<?php endif;?>

</header>
<main>
 
<form class="search" action="post-index.php" method="post">
  <input type="search" name="search" placeholder="魚の名前を入力">
  <input type="submit" value="検索">
</form>
<form class="reset" action="post-index.php" method="post">
  <input type="submit" name="reset" value="リセット">
</form>

  <?php while($rows=mysqli_fetch_array($result)){?>
    <div class='post-item'>
        <?php if(isset($_SESSION["inputdata"])):?>
            
            <form class="like" action="post-index.php" method="post">
              <input type="hidden" name="post-id" value="<?php echo $rows[0]?>">
              <input type="hidden" name="user-id" value="<?php echo $_SESSION['inputdata'][0]?>">
              <button> 
              <i class="fas fa-thumbs-up like-btn"></i>
              </button>
            </form>
        
        <?php endif;?>
        <div class="post-content">
          <div class="user-item">
            <img class='user-image' src='<?php echo $rows[17]?>'>
            <p class='subtitle'>投稿者:</p>
            <p class='user-name'><?php echo $rows[13]?></p>
            <p class='subtitle'>魚の名前:</p>
            <p class='fish-name'><?php echo $rows[2]?></p>
            <p class='subtitle'>場所:</p>
            <p class='place'><?php echo $rows[4]?></p>
            <p class='subtitle'>使用した竿:</p>
            <p class='rod'><?php echo $rows[8]?></p>
            <p class='subtitle'>使用したリール:</p>
            <p class='reel'><?php echo $rows[9]?></p>
            <p class='time'><?php echo $rows[10]?></p>
          </div>
          <img class='fish-image' src='<?php echo $rows[7]?>'>
          <div>
            <p class='content'><?php echo $rows[5]?></div>
          </div>
        </div> 
          
          
    </div>
  <?php };
   mysqli_free_result($result);?>


</main>
<footer>

</footer>


</body>



</html>
<?php
require_once("mysql.php");

session_start();
 $errorMessage="";
 $email="";
 $user=$_SESSION["inputdata"];
 
 $db="tackle-select-user";
 
 //プロフィール編集
 
   if(isset($_POST["save"])){
    $sql="SELECT* FROM users where id=$user[0]";
    $result1=executeQuery($db,$sql);
    $user_rows1=mysqli_fetch_array($result1);
    mysqli_free_result($result1);
      
      if(isset($_FILES["new-image"])){
        $image=$_FILES['new-image'];
        $filename=basename($image['name']);
        $tmp_path=$image['tmp_name'];
        $upload_dir="image-upload/";
        $file_path=$upload_dir.$filename;
        $new_image_name=$filename;
        $new_image_path=$file_path;
          if(is_uploaded_file($tmp_path)){
            move_uploaded_file($tmp_path, $file_path);
          }else{
            $new_image_name=$user_rows1[4];
            $new_image_path=$user_rows1[5];
          }
      }

      if(!(empty($_POST["new-name"]))){
        $new_name=$_POST["new-name"];
      }else{
        $new_name=$user_rows1[1];
      }

      if(!(empty($_POST["new-email"]))){
        $new_email=$_POST["new-email"];
      }else{
        $new_email=$user_rows1[2];
      }

      if(!(empty($_POST["password"]))){
        $new_password=$_POST["new-password"];
      }else{
        $new_password=$user_rows1[3];
      }

    $sql="UPDATE users SET name='{$new_name}',email='{$new_email}',password='{$new_password}',image_name='{$new_image_name}',image_path='{$new_image_path}' WHERE id='{$user_rows1[0]}';";
    $result4=executeQuery($db,$sql);
   }
 
   $sql="SELECT* FROM users where id=$user[0]";
 $result1=executeQuery($db,$sql);
 $user_rows=mysqli_fetch_array($result1);
 mysqli_free_result($result1);


 
 
 //自分の投稿を取得
 $sql="SELECT * FROM posts JOIN users ON posts.user_id=users.id WHERE user_id='{$user[0]}' ORDER BY posts.created_at DESC LIMIT 20;";
 $result2=executeQuery($db,$sql);

 //いいねの投稿を取得
 $sql="SELECT * FROM likes JOIN users ON likes.user_id=users.id JOIN posts ON likes.post_id=posts.id WHERE likes.user_id=$user[0] LIMIT 20;";
 $result3=executeQuery($db,$sql);

?>

<!DOCTYPE html>
<html>


<head>
  <meta charset="utf-8">
  <title>Tackle Select</title>
  <link rel="stylesheet" type="text/css" href="css/user-page.css">
  <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="javascript/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="javascript/user-page.js"></script>
  
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
<a href="login.php">ログイン</a><br>
<?php else:?>
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

<?php if(isset($_SESSION["inputdata"])):?>
<a class="new-post" href="new-post.php">
<i class="fas fa-marker new"></i>
</a>
<?php endif;?>

</header>
<main>
<?php if(isset($_SESSION["inputdata"])):?>
  
  <div class="user-page">
    <?php if(!(isset($_POST["edit"]))):?>

    <?php echo "<img class='user-image' src='{$user_rows[5]}'>"?>
    <?php echo "<p class='user-name'>{$user_rows[1]}</p>"?>
    <?php echo "<p class='user-name'>{$user_rows[2]}</p>"?>

      <form action="user-page.php" method="post">
        <input type="hidden" name="edit" value="1">
        <input type="submit" value="プロフィールを編集する">
      </form>

    <?php else:?>

      <?php echo "<img class='user-image' src='{$user_rows[5]}'>"?>
      <form action="user-page.php" enctype="multipart/form-data" method="post">

        <p class="edit-title">新しいプロフィール画像</p>
        <input type="file" name="new-image" accept="image/*">
        <p class="edit-title">新しいニックネーム</p>
        <input name="new-name" placeholder="<?php echo $user_rows[1]?>">
        <p class="edit-title">新しいメールアドレス</p>
        <input type="email" name="new-email" placeholder="<?php echo $user_rows[2]?>">
        <p class="edit-title">新しいパスワード(半角英数字6~12文字)</p>
        <input type="password" name="new-password" placeholder="<?php echo $user_rows[3]?>">
        <br>
        <input type="hidden" name="save" value="2">
        <input type="submit" value="保存">

      </form>
    <?php endif;?>
  </div>

  
  


<div class="change-btn">
  <a id="user-post" class="on">あなたの投稿</a>
    
  <a id="like-post">いいね!</a>
  </table>
</div>


<?php while($rows=mysqli_fetch_array($result2)){?>
  <div class="user-posts show">
        <div class='post-item'>
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
  mysqli_free_result($result2);?>

  




<?php while($rows=mysqli_fetch_array($result3)){?>
  <div class="like-posts">
      <div class='post-item'>
            <div class="user-item">
              <img class='user-image' src='<?php echo $rows[8]?>'>
              <p class='subtitle'>投稿者:</p>
              <p class='user-name'><?php echo $rows[4]?></p>
              <p class='subtitle'>魚の名前:</p>
              <p class='fish-name'><?php echo $rows[11]?></p>
              <p class='subtitle'>場所:</p>
              <p class='place'><?php echo $rows[13]?></p>
              <p class='subtitle'>使用した竿:</p>
              <p class='rod'><?php echo $rows[17]?></p>
              <p class='subtitle'>使用したリール:</p>
              <p class='reel'><?php echo $rows[18]?></p>
              <p class='time'><?php echo $rows[19]?></p>
            </div>
            <img class='fish-image' src='<?php echo $rows[16]?>'>
            <div>
              <p class='content'><?php echo $rows[14]?></div>
            </div>
      </div>
  </div>
    <?php };
    mysqli_free_result($result3);?>  

<?php else:?>
  <div class="error">
  <p>ログインしてください</p>
  <a href="home.php">ホームへ</a>
  </div>
<?php endif;?>

</main>
<footer>

</footer>


</body>



</html>
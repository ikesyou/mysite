<?php
require_once("mysql.php");

session_start();

$err_msg="";
$err_msg="";
$fish_number="";
$fish="";
$place_number="";
$place="";
$rod="";
$reel="";
$file="";
$content="";
$user_id=$_SESSION["inputdata"][0];
$post="";

if(isset($_POST["fish"])&&isset($_POST["place"])){
  $count=mb_strlen($_POST["content"]);
  //contentの長さを確認
  if($count<=400&&$count>0){
   //送信されたfileをフォルダに保存
   $image=$_FILES['image'];
   $filename=basename($image['name']);
   $tmp_path=$image['tmp_name'];
   $upload_dir="post-image-upload/";
   $file_path=$upload_dir.$filename;
   if(is_uploaded_file($tmp_path)){
   move_uploaded_file($tmp_path, $file_path);
   }
   $fish_number=$_POST["fish-number"];
   $fish=$_POST["fish"];
   $place_number=$_POST["place-number"];
   $place=$_POST["place"];
   $rod=$_POST["rod"];
   $reel=$_POST["reel"];
   $content=$_POST["content"];

    //入力値の登録
    $db="tackle-select-user";
    $sql="INSERT INTO posts (fish_number,fish,place_number,place,content,image_name,image_path,rod,reel,user_id) 
    VALUES ('{$fish_number}','{$fish}','{$place_number}','{$place}','{$content}','{$filename}','{$file_path}','{$rod}','{$reel}','{$user_id}')";
    
    $result=executeQuery($db,$sql);
    $post=1;

  }else{
    $err_msg="400文字以内に設定してください";
     $fish=$_POST["fish"];
     $place=$_POST["place"];
     $rod=$_POST["rod"];
     $reel=$_POST["reel"];
     $file=$_POST["image"];
     $content=$_POST["content"];
  }
  
  
 }


?>

<!DOCTYPE html>
<html>


<head>
  <meta charset="utf-8">
  <title>Tackle Select</title>
  <link rel="stylesheet" type="text/css" href="css/new-post.css">
  <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="javascript/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="javascript/new-post.js"></script>
  
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
<?php if(isset($_SESSION["inputdata"])):?>
  <?php if($post!=1):?>
  <div class="new-post">
  <p class="new-post-title">新規投稿</p>
 
  <form action="new-post.php" enctype="multipart/form-data" method="post">
        <div class="item">
          <select class="fish" name="fish-number" required>
          　<option value="">魚種を選択してください</option>
            <option>青物:ブリ･カンパチ･ヒラマサなど</option>
            <option>小型回遊魚:アジ･サバ･イワシなど</option>
            <option>根魚:カサゴ･メバル･アイナメなど</option>
            <option>底もの:ヒラメ･カレイ･キスなど</option>
            <option>シーバス(スズキ)</option>
            <option>チヌ(クロダイ)･グレ(メジナ)</option>
            <option>イカ</option>
            <option>その他</option>
          </select>
          <div class="fish-name">
            <h>魚の名前</h>
            <input name="fish" value="<?php echo $fish?>" required>
          </div>
        </div>
        <div class="item">
          <select class="place" name="place-number" required>
          　<option value="">釣り場を選択してください</option>
            <option>堤防</option>
            <option>サーフ</option>
            <option>地磯</option>
            <option>離れ磯</option>
            <option>その他</option>
          </select>
          <div class="place-name" >
            <h>釣り場の名前(住所)</h>
            <input name="place" value="<?php echo $place?>" required>
          </div>
        </div>
        <div class="item">
          <div class="rod">
            <h>使用した竿</h>
            <input name="rod" value="<?php echo $rod?>"required>
          </div>
          <div class="reel">
            <h>使用したリール</h>
            <input name="reel"value="<?php echo $reel?>" required>
          </div>
        </div>
        <div class="item">
            <h>釣った魚の画像</h>
            <input class="file" type="file" name="image" accept="image/*"required>
        </div>
        <div class="content">
          <p>コメント(400文字以内) <span id="inputlength"></span></p>
          <?php echo "<p class='error'>{$err_msg}</p>"?>
          <textarea id="textbox" name="content" maxlength="400" onkeyup="ShowLength(value);"><?php echo $content?></textarea>
        </div>
        <input name="user_id" type="hidden" value="<?php echo $user[0]?>">
        <input class="submit" type="submit" value="投稿">
  
    </form>
  </div>
  <?php else:?>
  <div class="post-index">
  <p>投稿が完了しました</p>
  <a href="post-index.php">投稿一覧へ</a>
  </div>
  <?php endif;?>
<?php else:?>
  <div class="user-link">
  <p>ログインしてください</p>
  <a href="login.php">ログインへ</a>
  </div>
<?php endif;?>

</main>
<footer>

</footer>


</body>



</html>
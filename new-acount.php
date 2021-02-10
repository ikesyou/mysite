<?php
 require_once("mysql.php");

 session_start();
 $error="";
 $email_error="";
 $name="";
 $email="";
 $password="";

 //入力値があるかチェック
 if(isset($_POST["email"])&&isset($_POST["password"])){
   $count=mb_strlen($_POST["password"]);
   //パスワードの長さを確認
   if($count>=6&&$count<=12){
      //パスワードとチェック用が一致しているかチェック
      if($_POST["password"]==$_POST["password-check"]){
      $db="tackle-select-user";
      $sql="SELECT email FROM users WHERE email='{$_POST['email']}'";
      $result=executeQuery($db,$sql);
      $rows=mysqli_fetch_array($result);
      mysqli_free_result($result);
        //入力値が既に登録されていないかチェック
        if($rows[0]==$_POST["email"]){
          $email_error="既に登録されているアドレスです。";
          $name=$_POST["name"];
          $email=$_POST["email"];
        }else{
          //送信されたfileをフォルダに保存
          
            $filename=basename($_FILES['image']['name']);
            $tmp_path=$_FILES['image']['tmp_name'];
            $upload_dir="image-upload/";
            $file_path=$upload_dir.$filename;
            $name=$_POST["name"];
            $email=$_POST["email"];
            $password=$_POST["password"];
            //追加
            if(is_uploaded_file($tmp_path)){

              move_uploaded_file($tmp_path, $file_path);
            }
          
        //入力値の登録
        $sql="INSERT INTO users (name,email,password,image_name,image_path) 
        VALUES ('{$name}','{$email}','{$password}','{$filename}','{$file_path}')";
        $result=executeQuery($db,$sql);
        //入力値をもとに呼び出し
        $sql="SELECT * FROM users WHERE email='{$_POST['email']}' AND password='{$_POST['password']}'";
        $result=executeQuery($db,$sql);
        $rows=mysqli_fetch_array($result);
        //呼び出した配列をセッションに代入
        $_SESSION["inputdata"]=$rows;
        mysqli_free_result($result);
        }
      }else{
        $error="パスワードを確認してください";
        $name=$_POST["name"];
        $email=$_POST["email"];
       
      }
    }else{
      $error="パスワードを確認してください";
      $name=$_POST["name"];
      $email=$_POST["email"];
      
    }
   
  }

?>

<!DOCTYPE html>
<html>


<head>
  <meta charset="utf-8">
  <title>Tackle Select</title>
  <link rel="stylesheet" type="text/css" href="css/new-acount.css">
  <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="javascript/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="javascript/new-acount.js"></script>
  
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
<?php else:?>
<a href="user-page.php">マイページ</a><br>
<a href="logout.php">ログアウト</a><br>
<a href="new-post.php">新規投稿</a><br>
<?php endif;?>
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
<div class="new-acount">
<p class="new-acount-title">新規会員登録</p>
<form enctype="multipart/form-data" action="new-acount.php" method="post">
  <p>ニックネーム(必須)</p>
  <input name="name" value="<?php echo $name?>" required>
  <?php echo "<p class='error'>{$email_error}</p>"?>
  <p>メールアドレス(必須)</p>
  <input type="email" name="email" value="<?php echo $email?>" required>
  <p>ユーザー画像(必須)</p>
  <input class="image-btn" type="file" name="image" accept="image/*"　required>
  <?php echo "<p class='error'>{$error}</p>"?>
  <p>パスワード(必須)　※半角英数字6~12文字</p>
  <input type="password" name="password" required>
  <p>パスワード(確認用)</p>
  <input type="password" name="password-check" required><br>
  <input class="btn" type="submit" value="登録">
</form>
<?php else:?>
<div class="user-link">
<p>ご登録ありがとうございます。</p>
<a href="user-page.php">ユーザーページへ</a>
</div>
<?php endif;?>
</div>

</main>
<footer>

</footer>


</body>



</html>
<?php
 require_once("mysql.php");
 session_start();

 $place="";
 $fish="";

 if(isset($_POST["fish"])&&isset($_POST["place"])){
    $fish=$_POST["fish"];
    $place=$_POST["place"];
    //データベースより、竿の名前を取得
    $db="tackle-select-user";
    $sql="SELECT temp.rod from
    (select rod,count(*)as cnt2 from posts WHERE place_number='{$_POST['place']}' AND fish_number='{$_POST['fish']}' group by rod) temp
    WHERE temp.cnt2=
    (SELECT MAX(cnt) FROM (SELECT rod,count(*) as cnt FROM posts WHERE place_number='{$_POST['place']}' AND fish_number='{$_POST['fish']}' group by rod)num);";
    $result=executeQuery($db,$sql);
    $rod=mysqli_fetch_array($result);
    mysqli_free_result($result);
     //データベースより、reelの名前を取得
    $db="tackle-select-user";
    $sql="SELECT temp.reel from
    (select reel,count(*)as cnt2 from posts WHERE place_number='{$_POST['place']}' AND fish_number='{$_POST['fish']}' group by reel)temp
    WHERE temp.cnt2=
    (SELECT MAX(cnt) FROM (SELECT reel,count(*) as cnt FROM posts WHERE place_number='{$_POST['place']}' AND fish_number='{$_POST['fish']}' group by reel)cnt);";
    $result=executeQuery($db,$sql);
    $reel = mysqli_fetch_array($result);
    mysqli_free_result($result);


 }

?>

<!DOCTYPE html>
<html>


<head>
  <meta charset="utf-8">
  <title>Tackle Select</title>
  <link rel="stylesheet" type="text/css" href="css/home.css">
  <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="javascript/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="javascript/home.js"></script>
  
  <script src="https://kit.fontawesome.com/7a01031b9a.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
<a id="open-btn">
<i class="fas fa-bars icon"></i>
</a>
<div id="right-wrapper">
<div class="wrapper-content">
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
<a href="post-index.php">投稿一覧</a><br>
<a href="introduce.php">Tackle Selectとは</a><br>
<p class="name">@2021/1/30<br>produced by  shota_ikeda</p>
</div>
</div>

<p class="title">Tackle Select</p>
<p class="subtitle">あなたの釣りのおともにいかがですか？</p>
</header>

<main>
    <form action="home.php" method="post">
        <div class="select">
        <select class="fish" name="fish" required>
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
        <select class="place" name="place" required>
            <option value="">釣り場を選択してください</option>
            <option>堤防</option>
            <option>サーフ</option>
            <option>地磯</option>
            <option>離れ磯</option>
            <option>その他</option>
        </select>
        </div><br>

        <input type="submit" value="タックル検索" class="tackle">
    </form>

<?php if(isset($_POST["fish"])&&isset($_POST["place"])):?>
<div class="tackle-result">
    <p class='recommend-title'><?php echo"{$place}での{$fish}を狙った釣りにおすすめのタックルは..."?></p>
    <p class='recommend-subtitle'>竿:</p>
    <h class='recommend'><?php echo $rod[0]?></h>
    <a class="link"><i class='fab fa-amazon amazon'></i></a>
    <p class='recommend-subtitle'>リール:</p>
    <h class='recommend'><?php echo $reel[0]?></h>
    <a class="link"><i class='fab fa-amazon amazon'></i></a>
       
 <form action="post-index.php" method="post">
    <input type="hidden" name="fish-number" value="<?php echo $fish?>">
    <input type="hidden" name="place-number" value="<?php echo $place?>">

    <input type="submit" class="hidebtn" value="同じ条件の投稿をみる">

 </form>
 
</div>
 
<?php endif;?>

</main>
<footer>

</footer>


</body>



</html>

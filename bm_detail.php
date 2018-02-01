<?php
//更新ページ
$id=$_GET["id"];
echo "GET;".$id;

//1.  DB接続します
try {
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
    exit('データベースに接続できませんでした。'.$e->getMessage());
    }

//２．データ登録SQL作成
$sql = "SELECT * FROM gs_bm_table WHERE id=:id";
$stmt = $pdo->prepare("$sql");
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示

$view="";
if($status==false){
//execute（SQL実行時にエラーがある場合）
$error = $stmt->errorInfo();
exit("ErrorQuery:".$error[2]);
}else{
$row=$stmt->fetch();
}


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/boostrap.css">
<link rel="stylesheet" type="text/css" href="css/example.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title>ブックマークアプリ＋USER管理画面</title>
</head>
<body>
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="bm_detail.php">書籍一覧</a>
      <a class="navbar-brand" href="us/us_select.php">ユーザー一覧</a>
    </div>
  </nav>
</header>

<header>
<div class="navbar navbar-default navbar-fixed-top">
<div class="container">
<div class="navbar-header">
<a href="#" class="navbar-brand">ブックマーク＋USER管理</a>
</div>
<div class="navbar-collapse collapse" id="navbar-main">
<ul class="nav navbar-nav">
<li class="active"><a href="bm_select.php">書籍一覧</a></li>
<li class="active"><a href="bm_insert_view.php">書籍新規登録</a></li>
<li><a href="us/us_select.php">ユーザー一覧</a></li>
</ul>

<div class="nav navbar-form navbar-right">
<div class="form-group">
<a href="https://twitter.com/" class="btn btn-twitter"><i class="fa fa-twitter fa-lg"></i> Tweet</a>
<a href="http://www.facebook.com/" class="btn btn-facebook"><i class="fa fa-facebook fa-lg"></i> Share</a>
<a href="javascript:window.open('http://b.hatena.ne.jp/" class="btn btn-hatebu"><i class="fa fa-hatebu fa-lg"></i> Bookmark</a>
</div>
</div>
</div>
</div>
</div>
</header>
<!-- Head[End] -->

<div>
<div class="container jumbotron">
<form method="post" action="bm_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>書籍データ更新</legend>
     <label>書籍名前：<input type="text" name="bookname" value="<?=$row["bookname"]?>"></label><br>
     <label>書籍url：<input type="text" name="bookurl" value="<?=$row["bookurl"]?>"></label><br>
     <label><textArea name="bookcomment" rows="4" cols="40"><?=$row["bookcomment"]?></textArea></label><br>
     <input type="hidden" name="id" value="<?=$row["id"]?>">
     <!-- idを隠してpostする必要がある-->
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
</div>
</div>
</div>


</body>
</html>
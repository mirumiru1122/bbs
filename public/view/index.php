<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>掲示板タイトル</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
  <script src="main.js"></script>
</head>

<body>
<?php
//データベースへ接続する
$dsn = 'mysql:dbname=bbs;host=db;charset=utf8mb4';
$username = 'root';
$password = 'rootpw';
$pdo = new PDO($dsn, $username, $password);
$pdo -> query('SET NAMES utf8');
?>

  <h1>スレッドタイトル</h1>
    
   
          echo "<dl>";
          echo "<dt>";
          echo "<span>".$rec['id'];"</span>";
          echo "<span>".$rec['name'];"</span>";
          echo "<span>日時</span>";
          echo "<a>返信ボタン</a>";
          echo "<a>編集ボタン</a>";
          echo "<a>削除ボタン</a>";
          echo "</dt>";
          echo "<dd>";
          echo "<span>".$rec['message'];"</span>";
          echo "</dd>";
          echo "</dl>";
   
    <div>
      <form action="index.php" method="post" >
      名 前 ：<input type="text" name="namae"   size="25"  value="名無しさん" />
      編 集KEY：<input type="password" name="key"  size=" 10" value="" /><br>
      コメント ： <br/><textarea name="comment" cols="60" rows="5"></textarea><br>
      <input type="submit" name="submit"  value="書き込む" />
      </form>
    </div>
    <?php
    //DB書き込み
    //※編集KEYとコメント両方ないと書き込みができない。
    if(!empty($_REQUEST['submit'])){
    $na = $_REQUEST['namae'];
    $ke = !empty($_REQUEST['key']) ?$_REQUEST['key'] : 0;
    $com = $_REQUEST['comment'];
    $sql = 'INSERT INTO bbs1(name,kkeeyy,message) VALUES("'.$na.'",'.$ke.',"'.$com.'")';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $pdo = NULL;
    header('Location: index.php', true, 303);
    exit();
    }
    ?>
    <div>
    <?php
function validation($data) {

	$error = array();

	// 
  	if( empty($data['namae']) ) {
	  	$error[] = "「名前」は必ず入力してください。";
	  }
    if( empty($data['comment']) ) {
	  	$error[] = "「コメント」は必ず入力してください。";
	  }
  
    return $error;
}
?>
    </div>

<?php
//$namae=empty($_POST['namae']);
//$comment=empty($_POST['comment']);
//if(empty($_POST['namae'])){
//  print'「１名前」と「コメント」は必須です。';
//}
if(empty($_POST['comment'])){
//  print'「２名前」と「コメント」は必須です。';
//}
//理論上おかしい＆両方空白の時どーすんの

?>
    </body>
    </html>
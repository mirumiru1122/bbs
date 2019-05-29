<?php

//データベースbbs1の内容を全部、getbbslistの中にぶちこむ。
function getbbslist(){
  require 'db.php';
    $res = 'SELECT*FROM bbs1 WHERE1';
    $rres = $pdo ->prepare($res);
    $rres ->execute();
    return $rres->fetchAll(PDO::FETCH_ASSOC);
    $pdo = null;
}
//データベースresbbsの内容を全部、getbbslistの中にぶちこむ。
function getreslist(){
  require 'db.php';
    $res = 'SELECT*FROM resbbs WHERE1';
    $rres = $pdo ->prepare($res);
    $rres ->execute();
    return $rres->fetchAll(PDO::FETCH_ASSOC);
    $pdo = null;
}
//空白ちぇっく
function validation($bname,$bkey,$bcomment) {
  $error = array();
	// 氏名の空白ちぇっく
  if(empty($bname)){
		$error[] = "「氏名」は必ず入力してください。";
	}
	//編集Keyの空白ちぇっく&数字ちぇっく
	if( empty($bkey)) {
		$error[] = "「編集KEY」は必ず入力してください。";
	}elseif (!preg_match('/^[0-9]+$/', $bkey)){
    $error[] = "「編集KEY」は数字で入力してください。";
  }

	//コメントの空白ちぇっく
	if( empty($bcomment)) {
		$error[] = "「コメント」は必ず入力してください。";
	}
	return $error;
}
	//書き込み
function write(){
    require 'db.php';
    $na = $_REQUEST['namae'];
    $ke = $_REQUEST['key'];
    $com = strip_tags($_REQUEST['comment']);
    date_default_timezone_set('Asia/Tokyo');
    $ti = date('Y-m-d H:i:s') ;
    $sql = 'INSERT INTO bbs1(name,time,delkey,message) VALUES("'.$na.'","'.$ti.'",'.$ke.',"'.$com.'")';
    $stmt = $pdo -> prepare($sql);
    $stmt->execute();
    $pdo = NULL;
    header('Location: ./', true, 303);
    exit();  
}
//返信ばり
function resvalidation($bname,$bkey,$bcomment) {
  $error = array();
	// 氏名の空白ちぇっく
  if(empty($bname)){
		$error[] = "「氏名」は必ず入力してください。";
	}
	//編集Keyの空白ちぇっく&数字ちぇっく
	if( empty($bkey)) {
		$error[] = "「編集KEY」は必ず入力してください。";
	}elseif (!preg_match('/^[0-9]+$/', $bkey)){
    $error[] = "「編集KEY」は数字で入力してください。";
  }

	//コメントの空白ちぇっく
	if( empty($bcomment)) {
		$error[] = "「コメント」は必ず入力してください。";
	}
	return $error;
}
//返信
function reswrite(){
    require 'db.php';
    $na = $_REQUEST['namae'];
    $ke = $_REQUEST['key'];
    $com = strip_tags($_REQUEST['comment']);
    date_default_timezone_set('Asia/Tokyo');
    $ti = date('Y-m-d H:i:s') ;
    $rd = $_REQUEST['resresid'];
    $sql = 'INSERT INTO resbbs(name,time,delkey,message,resid) VALUES("'.$na.'","'.$ti.'",'.$ke.',"'.$com.'","'.$rd.'")';
    $stmt = $pdo -> prepare($sql);
    $stmt->execute();
    $pdo = NULL;
    header('Location: ../index.php', true, 303);
    exit();  
}
//書き込み削除
function delres(){

   $delerror = array();
   $aresid = $_POST['resresid'];
   //residのdelkeyと入力したkey（deldelkey）が一致したらonoffに0をいれる
    // mysqlへの接続
   require 'db.php';
    $dres = "SELECT*FROM bbs1 WHERE id = $aresid";
    $drres = $pdo ->prepare($dres);
    $drres ->execute();
    $result = $drres->fetch(PDO::FETCH_ASSOC);
    
    //$dbdelkey = $result['delkey'];
    //認証処理
    if($_POST['deldelkey'] == $result['delkey']){
      //if (password_verify($_POST["deldelkey"], $db_hashed_pwd)) {
    $dsql = "UPDATE bbs1 SET onoff = 0 WHERE id = $aresid";
    $dstmt = $pdo -> prepare($dsql);
    $dstmt->execute();
    $pdo = NULL;
    header('Location: ../index.php', true, 303);
    exit();
    }else{
      $delerror = 'パスまちがってんぞ';
      exit();
    }
}
function delvalidation($dkey) {
  $error = array();
	//編集Keyの空白ちぇっく&数字ちぇっく
	if( empty($dkey)) {
		$error[] = "「編集KEY」は必ず入力してください。";
	}elseif (!preg_match('/^[0-9]+$/', $dkey)){
    $error[] = "「編集KEY」は数字で入力してください。";
  }
	return $error;
}
?>
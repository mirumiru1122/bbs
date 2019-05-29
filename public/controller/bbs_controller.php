<?php
//書き込み表示
require('./model/bbs1.php');
$list = getbbslist();
$reslist = getreslist();
//削除
if(!empty($_REQUEST['delsubmit'])){
  $delerror = delvalidation($_REQUEST['deldelkey']);
  if(empty($delerror)){
  delres();
}
}
// <!--空白ちぇっく-->→書き込み
if(!empty($_REQUEST['submit'])){
  $error = validation($_REQUEST['namae'],$_REQUEST['key'],$_REQUEST['comment']);
  if(empty($error)){
    write();
  }
}
if(!empty($_REQUEST['resressubmit'])){
  $reserror = resvalidation($_REQUEST['namae'],$_REQUEST['key'],$_REQUEST['comment']);
  if(empty($reserror)){
    reswrite();
  }
}
?>
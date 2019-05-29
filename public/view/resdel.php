<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>掲示板タイトル</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="main.js"></script>
  <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
</head>
<body>
<!--レス一覧表示-->
<h1>削除＆返信</h1>
<!--	33ぐらいがエラー。なぜ？
<ul >
      <li id="list">
        <?php echo $list[$_REQUEST['resid']-1]['id'],' ';?>
				<?php echo $list[$_REQUEST['resid']-1]['name'],' ';?>
        <?php echo $list[$_REQUEST['resid']-1]['time'],' ';?>
				 </li>
            <div id="mes" ><?php echo $list[$_REQUEST['resid']-1]['message'];?></div>
</ul>
-->

<h2>削除</h2>
<?php if( !empty($delerror) ): ?>
	<ul id="er">
	<?php foreach( $delerror as $der ): ?>
		<li><?php echo $der; ?></li>
	<?php endforeach; ?>
	</ul>
<?php endif; ?>
<!--エラー表示でるけどresid引き継げず。-->
<?php var_dump($_REQUEST['resid']); ?>
<?php var_dump($_REQUEST['resresid']); ?>
<div class="res_del">
<form style="display:inline"  method="POST" >
削除KEY：<input type="password" name="deldelkey"  size=" 2" value="" />
<input type="hidden" name="resresid" value= "<?php if( !empty($_REQUEST['resid'])) {echo $_REQUEST['resid'];}else{echo $_REQUEST['resresid'];}?>">
<input type="submit" name="delsubmit"  value="削除する" />
</form>
</div>

<h2>返信<h2>
<!--空白ちぇっく-->
<?php if( !empty($reserror) ): ?>
	<ul id="er">
	<?php foreach( $reserror as $er ): ?>
		<li><?php echo $er; ?></li>
	<?php endforeach; ?>
	</ul>
<?php endif; ?>

<!--フォーム-->
<div id="resform">
<form  method="POST" >
名 前 ：<input type="text" name="namae"   size="25"  value="名無しさん" />
削除KEY：<input type="password" name="key"  size=" 10" value="" /><br>
コメント ： <br/><textarea name="comment" cols="60" rows="5"></textarea><br>
<input type="hidden" name="resresid" value= "<?php if( !empty($_REQUEST['resid'])) {echo $_REQUEST['resid'];}else{echo $_REQUEST['resresid'];} ?>">
<input type="submit" name="resressubmit"  value="返信する" />
</form>
</div>

</body>
</html>
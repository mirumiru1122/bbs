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
<h1>スレッドタイトル</h1>
<?php if( !empty($list) ): ?>
  <ul >
    <?php foreach ($list as $l):?>
      <li id="list">
        <?php echo $l['id'],' ';?>
        <?php echo $l['name'],' ';?>
        <?php echo $l['time'],' ';?>

        <!--削除したやつ表示しない-->
          <?php if ($l['onoff'] == '0'):?>
            </li>
            <div id="mes">削除されました</div>
          <?php else:?>
          <!--削除ボタン-->
            <span class="res_del">
            <form style="display:inline"  method="POST" action="./del.php">
              <input type="hidden" name="resid" value= "<?=$l['id']?>">
              <input type="submit" name="deldelsubmit"  value="削除する" />
              </form>
            </span>
            <span class="res_del">
              <form style="display:inline"  method="POST" action="./del.php">
                <input type="hidden" name="resid" value= "<?=$l['id']?>">
                <input type="submit" name="resresressubmit"  value="返信する" />
              </form>
            </span>
             </li>
            <div id="mes" ><?php echo $l['message'];?></div>
           <!--返信表示-->
              <?php if( !empty($reslist) ): ?>
               <?php foreach ($reslist as $resl){
                 if ($resl['resid'] !== $l['id']){
                   continue;
                 }
                echo '<ul>';
                 echo '<li id="reslist">';
                  echo $resl['name'],' ';
                  echo $resl['time'],' ';
               echo '</li>';
              echo '<div id="mes" >';
                  echo $resl['message'];
                  echo '</div>';
              echo '</ul>';
                }?>

               <?php endif; ?>
          <?php endif; ?>
      <?php endforeach;?>
  </ul>
<?php endif; ?>

<!--空白ちぇっく-->
<?php if( !empty($error) ): ?>
	<ul id="er">
	<?php foreach( $error as $er ): ?>
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
<input type="submit" name="submit"  value="書き込む" />
</form>
</div>
</body>
</html>
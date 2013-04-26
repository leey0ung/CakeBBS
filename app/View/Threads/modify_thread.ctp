<div class="main">
	<?php
		$head;
		if('thread' === $mode){
			$head = 'スレッド';
		}else{
			$head = '返信';
		}
	?>
	<div class="bbs-menu">
		<a href="<?php echo $this->Html->url('/threads/displayThreads'); ?>">トップページ</a> &gt;
		<!--  <a href="<?php echo $this->Html->url('/threads/viewThread').'/id:'.$id; ?>"> 返信一覧</a> -->返信一覧&gt;<?php echo $head; ?>編集
	</div>
	<div class= "page-title"><?php echo $head; ?>編集フォーム</div>

	<form action= "<?php echo $this->Html->url('/Threads/updateThread') ?>" method="post"  name="bbsform">
		<input type="hidden" name="mode" value= "<?php echo $mode; ?>" >
		<input type="hidden" name="id" value= "<?php echo $id; ?>" >
		<table class="bbsform">
			<tr>
				<th>件名</th>
				<td>
					<!-- <input type="text" name="title" value = "<?php echo $title; ?>" size="35"> -->
					<?php
						echo $this->Form->text('title', array('size' => 35,'value' => $title));
				 		 echo $this->Form->error($mode.'.title');
				 	?>
				</td>
			</tr>
			<tr>
				<th>メールアドレス</th>
				<td>
					<!-- <input type="text" name="email" value = "<?php echo $email; ?>" size="35" value=""> -->
					<?php
						 echo $this->Form->text('email', array('size' => 35,'value' =>$email));
						 echo $this->Form->error($mode.'.email');
					?>
				</td>
			</tr>
			<!--
			<tr>
				<th>暗証キー</th>
				<td><input type="password" name="pwd" size="8"></td>
			</tr>
			-->
			<tr>
				<th>コメント</th>
					<td>
						<!-- <textarea name="comment"  cols="60" rows="7"><?php echo $comment; ?></textarea> -->
						<?php
							echo $this->Form->textarea('comment', array('rows' => '7', 'cols' => '60','value' => $comment));
							echo $this->Form->error($mode.'.comment');
						 ?>
					</td>
			</tr>
		</table>
		<div class="submit-btn">
			<input type="submit" value="送信する">
		</div>
	</form>
</div>
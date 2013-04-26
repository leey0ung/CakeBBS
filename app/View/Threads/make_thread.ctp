<div class="main">
	<div class="bbs-menu">
		<a href=".">トップページ</a> &gt; 新規スレッド作成
	</div>
	<div class= "page-title">新規スレッド作成フォーム</div>

	<form action= "<?php echo $this->Html->url('/Threads/saveThread') ?>" method="post"  name="bbsform">
		<input type="hidden" name="mode" value="thread">
		<table class="bbsform">
			<tr>
				<th><sup style="color:#cb363c" >*</sup>件名</th>
				<td>
					<!--  <input type="text" name="title" size="35"> -->
					<?php
						echo $this->Form->text('title', array('size' => 35));
				 		 echo $this->Form->error('Thread.title');
				 	?>
				 </td>
			</tr>
			<tr>
				<th><sup style="color:#cb363c" >*</sup>名前</th>
				<td>
					<!-- <input type="text" name="name" size="35" value=""> -->

					<?php
						 echo $this->Form->text('name', array('size' => 35));
						echo $this->Form->error('Thread.name');
					 ?>
				</td>
			</tr>
			<tr>
				<th>メールアドレス</th>
				<td>
					<!-- <input type="text" name="email" size="35" value=""> -->
					<?php
						 echo $this->Form->text('email', array('size' => 35));
						 echo $this->Form->error('Thread.email');
					?>
				</td>
			</tr>
			<tr>
				<th>暗証キー</th>
				<td>
					<!-- <input type="password" name="pwd" size="8"> -->
					<?php
						echo $this->Form->password('pwd', array('size' => 8));
						echo $this->Form->error('Thread.pwd');
					 ?>
				</td>
			</tr>
			<tr>
				<th><sup style="color:#cb363c" >*</sup>コメント</th>
				<td>
					<!-- <textarea name="comment" cols="60" rows="7"></textarea> -->
					<?php
						echo $this->Form->textarea('comment', array('rows' => '7', 'cols' => '60'));
						echo $this->Form->error('Thread.comment'); ?>
				</td>
			</tr>
		</table>
		<div class="submit-btn">
			<input type="submit" value="スレッドを作成">
		</div>
	</form>
</div>
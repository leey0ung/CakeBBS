<?php
	echo $this->Html->script('jquery',array('inline' => false));
?>
<div class="main">
	<div class="bbs-menu">

		<a href="<?php echo $this->Html->url('/Threads/displayThreads') ?>">トップページ</a>
		&gt; 返信一覧
	</div>

	<?php $this->Html->scriptStart(array('inline' => false)); ?>
		function editDiv(item){
				if(item.style.display=='none'){
						item.style.display="";
				}else{
						item.style.display="none";
				}
			}
		function editFunc(result, mode,id){
				//alert(result.responseText);
				if(result.responseText == '1'){
					 $('#form-'+mode+'-'+id).submit();
				}else{
					$('#result-'+mode+'-'+id).html('認証できません。');
				}
		}
	<?php $this->Html->scriptEnd(); ?>
	<?php
		$record = $thread[0]['Thread'];
		$title = $record['title'];
		$id = $record['id'];
		echo '<div class="art-head">'.$record['title'].'</div>';
		echo '<div class="art-body">';
		echo '日時：'.$record['updatetime'].'<br>';
		if(!empty($record['email'])){
				echo '名前：<b><a href="mailto:'.$record['email']. '">'.$record['name'].'</a></b><br>';
				}else{
				echo '名前：<b>'.$record['name'].'</b><br>';
			}
		echo '内容：<pre>'.$record['comment'].'</pre>';
		if(1 == $record['showflag'] ){
			$divId = 'div_thread_'.$record['id'];
			echo '<div class="edit"><a href="javascript:editDiv('.$divId.')"> 編集</a></div>';
			showEditDiv('thread',$record['id'], $this);
		}
		echo '</div>';

		$replys = $thread['responses'];
		for($i=0; $i< count($replys); $i++){
			$rec = $replys[$i]['Response'];
			echo '<div class="art-head">'.$rec['title'].'</div>';
			echo '<div class="art-body">';
			echo '日時：'.$rec['updatetime'].'<br>';
			if(!empty($rec['email'])){
				echo '名前：<b><a href="mailto:'.$rec['email']. '">'.$rec['name'].'</a></b><br>';
				}else{
				echo '名前：<b>'.$rec['name'].'</b><br>';
			}

			echo '返信：<pre>'.$rec['comment'].'</pre>';
			if(1 == $rec['showflag'] ){
				$divId = 'div_response_'.$rec['id'];
				echo '<div class="edit"><a href="javascript:editDiv('.$divId.')"> 編集</a></div>';
				showEditDiv('response',$rec['id'], $this);
			}
			echo '</div>';
		}

		function showEditDiv($mode, $id, $obj){
			echo '<div id= "div_'.$mode.'_'.$id.'" style="display:none">';
			echo $obj->Form->create(false, array('type'=>'post', 'action' => 'editThread','id' => "form-{$mode}-{$id}" ));
			echo $obj->Form->hidden('edit.mode',array('value' => $mode));
			echo $obj->Form->hidden('edit.id', array('value' => $id));
			echo '<table ><tr>';
			echo '<th>処理選択</th>';
			echo "<td>{$obj->Form->select('edit.selected',array('edit' =>'スレッド或は返信を編集','delete'=>'スレッド或は返信を削除'),array('default' => 'edit', 'empty'=>false,'width' =>35))}</td>";
			echo '</tr>';
			echo "<tr><th>暗証キー</th><td>{$obj->Form->password('edit.pwd', array('size' => 20))}</td>";
			//echo '<td>'.$obj->Js->submit('送信する', array('url'=> array('action' => 'ajaxcheck'),'update'=>"#result-{$mode}-{$id}" )).'</td>';
			echo '<td>'.$obj->Js->submit('送信する', array('url'=> array('action' => 'ajaxcheck'),'complete'=> "editFunc(XMLHttpRequest,\"{$mode}\",\"{$id}\")" )).'</td>';
			echo "<tr><th></th><td><div id=\"result-{$mode}-{$id}\"></div></td></tr>";
			echo $obj->Form->end();
			echo $obj->Js->writeBuffer(array('inline' => 'true'));
			echo '</tr></table>';
			echo '</div>';
		}

	?>

	<div>
		<?php
			$this->paginator->options(array('url' => array('id' => $id)));
  			echo $this->paginator->prev('前へ ');
  			echo $this->paginator->numbers(array('modulus' => $modulus));
  			echo $this->paginator->next(' 次へ');
		?>
	</div>
	<div class="replyform">
		<form action="<?php echo $this->Html->url('/Threads/saveThread') ?>"
			method="post" name="bbsform">
			<input type="hidden" name="mode" value="response">
			<input type="hidden" name="threadid" value="<?php echo $id ?>">
			<table class="bbsform">
				<tr>
					<th><sup style="color:#cb363c" >*</sup>件名</th>
					<td>
					    <!-- <input type="text" name="title" size="35" value="RE:<?php echo $title;?>"> -->
					    <?php
							 echo $this->Form->text('title', array('size' => 35, 'value' => "RE：{$title}"));
				 			 echo $this->Form->error('Response.title');
				 		?>
					</td>
				</tr>
				<tr>
					<th><sup style="color:#cb363c" >*</sup>名前</th>
					<td>
						<!--  <input type="text" name="name" size="35" value=""> -->
						<?php
						 echo $this->Form->text('name', array('size' => 35));
						 echo $this->Form->error('Response.name');
					 ?>
					</td>
				</tr>
				<tr>
					<th>メールアドレス</th>
					<td>
						 <!-- <input type="text" name="email" size="35" value=""> -->
						<?php
						 echo $this->Form->text('email', array('size' => 35));
						 echo $this->Form->error('Response.email');
					?>
					</td>
				</tr>
				<tr>
					<th>暗証キー</th>
					<td>
					   <!--  <input type="password" name="pwd" size="8"> -->
					<?php
						echo $this->Form->password('pwd', array('size' => 8));
						echo $this->Form->error('Response.pwd');
					 ?>
					</td>
				</tr>
				<tr>
					<th><sup style="color:#cb363c" >*</sup>コメント</th>
					<td>

						<!-- <textarea name="comment" cols="60" rows="7"></textarea> -->
						<?php
							echo $this->Form->textarea('comment', array('rows' => '7', 'cols' => '60'));
							echo $this->Form->error('Response.comment');
						 ?>
					</td>
				</tr>
			</table>
			<div class="submit-btn">
				<input type="submit" value="返信する">
			</div>
		</form>
	</div>
</div>
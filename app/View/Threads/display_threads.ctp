<div class="main">
<div class="bbs-menu">
	<?php echo '|'.$this->Html->link('新規スレッド', array('controller' => 'Threads', 'action' => 'makeThread')); ?>
	| &nbsp;&nbsp;&nbsp;
</div>
<div class="page-title">スレッド一覧</div>
<table class="bbs-item">
	<tr>
	<td class="headline">トピックス</td>
	<td class="headline">作成者</td>
	<td class="headline">返信</td>
	<td class="headline">参照</td>
	<td class="headline">最終更新</td>
</tr>
<?php
	$url = $this->Html->url('/Threads/viewThread/');
	for($i = 0; $i < count($threads); $i++){
		$thread = $threads[$i]['Thread'];
		echo "<tr>";
		echo '<td><a href='.$url.'id:'.$thread['id'].'>'.$thread['title'].'</a></td>';
		echo "<td>{$thread['name']}</td>";
		echo "<td>{$thread['replys']}</td>";
		echo "<td>{$thread['click']}</td>";
		echo "<td>{$thread['updatetime']}</td>";
		echo "</tr>";

	}
?>

</table>
	<div>
		<?php
  			echo $this->paginator->prev('前へ ');
  			echo $this->paginator->numbers(array('modulus' => $modulus));
  			echo $this->paginator->next(' 次へ');
		?>
	</div>
</div>
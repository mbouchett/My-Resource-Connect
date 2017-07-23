Past Needs<br>
<table>
	<tr><td>Re-Post</td><td>Needed</td><td>Title</td><td>Description</td><td>Needed By</td><td>Pleged By</td><td>Pleged On</td><td>Remove</td></tr>
	<?php for($i=0; $i<$needsCount; $i++){ ?>
	<tr>
		<td><input type="button" value="Re-Post" onclick="parent.location='repostNeed.php?need=<?= $need[$i]['need_ID'] ?>'" /></td>
		<td><?= substr($need[$i]['need_date'],0,10) ?></td>
		<td><?= $need[$i]['need_title'] ?></td>
		<td title="<?= $need[$i]['need_description'] ?>"><?= substr($need[$i]['need_description'], 0, 30)?>...</td>
		<td><?= $need[$i]['need_by'] ?></td>
		<td title="<?= $need[$i]['donor_email'] ?>"><a href="mailto:<?= $need[$i]['donor_email'] ?>" ><?= $need[$i]['donor_name'] ?></a></td>
		<td><?= $need[$i]['pledge_date'] ?></td>
		<td>
			<?php if(!$need[$i]['pledge_date']) { ?> 
			<input type="button" value="Remove" onclick="deleteItem(<?= $need[$i]['need_ID'] ?>)" <?= $disabled ?> />
			<?php } ?>
		</td>
	</tr>
	<?php }?>
</table>
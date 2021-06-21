
<div class='match_history layout_width'>
<div class='summary box1'>
	<div class='placement'>
	<?= $info['participants'][$pos]['placement']?>
	</div>
	<div class='game_mode'></div>
	<div class='length'>
	<?= round($info['participants'][$pos]['time_eliminated'] / 60) ?>
	</div>
	<div class='age'></div>
</div>
<div class='avator box1'>
</div>

<div class='traits box1'>
	<?php foreach ($info['participants'][$pos]['traits'] as $li) :  ?>
		<div class="trait ">
		<img src="<?=siteUrl('assets/front/images/traits/'.strtolower(substr($li['name'],5)).'.png')?>">
		</div>
	<?php endforeach ;?>
</div>
<div class='unit box1'>
	<?php foreach ($info['participants'][$pos]['units'] as $li) :  ?>
		<div class="character ">
		<img src="<?=siteUrl('assets/front/images/champions/'.$li['character_id'].'.png')?>">
		</div>
	<?php endforeach ;?>
</div>

<div class=' box1'>
	<div class='participants'>
		<ul>
			<?php foreach ($metadata['participants'] as $key => $value) : ?>
			<li class='participant_avater'><?=$value?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<div class='func box1'></div>
</div>

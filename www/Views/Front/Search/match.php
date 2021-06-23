<div class='match_history layout_width'>
<div class='summary box1'>
	<div class='placement'>
	<?= $info['participants'][$pos]['placement']?>등
	</div>
	<div class='game_mode'></div>
	<div class='length'>
	<?php
		$tmp = $info['participants'][$pos]['time_eliminated'];
		$min = floor($tmp / 60);
		$sec = round($tmp - ($min * 60));
		echo "$min:$sec";
	?>

	</div>
	<div class='age'>
	<?php
	echo date("m-d h:i", $info['game_datetime']);
	?>
	</div>
</div>
<div class='avator box1'>
</div>

<div class='traits_wrap box1'>
	<?php foreach ($info['participants'][$pos]['traits'] as $li) :  ?>
		<?php if ($li['tier_current'] != 0 ): ?>
			<div class="trait 
			<?php if ($li['style'] == 4) {echo("chromatic");}
			elseif( $li['style'] == 3 ) {echo("gold");}
			elseif( $li['style'] == 2 ) {echo("silver");}
			elseif( $li['style'] == 1) {echo("bronze");}
			?>">
			<img src="<?=siteUrl('assets/front/images/traits/'.strtolower(substr($li['name'],5)).'.svg')?>">
			</div>
		<?php endif; ?>
		
	<?php endforeach ;?>
</div>
<div class='unit_wrap box1'>
	<?php foreach ($info['participants'][$pos]['units'] as $li) :  ?>
		<div class='unit'>
			<div class='star tier_<?=$li['rarity']?>'>
			<?php for ($i =0; $i<$li['tier'];$i++) 
				echo "<i class='xi-star'></i>" ?>
			</div>
			<div class="character rarity_<?=$li['rarity']?> ">
			<img src="<?=siteUrl('assets/front/images/champions/'.$li['character_id'].'.png')?>">
			</div>
			<div class='item_wrap'>
			<?php if (!empty($li['items'])) : ?>
				
				<?php foreach ($li['items'] as $it) :?>
					<div class='item'>
						<img src="<?=siteUrl('assets/front/images/items/'.$it.'.png')?>">
					</div>
				<?php endforeach ;?>
				
			<?php endif?>
			</div>
		</div>
	<?php endforeach ;?>
</div>

<div class=' box1'>
	<div class='participants'>
		<ul>
			<?php foreach ($metadata['participants'] as $key => $value) : ?>
			<li class='participant_avater'>
				<a href='<?=siteUrl("search/findId?userId=$value")?>'><?=$value?></a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<div class='func box1'>
	<i class='xi-caret-down-square'></i>
	<i class='xi-caret-up-square dn'></i>
</div>
<div class='matchDetail'>
	<table>
		<thead>
			<th class='placement'>등수</th>
			<th class='summoner'>소환사</th>
			<th class='round'>라운드</th>
			<th class='time_eliminated'>생존시간</th>
			<th class='traits'>시너지</th>
			<th class='units'>챔피언</th>
			<th class='gold_left'>잔여골드</th>
		</thead>
		<tbody>
			<?php for($i = 0; $i< 8; $i ++) : ?>
			<tr class=''>
				<td class='placement'><?=$info['participants'][$i]['placement']?></td>
				<td class='summoner'><?=$info['participants'][$i]['name']?></td>
				<td class='round'><?=$info['participants'][$i]['last_round']?></td>
				<td class='time_eliminated'>
				<?php
					$tmp = $info['participants'][$i]['time_eliminated'];
					$min = floor($tmp / 60);
					$sec = round($tmp - ($min * 60));
					echo "$min:$sec";
				?>
				</td>
				<td class='traits'>
				</td>
				<td class='units'>
				</td>
				<td class='gold_left'><?=$info['participants'][$i]['gold_left']?></td>
			</tr>
			<?php endfor;?>
		</tbody>
	</table>
</div>
</div>

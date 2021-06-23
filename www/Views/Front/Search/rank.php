<div class='rank_wrap layout_width'>
	<div class='rank_img rank_box'>
		<img src="<?=siteUrl('assets/front/images/ranked-emblems/Emblem_'.ucfirst(strtolower($tier)).'.png')?>">
	</div>
	<div class='rank rank_box <?=$tier?>'><?=$tier?> <?=$rank?></div>
	<div class='leaguePoints rank_box'><?=$leaguePoints?>LP</div>
	
	<div class='wins rank_box'>승리 <?=$wins?></div>
	<div class='losses rank_box'>패배 <?=$losses?></div>
	<div class='win_rates rank_box'>승률 <?=round((($wins/($wins + $losses)) * 100),1)?>%</div>
	

</div>
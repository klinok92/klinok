<?php
//echo"<PRE>"; print_r($arResult["ITEMS"]); echo"</PRE>";
//$arResult["COUNT"]); // количество строк в таблице
?>

<? foreach ($arResult["ITEMS"] as $key => $item) { ?>
	<div class="recept">
		<div class="left">
		<a href="/recipe-<?=$item["ID"];?>/">
			<div class="zagolovok"><b><?=$item["NAME"];?></b></div>
		</a>
		<?/*<div class="text"><?=strip_tags($item["PREVIEW_TEXT"]);?></div>*/?>
		</div>
		<a href="/recipe-<?=$item["ID"];?>/" rel="nofollow">
		<div class="right">
			<div class="favorites"></div>
			<?if(!empty($item["IMG"]) && file_exists($_SERVER["DOCUMENT_ROOT"] . $item["IMG"])):?>
				<img src="<?=$item["IMG"];?>" alt="<?=$item["NAME"];?>">
			<?endif;?>
		</div>
		</a>
	</div>
<? } ?>
<?/*<PRE><?print_r($_SERVER);?></PRE>*/?>
<?
$pages = $arResult["CNT"]+1;
$page = $_REQUEST["page"];
?>
<?if($pages && $pages >= 2 && $arResult["CNT"] >= 2):?>
<div class="pagintaion">
<div class="out_midl<?=($page > 1)?" outer_five":"";?>">
<ul>
<?
$x_f = 1;
if($page && $arResult["CNT"] >= 10): $x_f = $page; endif;
$out = $pages - 10;
if($page > $out && $out > 0): $x_f = $out; endif;
		if($page > 2){ echo"<li><a href=\"".$_SERVER["REDIRECT_URL"]."\" title=\"на первую страницу\"><<</a></li>"; }
		if($page){ $prev_num = $page-1; $prev = $_SERVER["REDIRECT_URL"]."?page=".$prev_num; if($prev_num == 1): $prev = $_SERVER["REDIRECT_URL"]; endif;
			echo"<li><a href=\"".$prev."\" title=\"предыдущая страница\"><</a></li>";
		}
for ($x=$x_f; $x<$pages; $x++){
	if($x == $_REQUEST["page"] or empty($_REQUEST["page"]) && $x == 1){ $active = " class='active'"; }else{ $active = "";}
	if($x == 1){
			echo"<li".$active."><a href=\"".$_SERVER["REDIRECT_URL"]."\" title=\"1-ая страница\">".$x."</a></li>";
	}else{
		$page_f = 10; if($page): $page_f = $page_f + $page; endif;
		if($x <= $page_f):
			echo"<li".$active."><a href=\"?page=".$x."\" title=\"страница номер {$x}\">".$x."</a></li>";
		endif;
	}
}
	$next_num = $page+1; if(empty($page)): $next = $_SERVER["REDIRECT_URL"]."?page=2"; else: $next = $_SERVER["REDIRECT_URL"]."?page=".$next_num; endif;
	if($next_num != $pages): echo"<li><a href=\"".$next."\" title=\"следующая страница\">></a></li>"; endif;
	if($page != $arResult["CNT"]){	echo"<li><a href=\"".$_SERVER["REDIRECT_URL"]."?page=".$arResult["CNT"]."\" title=\"последняя страница\">>></a></li>"; }
?>
</ul>
</div>
</div>
<?endif;?>
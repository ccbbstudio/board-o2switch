<?php


function generateTheme()
{
	ob_start(); 
	$all = category_select_all();
	foreach ($all as $item) {

		extract($item);
		
		echo ".category-$id{background:$color;} ";

	}

	$css = ob_get_clean();

	$content_link = "./assets/css/app-theme.css";
	file_put_contents($content_link, $css);
}
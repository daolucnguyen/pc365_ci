<title><?=$title_seo?></title>
	<meta name="description" content="<?=$des_seo?>"/>
	<meta name="Keywords" content="<?=$key_seo?>"/>
	<meta property="og:locale" content="vi_VN" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?=$title_seo?>"/>
	<meta property="og:description" content="<?=$des_seo?>"/>
	<meta property="og:site_name" content="vieclamtheogio.timviec365.com" />
	<?
	if(isset($og_image))
	echo '<meta property="og:image" content="'.$og_image.'"/>';
	?>
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:description" content="<?=$des_seo?>" />
	<meta name="twitter:title" content="<?=$title_seo?>" />
    
    <link rel="canonical" href="<?= $link;?>">
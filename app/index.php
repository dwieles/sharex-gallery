<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/includes/classes/autoloader.php';
	use Skyfall\ScreenshotManager\WebManager;
	$web = new WebManager();

	require $_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home - <?php echo WebManager::SITE_NAME ?></title>

	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html, charset=UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=0" />
	<meta name="theme-color" content="#36393E">

	<link rel="stylesheet" type="text/css" href="/static/css/justifiedGallery.min.css">
	<link rel="stylesheet" type="text/css" href="/static/css/base.css">
	<link rel="stylesheet" type="text/css" href="/static/css/index.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<script type="text/javascript" src="/static/js/jquery.justifiedGallery.min.js"></script>
	<script type="text/javascript" src="/static/js/index.js"></script>
</head>

<body>
	<?php echo $_NAVBAR;  ?>

	<section class="container">
		<section class="main-content">
			<section class="main-uploads">
				<section class="image-gallery">
					<?php
						forEach($uploads as $key => $upload) {
							// file extensions that are showed in the gallery
							// these are formats supported by the image tag
							// for other formats switch to the table mode
							$image_ext = ['jpeg', 'gif', 'png', 'apng', 'svg', 'bmp', 'ico'];
							if(!in_array($upload[3], $image_ext)) continue;

							// generate image attributes
							$file 	    = WebManager::getUploadFolder()    . $upload[2];
							$image_url  = WebManager::getUploadFolderURL() . $upload[2];
							$image_size = WebManager::fancyBytes($upload[1]);
							$image_date = date ("d/m/Y", $upload[0]);
							$image_desc = "$upload[1] ($image_size - $image_date)";

							// echo the image
							echo '<a href="' . $image_url . '"><img style="border: 3px solid black" alt="' . $image_desc . '" src="'. $image_url . '"/></a>';
						}
					?>
				</section>
			</section>
		</section>
	</section>
</body>
</html>

<?php
// disable error notice in moodle server
error_reporting(0);

$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);
$showsidepre = $hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT);
$showsidepost = $hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT);

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$bodyclasses = array();
if ($showsidepre && !$showsidepost) {
	$bodyclasses[] = 'side-pre-only';
} else if ($showsidepost && !$showsidepre) {
	$bodyclasses[] = 'side-post-only';
} else if (!$showsidepost && !$showsidepre) {
	$bodyclasses[] = 'content-only';
}
if ($hascustommenu) {
	$bodyclasses[] = 'has_custom_menu';
}

$hasintrotitle = (!empty($PAGE->theme->settings->introtitle));
$hasintrotext = (!empty($PAGE->theme->settings->introtext));



echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
	<title><?php echo $PAGE->title ?></title>
	<link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
	<meta name="description" content="<?php p(strip_tags(format_text($SITE->summary, FORMAT_HTML))) ?>" />

	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<?php echo $OUTPUT->standard_head_html() ?>

	<!-- google fonts -->
	<script type="text/javascript">
		WebFontConfig = {
		google: { families: [ 'PT+Sans+Narrow:400,700:latin', 'Droid+Serif:400,700,400italic,700italic:latin' ] }
};
(function() {
		var wf = document.createElement('script');
		wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
	'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
		wf.type = 'text/javascript';
		wf.async = 'true';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(wf, s);
})(); </script>

</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>

<div id="page">
	<div id="page-header-wrap">
		<div id="page-header">
			<h1 class="headermain">
				<a href="/" title="Moodle U.Porto" >Moodle U.Porto</a>
				<!-- <a href="/"><img src="<?php echo $OUTPUT->pix_url('header', 'theme'); ?>" alt="logo_fcpe" /></a> -->
			</h1>
			<?php if ($hasheading) { ?>
				<?php if($hasheadingmenu) { ?>
					<div class="headermenu">
						<?php echo $PAGE->headingmenu; ?>
					</div>
				<?php } ?>
			<?php } ?>
			<?php if ($hascustommenu) { ?>
				<div id="custommenu"><?php echo $custommenu; ?></div>
			<?php } ?>

			<div id="login-info-wrap">
			<?php
//				echo $OUTPUT->lang_menu();
//				echo $OUTPUT->login_info();
			?>
			</div>
		</div>
	</div>

<!-- END OF HEADER -->

	<div id="page-content">
		<div id="region-main-box">
			<div id="region-post-box">
				<div id="region-main-wrap">
					<div id="region-main">
						<div class="region-content">


						<?php if (!isloggedin()) { ?>
							<div class="intro">
								<?php if ( $hasintrotitle) { ?>
		                        	<h2><?php echo $PAGE->theme->settings->introtitle; ?></h2>
		                        <?php } ?>

   								<?php if ( $hasintrotext) {
			                        echo $PAGE->theme->settings->introtext;
			                    } ?>
       						</div>
		                <?php } ?>

						<?php if (!isloggedin()) { ?>
							<!-- <?php echo core_renderer::MAIN_CONTENT_TOKEN ?> -->
						<?php include("login.php");
							} else { ?>
							<!-- <?php echo core_renderer::MAIN_CONTENT_TOKEN ?> -->

							<ul class="courses-list">

							<?php if($courses = enrol_get_users_courses($USER->id, true, Null, 'visible DESC,sortorder ASC')) {
								foreach($courses as $value) {
									echo '<li><a href="' . $CFG->wwwroot . '/course/view.php?id=' . $value->id . '">' . $value->fullname . '</a></li>';
								}
							} ?>

							</ul>

						<?php } ?>

						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- START OF FOOTER -->
	<div id="page-footer">
<!-- 	<img src="<?php echo $OUTPUT->pix_url('logo_up', 'theme'); ?>" alt="logo_up" /> -->
		<?php
/* 		echo $OUTPUT->login_info(); */
		echo $OUTPUT->standard_footer_html();
		?>
	</div>

</div>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>
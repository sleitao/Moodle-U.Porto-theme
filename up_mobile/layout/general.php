<?php
// disable error notice in moodle server
error_reporting(1);

$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));

$hassidepost = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-post', $OUTPUT));
$haslogininfo = (empty($PAGE->layout_options['nologininfo']));

$showsidepost = ($hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT));

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$bodyclasses = array();
if ($showsidepost) {
	$bodyclasses[] = 'side-post-only';
} else if (!$showsidepost) {
	$bodyclasses[] = 'content-only';
}

if ($hascustommenu) {
	$bodyclasses[] = 'has_custom_menu';
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
	<title><?php echo $PAGE->title ?></title>
	<link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
	<?php echo $OUTPUT->standard_head_html() ?>
	
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>
<div id="page">            
	<?php if ($hasheading || $hasnavbar) { ?>
	<div id="page-header-wrap">
		<div id="page-header">
		<?php if ($hasheading) { ?>
<!--			<h1 class="headermain">Moodle U.Porto</h1>-->
<!--				<h1><?php echo $PAGE->heading ?></h1>-->
			<?php if ($hasnavbar) { ?>
				<div class="breadcrumb">
					<img src="<?php echo $OUTPUT->pix_url('back', 'theme'); ?>" class="back" alt="back" />
					<?php echo $OUTPUT->navbar(); ?>
				</div>
			<?php } ?>
			<?php if($hasheadingmenu) { ?>
				<div class="headermenu">
					<?php echo $PAGE->headingmenu; ?>
				</div>
			<?php } ?>
		<?php } ?>
			
		<?php if ($hascustommenu) { ?>
			<div id="custommenu"><?php echo $custommenu; ?></div>
		<?php } ?>
		
		<?php
			if (!empty($PAGE->layout_options['langmenu'])) {
//				echo $OUTPUT->lang_menu();
			}
			if ($haslogininfo) {
	//				echo $OUTPUT->login_info();
			}
		?>			
			<div id="profilemenu">
				<ul id="menu">
<!--					<li>
						<h3>Courses</h3>
					</li>-->
<!--					<?php include("message.php"); ?>-->
					<li class="toggle" id="profilepic"><?php echo '<a href="' . $CFG->wwwroot.'/user/profile.php?id=' . $USER->id . '"><img src="' . $CFG->wwwroot.'/user/pix.php?file=/' . $USER->id . '/f1.jpg" width="44px" height="44px" title="' . $USER->firstname . ' ' . $USER->lastname . '" alt="' . $USER->firstname . ' ' . $USER->lastname . '" /></a>'; ?>
						<div id="userinfo">
							<h3><?php p(''.$USER->firstname.' '.$USER->lastname.'') ?></h3>
							<ul>
								<li><a href="<?php p($CFG->wwwroot) ?>/my/"><?php p(get_string('myhome')); ?></a></li>
								<li><a href="<?php p($CFG->wwwroot) ?>/user/profile.php"><?php p(get_string('myprofile')); ?></a></li>
								<li><?php echo $OUTPUT->theme_switch_links(); ?></li>
								<li><a href="<?php p($CFG->wwwroot) ?>/login/logout.php"><?php p(get_string('logout')); ?></a></li>
							</ul>
						</div>
					</li>
				</ul>
			</div>
			<!-- end profile menu -->
		</div>
	</div>
	<?php } ?>
<!-- END OF HEADER -->
	<div id="page-content">
		<div id="region-main-box">
			<div id="region-post-box">

				<div id="region-main-wrap">
					<?php if ($hasnavbar) { ?>
<!--						<div class="navbutton"> <?php echo $PAGE->button; ?></div>-->
					<?php } ?>
					<div id="region-main">
						<div class="region-content">
                            <?php echo core_renderer::MAIN_CONTENT_TOKEN ?>                           
						</div>
					</div>
				</div>
				<!-- sidebar -->
<?php if ($hassidepost) { ?>
					<div id="region-post" class="block-region">
						<div class="region-content">
							<?php echo $OUTPUT->blocks_for_region('side-post') ?>
						</div>
					</div>
				<?php } ?>
<!--				</div>-->
			</div>
		</div>
	</div>



<!-- START OF FOOTER -->
	<?php if ($hasfooter) { ?>
	<div id="page-footer" class="clearfix">
<!-- 	  <p class="helplink"><?php echo page_doc_link(get_string('moodledocslink')) ?></p> -->
<!-- 	<img src="<?php echo $OUTPUT->pix_url('logo_up', 'theme'); ?>" alt="logo_up" /> -->
		<?php
//		echo $OUTPUT->login_info();
//		echo $OUTPUT->home_link();
//		echo $OUTPUT->standard_footer_html();
		echo $OUTPUT->theme_switch_links();
		?>
	</div>
	<?php } ?>
</div>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>
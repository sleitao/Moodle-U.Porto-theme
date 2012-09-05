
<div id="login">
<?php 
	//based on aardvark theme
	if (isloggedin()) {
		echo '<div class="profilepic" id="profilepic">';
		echo '<a href="' . $CFG->wwwroot . '/user/profile.php?id=' . $USER->id . '"><img src="' . $CFG->wwwroot . '/user/pix.php?file=/' . $USER->id . '/f1.jpg" width="80px" height="80px" title="' . $USER->firstname . ' ' . $USER->lastname . '" alt="' . $USER->firstname . ' ' . $USER->lastname . '" /></a>';
		echo '</div';
	}
?>

<?php
	function get_content () {
	global $USER, $CFG, $SESSION, $COURSE;
	$wwwroot = '';
	$signup = '';}

	if (empty($CFG->loginhttps)) {
		$wwwroot = $CFG->wwwroot;
	} else {
		$wwwroot = str_replace("http://", "https://", $CFG->wwwroot);
	}

if (!isloggedin() or isguestuser()) {
	echo '<div id="loginform">';
	echo '<form method="post" action="'.$wwwroot.'/login/index.php?authldap_skipntlmsso=1">';
	echo '<input class="loginform" type="text" name="username" id="login_username" value="" placeholder="'.get_string('username').'" />';
	echo '<input class="loginform" type="password" name="password" id="login_password" value="" placeholder="'.get_string('password').'" />';
	echo '<input type="submit" value="&nbsp;&nbsp;'.get_string('login').'&nbsp;&nbsp;" />';
	echo '</form>';
	echo '</div>';
} else {
	echo '<div class="profilename" id="profilename">';
	echo '<a href="'.$CFG->wwwroot.'/user/view.php?id='.$USER->id.'&amp;course='.$COURSE->id.'">'.$USER->firstname.' '.$USER->lastname.'</a>';
	echo '</div>';
?>
</div>

<!--<div class="profilebar" id="profilebar" style="display: none;">
	<div class="profilebar_block">
		
	</div>

	<div class="profilebar_events">
		<h4><?php echo get_string('upcomingevents','calendar');?></h4>
		
		<?php include ('upcoming.php');?>
		
	</div>

	<div class="profilebar_account">
		<h4><?php echo get_string('mymoodle', 'my');?></h4>
		<div class="profileoptions" id="profileoptions">
			<table width="100%" border="0">
			<tr>
			<td> <ul>
			<li><a href="<?php echo $CFG->wwwroot; ?>/my"><img src="<?php echo $OUTPUT->pix_url('profile/courses', 'theme')?>" />&nbsp;<?php echo get_string('mycourses');?></a></li>
						<li><a href="<?php echo $CFG->wwwroot; ?>/user/profile.php"><img src="<?php echo $OUTPUT->pix_url('profile/profile', 'theme')?>" />&nbsp;<?php echo get_string('myprofile');?></a></li>

						<li><a href="<?php echo $CFG->wwwroot; ?>/user/filesedit.php"><img src="<?php echo $OUTPUT->pix_url('profile/myfiles', 'theme')?>" />&nbsp;<?php echo get_string('myfiles');?></a></li>

			</ul></td>
			<td><ul>
		<li><a href="<?php echo $CFG->wwwroot; ?>/calendar/view.php?view=month"><img src="<?php echo $OUTPUT->pix_url('profile/calendar', 'theme')?>" />&nbsp;<?php echo get_string('calendar','calendar');?></a></li>

			<li><a href="<?php echo $PAGE->theme->settings->emailurl;?> "><img src="<?php echo $OUTPUT->pix_url('profile/email', 'theme')?>" />&nbsp;<?php echo get_string('email','theme_aardvark');?></a></li>
			<li><a href="<?php echo $CFG->wwwroot; ?>/login/logout.php"><img src="<?php echo $OUTPUT->pix_url('profile/logout', 'theme')?>" />&nbsp;<?php echo get_string('logout');?></a></li>
			</ul></td>
			</tr>
			</table>
		</div>
	</div>
		<div class="profilebarclear">
		</div>
</div>-->

<?php }?>
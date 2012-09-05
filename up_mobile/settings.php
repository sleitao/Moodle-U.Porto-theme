<?php

/**
 * Settings for the UP Mobile
 */



$name = 'theme_up_mobile/introtitle';
$title = get_string('introtitle','theme_up_mobile');
$setting = new admin_setting_configtext($name, $title, '', '');
$settings->add($setting);

$name = 'theme_up_mobile/introtext';
$title = get_string('introtext','theme_up_mobile');
$setting = new admin_setting_confightmleditor($name, $title, '', '');
$settings->add($setting);


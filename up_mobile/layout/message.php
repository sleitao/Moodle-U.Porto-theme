<?php

global $USER, $DB, $PAGE, $CFG, $SITE;

	if (!$PAGE->get_popup_notification_allowed() || empty($CFG->messaging)) {
//		return;
	}

	if (!isloggedin() || isguestuser()) {
//		return;
	}

	if (!isset($USER->message_lastpopup)) {
//           $USER->message_lastpopup = 0;
	} else if ($USER->message_lastpopup > (time()-120)) {
//           dont run the query to check whether to display a popup if its been run in the last 2 minutes
//		return;
	}

//       a quick query to check whether the user has new messages
	$messagecount = $DB->count_records('message', array('useridto' => $USER->id));
	if ($messagecount<1) {
//		return;
	}

	//got unread messages so now do another query that joins with the user table
	$messagesql = "SELECT m.id, m.smallmessage, m.fullmessageformat, m.notification, u.firstname, u.lastname
						FROM {message} m
						JOIN {message_working} mw ON m.id=mw.unreadmessageid
						JOIN {message_processors} p ON mw.processorid=p.id
						JOIN {user} u ON m.useridfrom=u.id
					WHERE m.useridto = :userid
						AND p.name='popup'";

	//if the user was last notified over an hour ago we can renotify them of old messages
	//so don't worry about when the new message was sent
//	$lastnotifiedlongago = $USER->message_lastpopup < (time()-3600);
//	if (!$lastnotifiedlongago) {
//		$messagesql .= 'AND m.timecreated > :lastpopuptime';
//	}

	$message_users = $DB->get_records_sql($messagesql, array('userid'=>$USER->id, 'lastpopuptime'=>$USER->message_lastpopup));

	
	$totalmessages = count($message_users);
	
//       if we have new messages to notify the user about
	
	
	$url = $CFG->wwwroot.'/message/index.php';
					
	$content = html_writer::start_tag('li', array('id'=>'newmessage', 'class'=>'toggle')) .
					html_writer::start_tag('a', array('href'=>'#')) .
						$totalmessages .
					html_writer::end_tag('a') .
				html_writer::start_tag('ul', array('id'=>'messages')) .				
				
//	if (!empty($message_users)) {

		$strmessages = '';
		if (count($message_users)>21) {
//			$strmessages = get_string('unreadnewmessages', 'message', count($message_users));
		} else {	
		
		/*
		message: 
			id
			smallmessage
			fullmessageformat
			notification
			firstname
			lastname
		*/			
			foreach ($message_users as $msg) {
				$content .= html_writer::start_tag('li');
				$content .= html_writer::start_tag('a', array('href'=>$url));				
				//try to display the small version of the message
				$smallmessage = null;
				if (!empty($msg->smallmessage)) {
					//display the first 150 chars of the message in the popup
					$textlib = textlib_get_instance();
					$smallmessage = null;
					if ($textlib->strlen($msg->smallmessage) > 150) {
						$smallmessage = $textlib->substr($msg->smallmessage,0,150).'...';
					} else {
						$smallmessage = $msg->smallmessage;
					}
					//prevent html symbols being displayed
					if ($msg->fullmessageformat == FORMAT_HTML) {
						$smallmessage = html_to_text($smallmessage);
					} else {
						$smallmessage = s($smallmessage);
					}
				} else if ($msg->notification) {
					//its a notification with no smallmessage so just say they have a notification
					$smallmessage = get_string('unreadnewnotification', 'message');
				}
				if (!empty($smallmessage)) {
					$strmessages .= '<div id="usermessage">'.s($smallmessage).'</div>';
				}
				$content .= $smallmessage;
												
				$content .= html_writer::end_tag('a');
				$content .= html_writer::end_tag('li');			
			}
		}

//		$strgomessage = get_string('gotomessages', 'message');
//		$strstaymessage = get_string('ignore','admin');
//
//		$url = $CFG->wwwroot.'/message/index.php';
//		$content .=
//		html_writer::start_tag('div', array('id'=>'newmessage')).
//						html_writer::start_tag('div', array('id'=>'newmessagetext')).
//							$strmessages.
//						html_writer::end_tag('div').
//
//						html_writer::start_tag('div', array('id'=>'newmessagelinks')).
//							html_writer::link($url, $strgomessage, array('id'=>'notificationyes')).
//							html_writer::link('', $strstaymessage, array('id'=>'notificationno')).
//						html_writer::end_tag('div');
//					html_writer::end_tag('div');

//		$PAGE->requires->js_init_call('M.core_message.init_notification', array('', $content, $url));

//		$USER->message_lastpopup = time();
//	} 
//				$content .= html_writer::end_tag('a');
			$content .= html_writer::end_tag('ul');
		$content .= html_writer::end_tag('li');
	echo $content;
?>
<?php
 
class theme_up_mobile_core_renderer extends core_renderer {
	public function heading($text, $level = 2, $classes = 'main', $id = null) {
	    $level = (integer) $level;
	    if ($level < 1 or $level > 6) {
	        throw new coding_exception('Heading level must be an integer between 1 and 6.');
	    }
	    return html_writer::tag('h' . $level, $text, array('id' => $id, 'class' => renderer_base::prepare_classes($classes)));
	}
	
	/**
	* Changed so only return the last link item 
	*
	* Return the navbar content so that it can be echoed out by the layout
	* @return string XHTML navbar
	*/
	public function navbar() {
		$items = $this->page->navbar->get_items();

		$htmlblocks = array();
		// Iterate the navarray and display each node
		$itemcount = count($items);
		$separator = get_separator();
		for ($i=0;$i < $itemcount-1;$i++) {
			$item = $items[$i];
			$item->hideicon = true;
			if ($i===0) {
//				$content = html_writer::tag('li', $this->render($item));
			} else {
//				$content = html_writer::tag('li', $separator.$this->render($item));
			}
//	            $htmlblocks[] = $content;

			$bread = $this->render($item);
			$pattern = '/<a /'; //probably is better to improve this regex
			$match = preg_match($pattern, $bread);
			if($match) {
				$htmlblocks = $this->render($item);
			}
			
//			$htmlblocks = $this->render($item);
		}
		//accessibility: heading for navbar list  (MDL-20446)
		//$navbarcontent = html_writer::tag('span', get_string('pagepath'), array('class'=>'accesshide'));
	//  $navbarcontent .= html_writer::tag('ul', join('', $htmlblocks));
		$navbarcontent = $htmlblocks;
		
		// XHTML
		return $navbarcontent;
	}
}



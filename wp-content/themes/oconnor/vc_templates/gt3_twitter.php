<?php
	$defaults = array(
		'name' => '',
		'count' => '1',
		'count_begin' => '1',
		'font_size' => '',
		'line_height' => '',
		'text_color' => '',
		'link_color' => '',
		'spacing' => ''
	);

	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	$classes = '';
	$twitter_name = esc_html( $name );

	if ($count_begin != '1') {
		$count = (int)$count + (int)$count_begin - 1;
	}
	
	if (!empty($count)) {
		if (!empty($name)) {
			$tweets = getTweets((int)$count, $twitter_name);
		}else{
			$tweets = getTweets((int)$count);
		}
	}else{
		$twitter_name = get_option('tdf_user_timeline');
		$tweets = getTweets();
	}

	$twitter_spacing = !empty($spacing) ? ' style="margin-bottom:'.esc_attr($spacing).'px;"' : '';

	$twitter_link_style = !empty($link_color) ? ' style="color:'.esc_attr($link_color).';"' : '';

	$date_format = get_option( 'date_format' );
	$twitter_url = 'https://twitter.com';
	$pattern = array('/(htt(p|ps):(\S)+)\w+/','/(\s(#(\S+))+)/','/(\s(@(\S+))+)/');
	$replace = array('<a href="${0}"'.$twitter_link_style.' target="_blank" rel="nofollow">${0}</a>',' <a href="'.$twitter_url.'/hashtag/${3}?src=hash"'.$twitter_link_style.' class="hash_tag" target="_blank" rel="nofollow">${2}</a>','<a href="'.$twitter_url.'/${3}"'.$twitter_link_style.' class="twitter_shared" target="_blank" rel="nofollow">${2}</a>');

	$twitter_acc = '<div class="twitter_acc">';
	$twitter_acc .= '<a href="'.$twitter_url.'/'.esc_html($twitter_name).'"'.$twitter_link_style.' class="twitter_author">';
	$twitter_acc .= '&#64;'.esc_html($twitter_name);
	$twitter_acc .= '</a>';
	$twitter_acc .= '</div>';

	$twitter_heading = '<div class="twitter_heading clearfix"'.$twitter_spacing.'>';
	$twitter_heading .= '<div class="twitter_icon"></div>';
	$twitter_heading .=  '<div class="twitt_title">'.esc_html__("Tweet", 'oconnor').'</div>';
	$twitter_heading .= '</div>';

	$twitter_style = '';
	$twitter_style .=  !empty($text_color) ? 'color:'.esc_attr($text_color).';' : '';
	$twitter_style .=  !empty($font_size) ? 'font-size:'.esc_attr($font_size).'px;' : '';
	$twitter_style .=  !empty($line_height) ? 'line-height:'.esc_attr($line_height).'%;' : '';
	$twitter_style =  !empty($twitter_style) ? esc_attr($twitter_style): '';

	echo '<div class="twitter_container gt3_twitter" style="'.esc_attr($twitter_style).'">';

	if (!empty($tweets['error'])) {
		echo '<div class="twitter_error">'.$tweets['error'].'</div>';
		return false;
	}

	$i = 1;

	foreach($tweets as $tweet){

		if ($count_begin != '1' && $i < (int)$count_begin) {
			$i++;
		}else{
		
			$text = preg_replace($pattern, $replace, esc_html($tweet['text']));		
			$time = $tweet['created_at'];
			$time = date_parse($time);
			$unixTime = mktime($time['hour'], $time['minute'], $time['second'], $time['month'], $time['day'], $time['year']);
			echo '<div class="twitter_item">';
				echo (($twitter_heading));
				echo '<div class="twitter_text"'.$twitter_spacing.'>'.$text.'</div>';
				echo '<div class="twitter_separator"'.$twitter_spacing.'></div>';
				echo '<div class="twitter_footer clearfix">';
					echo '<div class="twitt_time">';
					if ((current_time('timestamp') - $unixTime) < 86400) {
						echo human_time_diff($unixTime, current_time('timestamp')) . ' ' . esc_html__("ago", 'oconnor');
					}else{
						echo date($date_format, $unixTime);				
					}
					echo '</div>';
					echo (($twitter_acc));
				echo '</div>';
			echo '</div>';
		}

	}

	echo '</div>';	
?>  

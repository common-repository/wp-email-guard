<?php
	/*
	Plugin Name: WP Email Guard
	Version: 0.3
	Description: Automatically protects your email addresses by hashing them by Javascript
	Author: Moe Hassan, Khemso, Net-Code
	Author URI: http://www.itquad.com/
	Plugin URI: http://www.itquad.com/wordpress/plugins/wp-email-guard
	
	*/

	
	
	function WPMailGuard_wp_head($content){
		$js="<script type=\"text/javascript\">
		function MailGuard(mailbox,domain){
			str=\"<a href='mailto:\"+mailbox+\"@\"+domain+\"'>\"+mailbox+\"@\"+domain+\"</a>\";
			document.write(str);
		}
		</script>";
		
		
		echo $js;
	}
	
	function WPMailGuard_content_filter($content){
		
		$pattern = '/mailto:(\w+)@(\w+)\.(\w+)/i';
			$replacement = '<script>MailGuard(\'${1}\',\'${2}.${3}\')</script>';
		$content=preg_replace($pattern, $replacement, $content);
		
		$pattern = '/(\w+)@(\w+)\.(\w+)/i';
			$replacement = '<script>MailGuard(\'${1}\',\'${2}.${3}\')</script>';
		$content=preg_replace($pattern, $replacement, $content);
		
		return $content;
		
	}
	
	
	add_filter('the_content', 'WPMailGuard_content_filter');
	add_filter('the_content_rss', 'WPMailGuard_content_filter');
	add_filter('comment_text', 'WPMailGuard_content_filter');
	add_filter('wp_head', 'WPMailGuard_wp_head');
	
	
	
	
	
?>

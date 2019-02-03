<?php
/*
Plugin Name: adds a fixed sentence of every post
Plugin URI: http://www.orbitarc.com
Description: Add some content to the bottom of each post.
Version: 1.0
Author: Urvik Bhavsar
Author URI: http://orbitarc.com
License: GPL2
*/


if( !function_exists("bottom_of_every_post")){
	function bottom_of_every_post($content){

	/*	there is a text file in the same directory as this script */

		$fileName = dirname(__FILE__) ."/bottom_of_every_post.txt";

	/*	we want to change `the_content` of posts, not pages
		and the text file must exist for this to work */

		if( !is_page( ) && file_exists( $fileName )){

		/*	open the text file and read its contents */

			$theFile = fopen( $fileName, "r");
			$msg = fread( $theFile, filesize( $fileName ));
			fclose( $theFile );
			
			/* detect the old message in code to try and eradicate my name and #
			showing up on strange websites that are run by lazy people */
			
			if( $msg == "<p>Call for an estimate 647-471-7150<br><a href=\"mailto:urvikjust4u@gmail.com\">urvikjust4u@gmail.com</a></p>" ){
				$msg = "<p>Thank you for installing the adds a fixed sentence of every post WordPress plugin. To find out how to change or remove this message, read <a href=\"http://orbitarc.com/\">the instructions</a>.</p>";
			}

		/*	append the text file contents to the end of `the_content` */
			return $content . stripslashes( $msg );
		} else{

		/*	if `the_content` belongs to a page or our file is missing
			the result of this filter is no change to `the_content` */

			return $content;
		}
	}

	/*	add our filter function to the hook */

	add_filter('the_content', 'bottom_of_every_post');
}

?>
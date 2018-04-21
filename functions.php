<?php
include ("dao.php");

function convertYoutube($string) {
					return preg_replace(
					"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
						"<iframe width=\"260\" height=\"160\" src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
					$string
						);
					}	
					
function convertYoutube480($string) {
					return preg_replace(
					"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
						"<iframe width=\"480\" height=\"360\" src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
					$string
						);
					}	
function convertYoutubenagy($string) {
					return preg_replace(
					"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
						"<iframe width=\"720\" height=\"480\" src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
					$string
						);
					}	

function konvertal($string) {
if (preg_match('![?&]{1}v=([^&]+)!', $string . '&', $m)) {
    $video_id = $m[1];
	/*$url = 'https://img.youtube.com/vi/'.$video_id.'/hqdefault.jpg';*/
	$url = 'https://i1.ytimg.com/vi/'.$video_id.'/mqdefault.jpg';
	return $url;
	}

}
function konvertal480($string) {
if (preg_match('![?&]{1}v=([^&]+)!', $string . '&', $m)) {
    $video_id = $m[1];
	/*$url = 'https://img.youtube.com/vi/'.$video_id.'/hqdefault.jpg';*/
	$url = 'https://i1.ytimg.com/vi/'.$video_id.'/hqdefault.jpg';
	return $url;
	}

}
					
?>
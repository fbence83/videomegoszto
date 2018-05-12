<?php
session_start();

if(!isset($_SESSION["admin"])) {
    $_SESSION["admin"] = null;
}
define("ADMIN", $_SESSION["admin"]);
include ("dao.php");


function convertYoutubenagy($string) {
					return preg_replace(
					"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
						"<iframe width=\"720\" height=\"480\" src=\"//www.youtube.com/embed/$2\"  id = \"felugrovidi\"></iframe>",
					$string
						);
					}	

function konvertalnagy($string) {
if (preg_match('![?&]{1}v=([^&]+)!', $string . '&', $m)) {
    $video_id = $m[1];
	
	$url = 'https://img.youtube.com/vi/'.$video_id.'/maxresdefault.jpg';
	return $url;
	}

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
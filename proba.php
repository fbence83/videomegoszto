<?php
function konvertal($string) {
if (preg_match('![?&]{1}v=([^&]+)!', $string . '&', $m)) {
    $video_id = $m[1];
	$url = 'https://img.youtube.com/vi/'.$video_id.'/hqdefault.jpg';
	return $url;
	}

}
?>
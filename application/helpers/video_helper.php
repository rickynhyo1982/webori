<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Views helper contains facilities to show videos
 *
 * @package	DASC
 * @subpackage	helpers
 * @category	hepers
 * @author	Pedro Escudero
 * @link	
 */


/**
 * Load View
 *
 * Load View in Views code
 */

if (!function_exists('parse_video')) {
    function parse_video($video_resource) {
	$CI = get_instance();
        $video_code = '';
        //Youtube http://youtu.be/JSUIQgEVDM4
        if (strpos($video_resource, 'youtube.com') !== false || strpos($video_resource, 'youtu.be') !== false) {
             $regexstr = '~
            # Match Youtube link and embed code
            (?:                             # Group to match embed codes
                (?:<iframe [^>]*src=")?       # If iframe match up to first quote of src
                |(?:                        # Group to match if older embed
                    (?:<object .*>)?      # Match opening Object tag
                    (?:<param .*</param>)*  # Match all param tags
                    (?:<embed [^>]*src=")?  # Match embed tag to the first quote of src
                )?                          # End older embed code group
            )?                              # End embed code groups
            (?:                             # Group youtube url
                https?:\/\/                 # Either http or https
                (?:[\w]+\.)*                # Optional subdomains
                (?:                         # Group host alternatives.
                youtu\.be/                  # Either youtu.be,
                | youtube\.com              # or youtube.com
                | youtube-nocookie\.com     # or youtube-nocookie.com
                )                           # End Host Group
                (?:\S*[^\w\-\s])?           # Extra stuff up to VIDEO_ID
                ([\w\-]{11})                # $1: VIDEO_ID is numeric
                [^\s]*                      # Not a space
            )                               # End group
            "?                              # Match end quote if part of src
            (?:[^>]*>)?                       # Match any extra stuff up to close brace
            (?:                             # Group to match last embed code
                </iframe>                 # Match the end of the iframe
                |</embed></object>          # or Match the end of the older embed
            )?                              # End Group of last bit of embed code
            ~ix';
 
            preg_match($regexstr, $video_resource, $matches);
            $video_code = 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=1';
        }
        
        //Vimeo http://vimeo.com/95205304
        if (strpos($video_resource, 'vimeo.com') !== false) {
            $regexstr = '~
                # Match Vimeo link and embed code
                (?:<iframe [^>]*src=")?       # If iframe match up to first quote of src
                (?:                         # Group vimeo url
                    https?:\/\/             # Either http or https
                    (?:[\w]+\.)*            # Optional subdomains
                    vimeo\.com              # Match vimeo.com
                    (?:[\/\w]*\/videos?)?   # Optional video sub directory this handles groups links also
                    \/                      # Slash before Id
                    ([0-9]+)                # $1: VIDEO_ID is numeric
                    [^\s]*                  # Not a space
                )                           # End group
                "?                          # Match end quote if part of src
                (?:[^>]*></iframe>)?        # Match the end of the iframe
                (?:<p>.*</p>)?              # Match any title information stuff
                ~ix';

            preg_match($regexstr, $video_resource, $matches);
            
            $video_code = 'https://player.vimeo.com/video/'.$matches[1];
        }
        
        return $video_code;
    }
}
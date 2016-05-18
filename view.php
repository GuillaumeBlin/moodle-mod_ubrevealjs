<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Prints a particular instance of ubrevealjs
 *
 * @package    mod_ubrevealjs
 * @copyright  2016 Guillaume Blin
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');


$id = optional_param('id', 0, PARAM_INT); // Course_module ID, or
$n  = optional_param('u', 0, PARAM_INT);  // ... ubrevealjs instance ID - it should be named as the first character of the module.

if ($id) {
    $cm         = get_coursemodule_from_id('ubrevealjs', $id, 0, false, MUST_EXIST);
    $course     = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $ubrevealjs  = $DB->get_record('ubrevealjs', array('id' => $cm->instance), '*', MUST_EXIST);
} else if ($n) {
    $ubrevealjs  = $DB->get_record('ubrevealjs', array('id' => $n), '*', MUST_EXIST);
    $course     = $DB->get_record('course', array('id' => $ubrevealjs->course), '*', MUST_EXIST);
    $cm         = get_coursemodule_from_instance('ubrevealjs', $ubrevealjs->id, $course->id, false, MUST_EXIST);
} else {
    error('You must specify a course_module ID or an instance ID');
}
require_login($course, true, $cm);
$cmfolder     = $DB->get_record('folder', array('course' => $cm->course, 'name' => 'revealjs-data'), '*', IGNORE_MULTIPLE);
$cmf = get_coursemodule_from_instance('folder', $cmfolder->id, $cmfolder->course, true, MUST_EXIST);
$context = context_module::instance($cmf->id);
$ressources_url = $CFG->wwwroot."/pluginfile.php/".$context->id."/mod_folder/content/0/";
// Print the page header.

require_once($CFG->libdir . '/completionlib.php');
$completion = new completion_info($course);
$completion->set_module_viewed($cm);

$event = \mod_ubrevealjs\event\reveal_started::create(array(
    'objectid' => $cm->id,
    'context' => context_module::instance($cm->id),
    'other' => array('name'=>$ubrevealjs->name)
));
$event->trigger();

$revealjs_back_close = '<center><a href="'.$CFG->wwwroot.'/course/view.php?id='.$course->id.'" title="'.get_string('close','ubrevealjs').'"><i class="fa fa-times" aria-hidden="true"></i></a></center>';
?>
<!doctype html>
<html lang="en">

	<head>
		<meta charset="utf-8">

		<title><?php echo $ubrevealjs->name; ?></title>

		<meta name="description" content="...">
		<meta name="author" content="...">

		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<link rel="stylesheet" href="css/reveal.css">
		<link rel="stylesheet" href="css/theme/white.css" id="theme">
		<link href='https://fonts.googleapis.com/css?family=Josefin+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

		<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
		<!-- Printing and PDF exports -->
		<link rel="stylesheet" href="http://cdn.jsdelivr.net/highlight.js/9.3.0/styles/default.min.css">
		<script>
			var link = document.createElement( 'link' );
			link.rel = 'stylesheet';
			link.type = 'text/css';
			link.href = window.location.search.match( /print-pdf/gi ) ? 'css/print/pdf.css' : 'css/print/paper.css';
			document.getElementsByTagName( 'head' )[0].appendChild( link );
		</script>
<style>
.reveal {
  font-family: 'Josefin Sans', sans-serif;
}
.reveal h1,
.reveal h2,
.reveal h3,
.reveal h4,
.reveal h5,
.reveal h6 {
 font-family: 'Josefin Sans', sans-serif;
}
.slides .footer{
  position:absolute;
  bottom: 50%;
  left: -50%;
}
.line { display: block; }
.line.focus { background: white; }
.topbar a:link, a:visited, a:active, a:hover{ text-decoration: none; color:#009DE0;}

</style>
		<!--[if lt IE 9]>
		<script src="lib/js/html5shiv.js"></script>
		<![endif]-->
	</head>

	<body>
<div class="topbar"><?php echo $revealjs_back_close ?> 
</div>
		<div class="reveal">

			<!-- Any section element inside of this container is displayed as a slide -->
			<div class="slides">
				<?php echo str_replace('_ubrevealjs_/', $ressources_url, $ubrevealjs->reveal_div_content); ?>
			</div>
		</div>

		<script src="lib/js/head.min.js"></script>
		<script src="js/reveal.js"></script>
		<script src="js/cookies.js"></script>
		<script>

			// More info https://github.com/hakimel/reveal.js#configuration
			Reveal.initialize(
			<?php 
				if(empty($ubrevealjs->reveal_initialize)){
			?>
				{
				controls: true,
				progress: true,
				history: true,
				center: true,
				autoSlide: 10000,
				transition: 'convex', // none/fade/slide/convex/concave/zoom
				dependencies: [
					{ src: 'lib/js/classList.js', condition: function() { return !document.body.classList; } },
					{ src: 'plugin/highlight/highlight.js', async: true, callback: function() { hljs.initHighlightingOnLoad(); } },
					{ src: 'plugin/zoom-js/zoom.js', async: true }
				]
				}
			<?php
				}else{
					echo str_replace('_ubrevealjs_/', $ressources_url, $ubrevealjs->reveal_initialize);
				} 
			?>
			);
			// Save slide show position on each slide change
            		Reveal.addEventListener( 'slidechanged', function() {
                		docCookies.setItem('<?php echo $cm->id ?>', document.URL, 31536e3); // Save cookies for 1 year
            		});
            		// If a position saved, go to it
            		if(docCookies.hasItem('<?php echo $cm->id ?>'))
            		{
                		window.location.replace(docCookies.getItem('<?php echo $cm->id ?>'));
            		}
		</script>

	</body>
</html>


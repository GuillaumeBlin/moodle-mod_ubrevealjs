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
 * English strings for ubrevealjs
 *
 *
 * @package    mod_ubrevealjs
 * @copyright  2016 Guillaume Blin
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['modulename'] = 'ubrevealjs';
$string['modulenameplural'] = 'ubrevealjs';
$string['modulename_help'] = 'Use the ubrevealjs module to design reveals.js presentation.';
$string['ubrevealjsname'] = 'Presentation title';
$string['eventrevealstarted'] = 'Presentation started';
$string['eventrevealcompleted'] = 'Presentation completed';
$string['donemessage'] = "Congrats ! You can now try the test. Go for it ?";
$string['save'] = 'Save reading';
$string['neverseen']='Never seen';
$string['close'] = 'Back to course';
$string['ubrevealjsdivcontent'] = 'html content of the slides div element.';
$string['ubrevealjsdivcontent_help'] = 'A valid html content of the slides div element. 
<pre>
<section data-background="rgba(255, 255, 255, 0.98)">
	<h1>Avant propos</h1>
	<h3>UE Initiation à la Programmation C sous Unix</h3>
	<p><a href="mailto:uf-info.ue.init-prog-c@diff.u-bordeaux.fr">uf-info.ue.init-prog-c@diff.u-bordeaux.fr</a></p>
	<video data-autoplay src="./sample-informative-speech-caffeine.mp3"></video>
</section>
<section data-background="rgba(255, 255, 255, 0.98)" data-autoslide="2000">
	<h3>Pourquoi le C ?</h3>
	<img class="stretch"  data-src="./TIOBE.png" alt="TIOBE">
	<ul>
		<li class="fragment" data-autoslide="2000">Indicateur de popularité des langages de programmation
	</ul>
</section>
</pre>';
$string['ubrevealjsinitialize'] = 'javascript content of the Reveal.initialize  function..';
$string['ubrevealjsinitialize_help'] = 'A valid javascript object. 
<pre>
{
	controls: true,
	progress: true,
	history: true,
	center: true,
	autoSlide: 10000,
	transition: \'convex\', // none/fade/slide/convex/concave/zoom
	// More info https://github.com/hakimel/reveal.js#dependencies
	dependencies: [
		{ src: \'lib/js/classList.js\', condition: function() { return !document.body.classList; } },
		{ src: \'plugin/highlight/highlight.js\', async: true, callback: function() { hljs.initHighlightingOnLoad(); } },
		{ src: \'plugin/reveal-code-focus/reveal-code-focus.js\', async: true, callback: function() { RevealCodeFocus(); } },
		{ src: \'plugin/zoom-js/zoom.js\', async: true },
		{ src: \'plugin/notes/notes.js\', async: true }
	]
}
</pre>';
$string['ubrevealjs'] = 'ubrevealjs';
$string['pluginadministration'] = 'Circuits administration';
$string['pluginname'] = 'ubrevealjs';

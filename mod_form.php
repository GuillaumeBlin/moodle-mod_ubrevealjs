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
 * The main ubrevealjs configuration form
 *
 * It uses the standard core Moodle formslib. For more info about them, please
 * visit: http://docs.moodle.org/en/Development:lib/formslib.php
 *
 * @package    mod_ubrevealjs
 * @copyright  2016 Guillaume Blin
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/course/moodleform_mod.php');

/**
 * Module instance settings form
 *
 * @package    mod_ubrevealjs
 * @copyright  2016 Guillaume Blin
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_ubrevealjs_mod_form extends moodleform_mod {

    /**
     * Defines forms elements
     */
    public function definition() {
        global $DB, $CFG;

        $mform = $this->_form;

        $mform->addElement('header', 'general', get_string('general', 'form'));

        $mform->addElement('text', 'name', get_string('ubrevealjsname', 'ubrevealjs'), array('size' => '64'));
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEANHTML);
        }
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        //$mform->addHelpButton('name', 'ubrevealjsname', 'ubrevealjs');

        if ($CFG->branch >= 29) {
            $this->standard_intro_elements();
        } else {
            $this->add_intro_editor();
        }
	$id = optional_param('update',-1, PARAM_INT);
	$course = $DB->get_record('course_modules', array('id'=> $id));
	$ubr=$DB->get_record('ubrevealjs', array('id'=> $course->instance));

//	$mform->addElement('editor', 'reveal_div_content', get_string('ubrevealjsdivcontent', 'ubrevealjs'))->setValue( array('text' => $ubr->reveal_div_content) );
//	$mform->setType('reveal_div_content', PARAM_RAW);
$mform->addElement('textarea', 'reveal_div_content', get_string('ubrevealjsdivcontent', 'ubrevealjs'),'wrap="virtual" rows="50" cols="100"');
	$mform->addHelpButton('reveal_div_content', 'ubrevealjsdivcontent', 'ubrevealjs');

	$mform->addElement('textarea', 'reveal_initialize', get_string('ubrevealjsinitialize', 'ubrevealjs'),'wrap="virtual" rows="20" cols="100"');
        $mform->addHelpButton('reveal_initialize', 'ubrevealjsinitialize', 'ubrevealjs');
        // Add standard elements, common to all modules.
        $this->standard_coursemodule_elements();

        // Add standard buttons, common to all modules.
        $this->add_action_buttons();
    }
}

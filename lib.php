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
 * Library of interface functions and constants for module ubrevealjs
 *
 * @package    mod_ubrevealjs
 * @copyright  2016 Guillaume Blin
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/* Moodle core API */

/**
 * Returns the information on whether the module supports a feature
 *
 * See {@link plugin_supports()} for more info.
 *
 * @param string $feature FEATURE_xx constant for requested feature
 * @return mixed true if the feature is supported, null if unknown
 */
function ubrevealjs_supports($feature) {

    switch($feature) {
        case FEATURE_MOD_INTRO:
            return true;
        case FEATURE_SHOW_DESCRIPTION:
            return true;
	case FEATURE_COMPLETION_TRACKS_VIEWS: 
	    return true;
//        case FEATURE_GRADE_HAS_GRADE:
//            return true;
        case FEATURE_BACKUP_MOODLE2:
            return true;
        default:
            return null;
    }
}

/**
 * Saves a new instance of the ubrevealjs into the database
 *
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will create a new instance and return the id number
 * of the new instance.
 *
 * @param stdClass $ubrevealjs Submitted data from the form in mod_form.php
 * @param mod_ubrevealjs_mod_form $mform The form instance itself (if needed)
 * @return int The id of the newly inserted ubrevealjs record
 */
function ubrevealjs_add_instance(stdClass $ubrevealjs, mod_ubrevealjs_mod_form $mform = null) {
    global $DB;

    	$ubrevealjs->timecreated 	= time();
	$ubrevealjs->reveal_div_content = $mform->get_data()->reveal_div_content;//['text'];
	$ubrevealjs->reveal_initialize 	= $mform->get_data()->reveal_initialize;//['text'];	
  	$ubrevealjs->id           	= $DB->insert_record('ubrevealjs', $ubrevealjs);
	return $ubrevealjs->id;
}

/**
 * Updates an instance of the ubrevealjs in the database
 *
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will update an existing instance with new data.
 *
 * @param stdClass $ubrevealjs An object from the form in mod_form.php
 * @param mod_ubrevealjs_mod_form $mform The form instance itself (if needed)
 * @return boolean Success/Fail
 */
function ubrevealjs_update_instance(stdClass $ubrevealjs, mod_ubrevealjs_mod_form $mform = null) {
    global $DB;

    	$ubrevealjs->timemodified 	= time();
    	$ubrevealjs->id			= $ubrevealjs->instance;
	$ubrevealjs->reveal_div_content = $mform->get_data()->reveal_div_content;//['text'];
        $ubrevealjs->reveal_initialize  = $mform->get_data()->reveal_initialize;//['text'];
	$result 			= $DB->update_record('ubrevealjs', $ubrevealjs);
    	return $result;
}

/**
 * Removes an instance of the ubrevealjs from the database
 *
 * Given an ID of an instance of this module,
 * this function will permanently delete the instance
 * and any data that depends on it.
 *
 * @param int $id Id of the module instance
 * @return boolean Success/Failure
 */
function ubrevealjs_delete_instance($id) {
    global $DB;

    if (! $ubrevealjs = $DB->get_record('ubrevealjs', array('id' => $id))) {
        return false;
    }
    // Delete any dependent records here.
    $DB->delete_records('ubrevealjs', array('id' => $ubrevealjs->id));
    return true;
}

/**
 * List of view style log actions
 * @return array
 */
function ubrevealjs_get_view_actions() {
    return array('view','view all');
}


/**
 * List of update style log actions
 * @return array
 */
function ubrevealjs_get_post_actions() {
    return array('update', 'add');
}

/**
 * Return use outline
 * @param object $course
 * @param object $user
 * @param object $mod
 * @param object $revealjs
 * @return object|null
 */
function ubrevealjs_user_outline($course, $user, $mod, $ubrevealjs) {
    global $DB;
    if ($logs = $DB->get_records('log', array('userid'=>$user->id, 'module'=>'ubrevealjs', 'action'=>'view', 'info'=>$ubrevealjs->id), 'time ASC')) {
        $numviews = count($logs);
        $lastlog = array_pop($logs);
        $result = new stdClass();
        $result->info = get_string('numviews', '', $numviews);
        $result->time = $lastlog->time;
        return $result;
    }
    return NULL;
}
/**
 * Return use complete
 * @param object $course
 * @param object $user
 * @param object $mod
 * @param object $revealjs
 */
function ubrevealjs_user_complete($course, $user, $mod, $ubrevealjs) {
    global $CFG, $DB;
    if ($logs = $DB->get_records('log', array('userid'=>$user->id, 'module'=>'ubrevealjs', 'action'=>'view', 'info'=>$ubrevealjs->id), 'time ASC')) {
        $numviews = count($logs);
        $lastlog = array_pop($logs);
        $strmostrecently = get_string('mostrecently');
        $strnumviews = get_string('numviews', '', $numviews);
        echo "$strnumviews - $strmostrecently ".userdate($lastlog->time);
    } else {
        print_string('neverseen', 'ubrevealjs');
    }
}

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
 * The revealcompleted event.
 *
 * @package   ubrevealjs 
 * @copyright  2016 Guillaume Blin
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_ubrevealjs\event;
defined('MOODLE_INTERNAL') || die();
/**
 * The revealcompleted event class.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - PUT INFO HERE
 * }
 *
 * @copyright 2014 YOUR NAME
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 **/
class reveal_completed extends \core\event\base {
    protected function init() {
        $this->data['crud'] = 'r'; // c(reate), r(ead), u(pdate), d(elete)
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
        $this->data['objecttable'] = 'ubrevealjs';
    }
 
    public static function get_name() {
        return get_string('eventrevealcompleted', 'mod_ubrevealjs');
    }
 
    public function get_description() {
        return "The user with id {$this->userid} completed ubrevealjs presentation with id {$this->objectid} : {$this->other['name']}.";
    }
 
    public function get_url() {
        return null;//new \moodle_url('....', array('parameter' => 'value', ...));
    }
 
}

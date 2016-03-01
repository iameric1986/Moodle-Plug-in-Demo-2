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
 * The form used by 'feedback_ec10'
 *
 * @package     local
 * @subpackage  demo_plug-in
 * @copyright   Eric Cheng ec10@ualberta.ca
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once '../../config.php';
require_once $CFG->dirroot.'/lib/formslib.php';
require_once $CFG->dirroot.'/lib/datalib.php';

class sample_form extends moodleform {
	function definition() {
		//Add all your form elements here
		global $CFG, $DB, $USER; //Declare our globals for use
		$mform = $this->_form; //Tell this object to initialize with the properties of the Moodle form.
		$mform->addElement('header', 'food', get_string('food_heading', 'local_demo'));
		$selection = array();
		$selection[0] = '';
		$selection[1] = get_string('food1', 'local_demo');
		$selection[2] = get_string('food2', 'local_demo');
		$selection[3] = get_string('food3', 'local_demo');
		$select = array();
		$select[] = $mform->createElement('select', 'food_select', get_string('favoritefood', 'local_demo'), $selection);
		$select[] = $mform->createElement('submit', 'food_submit', get_string('food_selected', 'local_demo'));
		$mform->addElement('group', 'food_selector', get_string('food_section', 'local_demo'), $select, array(' '), false);

		//Checkboxes (not taught in lab)
		$mform->addElement('header', 'drink', get_string('drink_header', 'local_demo')); // Use headers to separate each section of your form to make it look cleaner
		$mform->setExpanded('drink', false); // This method will set the header to be collapsed on creation.  By default, a header is expanded.
		
		// Each advance checkbox is an independant element that can be grouped.
		// The argument: array('group'=>0), array(0,1) is used to identify the advance checkbox grouping as index ZERO, and that this checkbox has a value of 0 with a display
		// string of "drink1" being injected.  This allows you to group and include multiple independent groupings of checkboxes with separate controllers.
		$mform->addElement('advcheckbox', 'checkbox_group', null, get_string('drink1', 'local_demo'), array('group'=>0), array(0,0));
		
		// You can add more checkboxes to this grouping of check boxes, by passing the array('group'=>0, array(0,<n>)) argument.
		$mform->addElement('advcheckbox', 'checkbox_group', null, get_string('drink2', 'local_demo'), array('group'=>0), array(0,1));
		$mform->addElement('advcheckbox', 'checkbox_group', null, get_string('drink3', 'local_demo'), array('group'=>0), array(0,2));
		
		// This add a controller element for the checkbox group ZERO.  The controller will allow users to easily select/unselect all.
		$this->add_checkbox_controller(0);

		// We need to add buttons in order to submit or cancel our checkboxes/entire form.
		$submitall = array();
		$submitall[] = $mform->createElement('submit', 'submit_all', get_string('select_all', 'local_demo')); // The $data will be labelled 'submit_all' when posted
		$submitall[] = $mform->createElement('cancel');
		$mform->addGroup($submitall, 'submission', '', array(' '), false);

	}
	
	//If you need to validate your form information, you can override  the parent's validation method and write your own.	
	//function validation($data, $files) {
	//	$errors = parent::validation($data, $files);
	//	global $DB, $CFG, $USER; //Declare them if you need them

		//if ($data['data_name'] Some condition here)  {
		//	$errors['element_to_display_error'] = get_string('error', 'local_demo_plug-in');
	//}
}

?>


<?php
	/* Activate activity completion */
	$id=$_POST["cmid"];
	require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
	require_once(dirname(__FILE__).'/lib.php');

	if ($id) {
	    $cm         = get_coursemodule_from_id('ubrevealjs', $id, 0, false, MUST_EXIST);
	    $course     = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
	    $ubrevealjs  = $DB->get_record('ubrevealjs', array('id' => $cm->instance), '*', MUST_EXIST);
	} else {
	    error('You must specify a course_module ID or an instance ID');
	}

	require_login($course, true, $cm);
	$i=substr_count($ubrevealjs->reveal_div_content, '<section')-2;
	$j=$i+1;
	if((strcmp($_COOKIE[$id],$CFG->wwwroot.'/mod/ubrevealjs/view.php?id='.$id."#/".$i)!==0)&&(strcmp($_COOKIE[$id],$CFG->wwwroot.'/mod/ubrevealjs/view.php?id='.$id."#/".$j)!==0)){
		setcookie($id,"");	
		http_response_code(400);
	}
	//setcookie($id,"");	
	require_once($CFG->libdir . '/completionlib.php');
	$completion = new completion_info($course);
	$completion->set_module_viewed($cm);
	$event = \mod_ubrevealjs\event\reveal_completed::create(array(
    		'objectid' => $cm->id,
	        'context' => context_module::instance($cm->id),
	        'other' => array('name'=>$ubrevealjs->name)
	));
	$event->trigger();
?>

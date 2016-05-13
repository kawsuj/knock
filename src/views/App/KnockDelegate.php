<?php

namespace App;

use Knock\KnockServices;

/**
 * This class allows you to override any methods from the Knock\KnockServices trait which is used 
 * by the Knock Facade to perform basic queries on the Knoc framework. You're free to 
 * explore this trait and override any methods you wish to tweak. For example, you may 
 * wish to override isKnockUser() to provide a different query to determine whether the 
 * authenticated user is authorised to use Knock - (see commented code below which is only an example). 
 * 
 * NOTE: please note that publishing all Knock assets using --force will overwrite 
 * this file and you will lose additions you ma have made to it. 
 * @author Kawsu
 *
 */
class KnockDelegate {
	use KnockServices;
	
	/*
	//Sample code to check that the authenticated user is allowed into Knock modules
	public function isKnockUser(){
		return $this->hasTag('knock', 'permission-administrator');
	}
	*/
	
}



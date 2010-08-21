<?php
class UserLevelComponent extends Object {

	var $components = array('Session');

	/*
	 * Various messages
	 */
    var $authError = "You are logged in but you do not have permission to view this page.";
    var $loginError = "You must log in to view this page.";

	/*
	 * Capture the controller we are called from
	 */
	function initialize(&$controller, $settings = array()) {
		$this->controller =& $controller;
	}

	/*
	 * Checks to see if the user has at least the
	 * required numerical access level.  If not,
	 * it redirects them to the login page.
	 */
    function requireLevel($level) {
        // user isn't logged in!
		if($this->Session->check('User.level') === false) {
			$this->Session->write('Auth.redirect',
				$this->controller->here);
			$this->controller->redirect(array(
				'controller'=>'users',
                'action'=>'login'));
            $this->Session->setFlash($this->loginError);
        }

		$userLevel = $this->Session->read('User.level');
		// access denied!
		if($userLevel < $level) {
			$this->Session->write('Auth.redirect',
				$this->controller->here);
			$this->controller->redirect(array(
				'controller'=>'users',
				'action'=>'login'));
            $this->Session->setFlash($this->authError);
        }

        return true;
    }

    /*
     * Returns the user's level if the user is logged in.
     * Otherwise, returns boolean FALSE.
     */
    function getLevel() {
        if($this->Session->check('User.level') === false) {
            return false;
        }
        else {
            return $this->Session->read('User.level');
        }
    }
}

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
            $this->Session->setFlash($this->loginError);
			$this->controller->redirect(array(
				'controller'=>'users',
                'action'=>'login'));
        }

		$userLevel = $this->Session->read('User.level');
		// access denied!
		if($userLevel < $level) {
			$this->Session->write('Auth.redirect',
				$this->controller->here);
            $this->Session->setFlash($this->authError);
			$this->controller->redirect(array(
				'controller'=>'users',
				'action'=>'login'));
        }

        return true;
	}

	/*
	 * Checks to see if the user's ID is as specified,
	 * and shows login/auth errors are necessary. Returns
	 * true if the user passed, and false if not.
	 */
	function requireUser($user) {
        // user isn't logged in!
		if($this->Session->check('User.id') === false) {
			$this->Session->write('Auth.redirect',
				$this->controller->here);
			$this->Session->setFlash($this->loginError);
			$this->controller->redirect(array(
				'controller'=>'users',
                'action'=>'login'));
			return false;
        }

		$userId = $this->Session->read('User.id');
		// access denied!
		if($userId != $user) {
			$this->Session->write('Auth.redirect',
				$this->controller->here);
			$this->Session->setFlash($this->authError);
			$this->controller->redirect(array(
				'controller'=>'users',
				'action'=>'login'));
			return false;
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

	/*
	 * Returns the user's id, false if not logged in
	 */
	function getUser() {
        if($this->Session->check('User.id') === false) {
            return false;
        }
        else {
            return $this->Session->read('User.id');
		}
	}
}

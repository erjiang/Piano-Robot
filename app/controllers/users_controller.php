<?php
class UsersController extends AppController {

	var $name = 'Users';

	function index() {
		$this->UserLevel->requireLevel(10);
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->UserLevel->requireUser($id);
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			/*
			 *  SHA1 password
			 */
			$this->data['User']['password'] =
				sha1(
					$this->data['User']['password'] .
					Configure::read('Security.salt'));

			/*
			 * Don't let random people set their own userlevels
			 */
			if($this->UserLevel->getLevel() === false ||
				$this->UserLevel->getLevel() < 10) {
					$this->data['User']['level'] = 1;
			}

			/*
			 * Set the creation date
			 */
			$this->data['User']['created'] = date('Y-m-d H:i:s');

			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
	}

	function login() {
		if(!empty($this->data)) {
			$successful = false;

			$found = $this->User->find('first', array(
				'conditions' => array('User.name' => $this->data['User']['name'])));
			if($found) {
				if(sha1($this->data['User']['password'] .
					Configure::read('Security.salt')) ==
					$found['User']['password']) {
						$successful = true;

						/*
						 * Write the user's last active time
						 */
						$found['User']['last_active'] = date('Y-m-d H:i:s');
						$this->User->save($found);

						/*
						 * Write the user's access information to Session
						 */
						$this->Session->write('User.id', $found['User']['id']);
						$this->Session->write('User.level', $found['User']['level']);
						$this->Session->write('User.name', $found['User']['name']);

						/*
						 * Possibly redirect to the page the user last
						 * attempted to access
						 */
						if($this->Session->check('Auth.redirect')) {
							$this->flash("Welcome, ".$found['User']['name'].".",
								$this->Session->read('Auth.redirect'));
							$this->Session->delete('Auth');
						}
						else {
							$this->flash("Welcome, ".$found['User']['name'].".",
								'/books/', 3/*seconds*/);
						}
					}
			}
			if(!$successful) {
				$this->Session->setFlash("Invalid username or password.");
			}
		}
	}

	function logout() {
		$this->Session->delete('User');
		$this->Session->setFlash('You have been logged out.');
		$this->redirect('/');
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			// SHA1 password
			$this->data['User']['password'] =
				sha1(
					$this->data['User']['password'] .
					Configure::read('Security.salt'));
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>

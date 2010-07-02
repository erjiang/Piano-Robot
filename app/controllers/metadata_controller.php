<?php
class MetadataController extends AppController {

	var $name = 'Metadata';

	function index() {
		$this->Metadatum->recursive = 0;
		$this->set('metadata', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid metadatum', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('metadatum', $this->Metadatum->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Metadatum->create();
			if ($this->Metadatum->save($this->data)) {
				$this->Session->setFlash(__('The metadatum has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The metadatum could not be saved. Please, try again.', true));
			}
		}
		$scores = $this->Metadatum->Score->find('list');
		$this->set(compact('scores'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid metadatum', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Metadatum->save($this->data)) {
				$this->Session->setFlash(__('The metadatum has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The metadatum could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Metadatum->read(null, $id);
		}
		$scores = $this->Metadatum->Score->find('list');
		$this->set(compact('scores'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for metadatum', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Metadatum->delete($id)) {
			$this->Session->setFlash(__('Metadatum deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Metadatum was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Metadatum->recursive = 0;
		$this->set('metadata', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid metadatum', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('metadatum', $this->Metadatum->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Metadatum->create();
			if ($this->Metadatum->save($this->data)) {
				$this->Session->setFlash(__('The metadatum has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The metadatum could not be saved. Please, try again.', true));
			}
		}
		$scores = $this->Metadatum->Score->find('list');
		$this->set(compact('scores'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid metadatum', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Metadatum->save($this->data)) {
				$this->Session->setFlash(__('The metadatum has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The metadatum could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Metadatum->read(null, $id);
		}
		$scores = $this->Metadatum->Score->find('list');
		$this->set(compact('scores'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for metadatum', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Metadatum->delete($id)) {
			$this->Session->setFlash(__('Metadatum deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Metadatum was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
<?php
class PiecesController extends AppController {

	var $name = 'Pieces';

	function index() {
		$this->Piece->recursive = 0;
		$this->set('pieces', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid piece', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('piece', $this->Piece->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Piece->create();
			if ($this->Piece->save($this->data)) {
				$this->Session->setFlash(__('The piece has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The piece could not be saved. Please, try again.', true));
			}
		}
		$books = $this->Piece->Book->find('list');
		$this->set(compact('books'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid piece', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Piece->save($this->data)) {
				$this->Session->setFlash(__('The piece has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The piece could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Piece->read(null, $id);
		}
		$books = $this->Piece->Book->find('list');
		$this->set(compact('books'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for piece', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Piece->delete($id)) {
			$this->Session->setFlash(__('Piece deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Piece was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
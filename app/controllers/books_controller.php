<?php
class BooksController extends AppController {

	var $name = 'Books';

	function index() {
		$this->Book->recursive = 0;
		$this->set('books', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid book', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('book', $this->Book->read(null, $id));
	}
	function read($id = null) {
		if(!$id) {
			$this->Session->setFlash(__('Invalid book', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('book', $this->Book->read(null, $id));
	}
	function page($id = null, $page = null, $height = null) {
		$this->layout = 'image';
		if (!$id) {
			$this->Session->setFlash(__('Invalid book', true));
			$this->redirect(array('action' => 'index'));
			return;
		}
		if (!$page) {
			$this->Session->setFlash(__('No page specified', true));
			$this->redirect(array('action' => 'index'));
			return;
		}
		$book =  $this->Book->read(null, $id);
		if($page > $book['Book']['length'] || $page < 0) {
			$this->Session->setFlash(__('Invalid page number', true));
			$this->redirect(array('action' => 'index'));
			return;
		}

		$this->set('book', $book);
		$this->set('page', $page);
		$this->set('height', $height);
	}

	function pageheader($id = null, $page = null, $width = null, $height = null) {
		$this->layout = 'image';
		if (!$id) {
			$this->Session->setFlash(__('Invalid book', true));
			$this->redirect(array('action' => 'index'));
			return;
		}
		if (!$page) {
			$this->Session->setFlash(__('No page specified', true));
			$this->redirect(array('action' => 'index'));
			return;
		}
		$book =  $this->Book->read(null, $id);
		if($page > $book['Book']['length'] || $page < 0) {
			$this->Session->setFlash(__('Invalid page number', true));
			$this->redirect(array('action' => 'index'));
			return;
		}

		$this->set('book', $book);
		$this->set('page', $page);
		$this->set('width', $width);
		$this->set('height', $height);
	}

	function add() {
		if (!empty($this->data)) {
			/*
			 * Array
             * (
             *     [Book] => Array
             *         (
             *             [title] => eou
             *             [editor] => oeuaoeu
             *             [publisher] => aoeuaoeu
             *             [access] => 
             *             [pdf] => Array
             *                 (
             *                     [name] => schema__1_.pdf
             *                     [type] => application/pdf
             *                     [tmp_name] => /tmp/php5DNmT0
             *                     [error] => 0
             *                     [size] => 67506
             *                 )
             *         )
			 * )
			echo '<pre>';
			echo APP . "\n";
			print_r($this->data);
			echo '</pre>';
			 */
			/*
			 * Some basic sanity checks on the input
			 */
			if($this->data['Book']['pdf']['size'] == 0) {
				$this->Session->setFlash(__('No PDF was uploaded', true));
				return;
			}
			if($this->data['Book']['pdf']['type'] != "application/pdf") {
				$this->Session->setFlash(__('Uploaded file is not a PDF', true));
				return;
			}
			/*
			 * The full filename of the PDF shall be built using its md5sum
			 * If the file's md5sum is a1b2c3, then its path is
			 *     PDF_STORE/a/a1b2c3.pdf
			 */
			$md5sum = md5_file($this->data['Book']['pdf']['tmp_name']);
			$initial = substr($md5sum, 0, 1);
			// do a page count
			exec('identify '.$this->data['Book']['pdf']['tmp_name'], $output);
			$this->data['Book']['length'] = count($output);
			$fullname = sprintf('%s%s/%s.pdf', PDF_STORE, $initial, $md5sum);
			if(file_exists(PDF_STORE . $initial . '/' . $md5sum . '.pdf')) {
				$this->Session->setFlash(__('This file already exists', true));
				return;
			}

			$this->data['Book']['filename'] = $md5sum;
			$this->Book->create();
			if ($this->Book->save($this->data)) {
				/*
				 * If the Book save was successful, process the PDF file as well
				 */
				if(!file_exists(PDF_STORE . $initial)) {
					mkdir(PDF_STORE . $initial);
				}
				rename($this->data['Book']['pdf']['tmp_name'], $fullname);
				/*
				 * Push the user on to define scores within the book
				 */
				$this->Session->setFlash(__('The book has been saved', true));
				$this->redirect(array('action' => 'define'));
			} else {
				$this->Session->setFlash(__('The book could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid book', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Book->save($this->data)) {
				$this->Session->setFlash(__('The book has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The book could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Book->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for book', true));
			$this->redirect(array('action'=>'index'));
		}
		$book = $this->Book->read(null, $id);
		$md5sum = $book['Book']['filename'];
		$initial = substr($md5sum, 0, 1);
		if ($this->Book->delete($id)) {
			unlink(sprintf("%s%s/%s.pdf", PDF_STORE, $initial, $md5sum));
			$this->Session->setFlash(__('Book deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Book was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Book->recursive = 0;
		$this->set('books', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid book', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('book', $this->Book->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Book->create();
			if ($this->Book->save($this->data)) {
				$this->Session->setFlash(__('The book has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The book could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid book', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Book->save($this->data)) {
				$this->Session->setFlash(__('The book has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The book could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Book->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for book', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Book->delete($id)) {
			$this->Session->setFlash(__('Book deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Book was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>

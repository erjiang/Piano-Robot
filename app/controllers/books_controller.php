<?php
class BooksController extends AppController {

	var $name = 'Books';
	var $helpers = array('Html', 'Form');

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
		$this->layout = 'reading';
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
				echo 'No PDF was uploaded';
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
			$this->data['Book']['length'] = 
				$this->countPDF($this->data['Book']['pdf']['tmp_name']);
			$fullname = sprintf('%s%s/%s.pdf', PDF_STORE, $initial, $md5sum);

			// it doesn't matter if the file already exists, but if the
			// database entry exists
			//if(file_exists(PDF_STORE . $initial . '/' . $md5sum . '.pdf')) {
			if($this->Book->find('count', array(
				'conditions' => array('filename' => $md5sum))) == 1) {
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
				$this->redirect(array('action' => 'add'));
			} else {
				echo 'Some kind of error';
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

	/*
	 * Let's not use `identify` to count PDFs because it has to
	 * make ghostscript crunch through the whole PDF (CPU-intensive)
	 *
	 * Try the pure-PHP solution first, and if it returns 0, then try
	 * using identify.
	 */
	public function countPDF($file) {
		$pages = $this->countPDFMatch($file);
		return ($pages < 2) ? $this->countPDFIdentify($file) : $pages;
	}

    public function countPDFMatch($file) {
        $handle = fopen($file, 'r');
        $maximum = 0;
        while(!feof($handle)) {
            $buffer = fgets($handle);
            if(preg_match_all('#/Count (\d+)#', $buffer, $arr) > 0) {
                foreach($arr[1] as $match) {
                    if($match > $maximum) {
                        $maximum = $match;
                    }
                }
            }
        }
        return $maximum;
    }
	
	public function countPDFIdentify($file) {
		exec('identify '.$this->data['Book']['pdf']['tmp_name'], $output);
		return count($output);
	}

	public function countPDFPHP($file) {
		//where $file is the full path to your PDF document.
		if(file_exists($file)) {
			//open the file for reading
			if($handle = @fopen($file, "rb")) {
				$count = 0;
				$i=0;
				while (!feof($handle)) {
					if($i > 0) {
						$contents .= fread($handle,8152);
					}
					else {
						$contents = fread($handle, 1000);
						//In some pdf files, there is an N tag containing the number of
						//of pages. This doesn't seem to be a result of the PDF version.
						//Saves reading the whole file.
						if(preg_match("/\/N\s+([0-9]+)/", $contents, $found)) {
							return $found[1];
						}
					}
					$i++;
				}
				fclose($handle);

				//get all the trees with 'pages' and 'count'. the biggest number
				//is the total number of pages, if we couldn't find the /N switch above.                
				if(preg_match_all("/\/Type\s*\/Pages\s*.*\s*\/Count\s+([0-9]+)/", $contents, $capture, PREG_SET_ORDER)) {
					foreach($capture as $c) {
						if($c[1] > $count)
							$count = $c[1];
					}
					return $count;            
				}
			}
		}
		return 0;

	}
}
?>

<?php
class BookMetadatum extends AppModel {
	var $name = 'BookMetadatum';
	var $displayField = 'key';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Book' => array(
			'className' => 'Book',
			'foreignKey' => 'book_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>
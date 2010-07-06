<?php
class Piece extends AppModel {
	var $name = 'Piece';
	var $displayField = 'title';
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

	var $hasMany = array(
		'PieceMetadatum' => array(
			'className' => 'PieceMetadatum',
			'foreignKey' => 'piece_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>
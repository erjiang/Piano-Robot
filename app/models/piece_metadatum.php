<?php
class PieceMetadatum extends AppModel {
	var $name = 'PieceMetadatum';
	var $displayField = 'key';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Piece' => array(
			'className' => 'Piece',
			'foreignKey' => 'piece_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>
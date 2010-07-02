<?php
class Metadatum extends AppModel {
	var $name = 'Metadatum';
	var $displayField = 'key';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Score' => array(
			'className' => 'Score',
			'foreignKey' => 'score_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>
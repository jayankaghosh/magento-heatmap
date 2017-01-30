<?php

class Codilar_Heatmap_Model_Resource_Tracker extends Mage_Core_Model_Resource_Db_Abstract{
	public function _construct(){
		$this->_init("codilar_heatmap/tracker",'id');
	}
}
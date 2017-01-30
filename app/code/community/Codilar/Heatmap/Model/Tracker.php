<?php

class Codilar_Heatmap_Model_Tracker extends Mage_Core_Model_Abstract{
	public function _construct(){
		parent::_construct();
		$this->_init('codilar_heatmap/tracker');
	}


	public function getScreenSizes(){
		$collection = $this->getCollection()->addFieldToSelect('screen_size');
		$collection->getSelect()->group('screen_size');
		$screenSizeArr = array();
		foreach ($collection as $item) {
			$screenSize = Mage::helper('core')->jsonDecode($item->getScreenSize());
			$screenSizeArr[$item->getScreenSize()] = $screenSize[0]."x".$screenSize[1]."px";
		}
		return $screenSizeArr;
	}
}
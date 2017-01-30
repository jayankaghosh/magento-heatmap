<?php

class Codilar_Heatmap_Block_Track extends Mage_Core_Block_Template{

	public function isEnabled(){
		if(Mage::getStoreConfig('codilar_heatmap_config/tracker/power') == 1){
			return true;
		}
		return false;
	}

	public function autoStop(){
		if(Mage::getStoreConfig('codilar_heatmap_config/viewer/power') == 1 && $this->autoStopEnabled()){
			return true;
		}
		return false;
	}

	public function autoStopEnabled(){
		return Mage::getStoreConfig('codilar_heatmap_config/tracker/autostop') == 1;
	}

	public function cleanUpEnabled(){
		if(Mage::getStoreConfig('codilar_heatmap_config/tracker/cleanup') == 1){
			return true;
		}
		return false;
	}

	public function getOverflowLimit(){
		return Mage::getStoreConfig('codilar_heatmap_config/tracker/overflow_limit');
	}

	public function getThreshold(){
		return Mage::getStoreConfig('codilar_heatmap_config/tracker/threshold');
	}

	public function getCurrentUri(){
		$urlString = Mage::helper('core/url')->getCurrentUrl();
		$url = Mage::getSingleton('core/url')->parseUrl($urlString);
		$path = $url->getPath();
		return $path;
	}

	public function getPostUrl(){
		return Mage::getUrl('heatmap/tracker/submit');
	}

}
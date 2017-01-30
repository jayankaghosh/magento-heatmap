<?php

class Codilar_Heatmap_Block_View extends Mage_Core_Block_Template{

	public function isEnabled(){
		if(Mage::getStoreConfig('codilar_heatmap_config/viewer/power') == 1){
			return true;
		}
		return false;
	}

	public function getMaxLayers(){
		return Mage::getStoreConfig('codilar_heatmap_config/viewer/max_layers');
	}

	public function getCurrentUri(){
		$urlString = Mage::helper('core/url')->getCurrentUrl();
		$url = Mage::getSingleton('core/url')->parseUrl($urlString);
		$path = $url->getPath();
		return $path;
	}

	public function isAllowedIP(){
		$ip = Mage::helper('core/http')->getRemoteAddr();
		$allowedIPs = Mage::getStoreConfig('codilar_heatmap_config/viewer/allowed_ips');
		if(!$allowedIPs || $allowedIPs == ""){
			return true;
		}
		$allowedIPs = explode(',', $allowedIPs);
		foreach ($allowedIPs as $allowedIP) {
			if($ip == $allowedIP){
				return true;
			}
		}
		return false;
	}

	public function getRetrieveUrl(){
		return Mage::getUrl('heatmap/viewer/getCoordinates');
	}

}
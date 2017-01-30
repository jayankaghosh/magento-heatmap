<?php

class Codilar_Heatmap_Adminhtml_HeatmapajaxController extends Mage_Adminhtml_Controller_Action{
	
	private function getMyIP(){
			$ip = Mage::helper('core/http')->getRemoteAddr();
			return $ip;
	}


	public function setMyIpAction(){
		$myIP = $this->getMyIP();
		Mage::getConfig()->saveConfig('codilar_heatmap_config/viewer/allowed_ips', $myIP, 'default', "");
		echo "success";
	}



}
<?php

class Codilar_Heatmap_ViewerController extends Mage_Core_Controller_Front_Action{
	public function getCoordinatesAction(){
		$response = array();
		if(Mage::getStoreConfig('codilar_heatmap_config/viewer/power') == 1){
			$trackerModel = Mage::getModel('codilar_heatmap/tracker');
			$uri = $this->getRequest()->getParam('heatmap_current_uri');
			$uri = urldecode($uri);
			$collection = $trackerModel->getCollection()->addFieldToFilter('uri',$uri)->addFieldToSelect('coordinates');
			$collection = $this->setDateRange($collection);
			$collection = $this->setScreenSizeFilter($collection);
			$collection = $collection->getData();
			$coordinates = array();
			foreach ($collection as $item) {
				$item = Mage::helper('core')->jsonDecode($item['coordinates']);
				foreach ($item as $coordinate) {
					array_push($coordinates, $coordinate);	
				}
			}
			$response['status'] = "success";
			$response['data']	= $coordinates;
		}
		else{
			$response['status']	= "error";
		}
		echo Mage::helper('core')->jsonEncode($response);
	}

	private function setScreenSizeFilter($collection){
		$screenSize = $this->getRequest()->getParam('screen_size');
		if(Mage::getStoreConfig('codilar_heatmap_config/viewer/screen_size') == 1){
			$collection->addFieldToFilter('screen_size', $screenSize);
		}
		return $collection;
	}

	private function setDateRange($collection){
		$fromDate = Mage::getStoreConfig('codilar_heatmap_config/viewer/filter_from');
		$toDate = Mage::getStoreConfig('codilar_heatmap_config/viewer/filter_to');
		if($fromDate && $fromDate != ""){
			$fromDate = date('Y-m-d', strtotime($fromDate));
			$collection->addFieldToFilter('created_at',array('gteq'=>$fromDate));
		}
		if(!$toDate || $toDate == ""){
			$toDate = date('Y-m-d');
		}
		$toDate = date('Y-m-d', strtotime($toDate));
		$collection->addFieldToFilter('created_at',array("lteq" => $toDate));
		return $collection;
	}
}
<?php

class Codilar_Heatmap_TrackerController extends Mage_Core_Controller_Front_Action{
	public function submitAction(){
		$response = array();
		if(Mage::getStoreConfig('codilar_heatmap_config/tracker/power') == 1){
			$trackerModel = Mage::getModel('codilar_heatmap/tracker');
			$createdAt = date('Y-m-d');
			$uri = $this->getRequest()->getParam('heatmap_current_uri');
			$coordinates = $this->getRequest()->getParam('heatmap_data');
			$screen_size = $this->getRequest()->getParam('screen_size');
			$data = array(
				'created_at'	=> $createdAt,
				'uri'			=> $uri,
				'coordinates'	=> $coordinates,
				'screen_size'	=> $screen_size
			);
			$trackerModel->addData($data);
			try{
				if(!$uri || $uri == "" || !$coordinates || $coordinates == "" || !$screen_size || $screen_size == ""){
					throw new Exception("Incomplete data provided");
				}
				$trackerModel->save();
				$response['status']	= "success";				
			}
			catch(Exception $e){
				$response['status'] = "error";
			}
		}
		else{
			$response['status']	= "error";
		}
		echo Mage::helper('core')->jsonEncode($response);
	}
}
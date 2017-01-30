<?php

class Codilar_Heatmap_Adminhtml_HeatmapgridController extends Mage_Adminhtml_Controller_Action{
	public function indexAction(){
		$this->loadLayout();
		$this->_addContent($this->getLayout()->createBlock('codilar_heatmap/adminhtml_data_grid'));
		$this->renderLayout();
	}
	public function massDeleteAction(){
		$ids = $this->getRequest()->getPost('id');
    	foreach ($ids as $id) {
    		Mage::getModel('codilar_heatmap/tracker')->load($id)->delete();
    	}
		Mage::getSingleton('core/session')->addSuccess(count($ids)." heatmap activity(s) deleted successfully!");
		$this->_redirect('*/*');
    }

     public function deleteAction(){
    	$id = $this->getRequest()->getParam('id');
 		Mage::getModel('codilar_heatmap/tracker')->load($id)->delete();
		Mage::getSingleton('core/session')->addSuccess("Data deleted successfully!");
		$this->_redirect('*/*');
    }
}
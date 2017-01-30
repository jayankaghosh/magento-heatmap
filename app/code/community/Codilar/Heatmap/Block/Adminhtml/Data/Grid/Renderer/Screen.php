<?php
class Codilar_Heatmap_Block_Adminhtml_Data_Grid_Renderer_Screen extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row){
    	$screenSize = Mage::helper('core')->jsonDecode($row->getScreenSize());
    	$out = $screenSize[0]."x".$screenSize[1]."px";
    	return $out;
    }
}
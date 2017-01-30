<?php
class Codilar_Heatmap_Block_Adminhtml_Data_Grid extends Mage_Adminhtml_Block_Widget_Grid_Container
{
   public function __construct() {
     //indicate where we can find the controller
     $this->_controller = 'adminhtml_data_grid';
     $this->_blockGroup = 'codilar_heatmap';
     //header text
     $this->_headerText = 'Manage Heatmap Data';
     parent::__construct();

     $this->_removeButton('add');
    }

}
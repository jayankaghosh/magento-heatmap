<?php

class Codilar_Heatmap_Block_Adminhtml_Data_Grid_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('id');
      $this->setDefaultDir('DESC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('codilar_heatmap/tracker')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('id', array(
          'header'    => Mage::helper('codilar_heatmap')->__('ID'),
          'align'     => 'right',
          'width'     => '50px',
          'index'     => 'id',
      ));

      $this->addColumn('created_at', array(
          'header'    => Mage::helper('codilar_heatmap')->__('Created At'),
          'type'      => 'date',
          'align'     => 'left',
          'index'     => 'created_at'
      ));

      $this->addColumn('uri', array(
          'header'    => Mage::helper('codilar_heatmap')->__('URI'),
          'align'     => 'left',
          'index'     => 'uri'
      ));
      
      $this->addColumn('coordinates', array(
          'header'    => Mage::helper('codilar_heatmap')->__('Coordinates [[X axis, Y axis, weight], ...]'),
          'align'     => 'left',
          'index'     => 'coordinates'
      ));
      
      $this->addColumn('screen_size', array(
          'header'    => Mage::helper('codilar_heatmap')->__('Screen Size'),
          'align'     => 'left',
          'index'     => 'screen_size',
          'width'     => '200px',
          'renderer'  => 'Codilar_Heatmap_Block_Adminhtml_Data_Grid_Renderer_Screen',
          'type'      => 'options',
          'options'   => Mage::getModel('codilar_heatmap/tracker')->getScreenSizes()
      ));
                
       
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('id');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('codilar_heatmap')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('codilar_heatmap')->__('Are you sure?')
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return null;//$this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}
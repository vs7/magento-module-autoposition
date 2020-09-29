<?php

class VS7_AutoPosition_Block_Adminhtml_Increment_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('incrementGrid');
        $this->setDefaultSort('manufacturer');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('vs7_autoposition/increment')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header' => Mage::helper('vs7_autoposition')->__('ID'),
            'index' => 'increment_id'
        ));
        $this->addColumn('manufacturer', array(
            'header' => Mage::helper('vs7_autoposition')->__('Manufacturer'),
            'index' => 'manufacturer'
        ));
        $this->addColumn('increment', array(
            'header' => Mage::helper('vs7_autoposition')->__('Increment'),
            'index' => 'increment'
        ));
        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('increment_id' => $row->getId()));
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('increment_id');
        $this->getMassactionBlock()->setIdFieldName('increment_id');
        $this->getMassactionBlock()
            ->addItem('delete',
                array(
                    'label' => Mage::helper('vs7_autoposition')->__('Delete'),
                    'url' => $this->getUrl('*/*/massDelete'),
                    'confirm' => Mage::helper('vs7_autoposition')->__('Are you sure')
                ));
        return $this;
    }
}
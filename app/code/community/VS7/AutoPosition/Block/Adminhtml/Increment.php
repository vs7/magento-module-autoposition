<?php

class VS7_AutoPosition_Block_Adminhtml_Increment extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_increment';
        $this->_blockGroup = 'vs7_autoposition';
        $this->_headerText = Mage::helper('vs7_autoposition')->__('Autoposition Increment Manager');
        $this->_addButtonLabel = Mage::helper('vs7_autoposition')->__('Add Increment');
        parent::__construct();
    }
}
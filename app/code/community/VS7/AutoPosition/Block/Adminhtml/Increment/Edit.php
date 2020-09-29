<?php

class VS7_AutoPosition_Block_Adminhtml_Increment_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_increment';
        $this->_blockGroup = 'vs7_autoposition';
        $this->_objectId = 'increment_id';

        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('vs7_autoposition')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('vs7_autoposition')->__('Delete'));
    }

    public function getHeaderText()
    {
        if (Mage::registry('vs7_autoposition_increment')->getId()) {
            return Mage::helper('vs7_autoposition')->__('Edit Increment Settings');
        } else {
            return Mage::helper('vs7_autoposition')->__('New Increment');
        }
    }
}
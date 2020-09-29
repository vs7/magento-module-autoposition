<?php

class VS7_AutoPosition_Model_Resource_Increment_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('vs7_autoposition/increment');
    }
}
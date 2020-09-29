<?php

class VS7_AutoPosition_Block_Adminhtml_Increment_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('increment_form');
        $this->setTitle(Mage::helper('vs7_autoposition')->__('Increment Info'));
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('vs7_autoposition_increment');

        $form = new Varien_Data_Form(
            array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save', array(
                    'increment_id' => $this->getRequest()->getParam('increment_id'))),
                'method' => 'post'
            )
        );

        $form->setHtmlIdPrefix('increment_');

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend'    => Mage::helper('vs7_autoposition')->__('Increment Info'),
            'class'     => 'fieldset-wide',
        ));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }

        $fieldset->addField('manufacturer', 'text', array(
            'name'      => 'manufacturer',
            'label'     => Mage::helper('vs7_autoposition')->__('Manufacturer'),
            'title'     => Mage::helper('vs7_autoposition')->__('Manufacturer'),
            'required'  => true,
        ));

        $fieldset->addField('increment', 'text', array(
            'name'      => 'increment',
            'label'     => Mage::helper('vs7_autoposition')->__('Increment'),
            'title'     => Mage::helper('vs7_autoposition')->__('Increment'),
            'required'  => true,
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
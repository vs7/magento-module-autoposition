<?php

class VS7_AutoPosition_Adminhtml_IncrementController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('vs7_autoposition/adminhtml_increment'));
        $this->renderLayout();
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('increment_id');
        $model = Mage::getModel('vs7_autoposition/increment')->load($id);

        Mage::register('vs7_autoposition_increment', $model);

        $incrementObject = (array)Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (count($incrementObject)) {
            Mage::registry('vs7_autoposition_increment')->setData($incrementObject);
        }

        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('vs7_autoposition/adminhtml_increment_edit'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function saveAction()
    {
        try {
            $id = $this->getRequest()->getParam('increment_id');
            $model = Mage::getModel('vs7_autoposition/increment')->load($id);

            $model->setData($this->getRequest()->getParams())
                ->save();

            if(!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('vs7_autoposition')->__('Cannot save the model'));
            }
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setIncrementObject($block->getData());
            return $this->_redirect('*/*/edit', array('increment_id' => $this->getRequest()->getParam('increment_id')));
        }

        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('vs7_autoposition')->__('Specify increment was saved'));

        $this->_redirect('*/*/'.$this->getRequest()->getParam('back', 'index'), array('increment_id' => $model->getId()));
    }

    public function deleteAction()
    {
        $model = Mage::getModel('vs7_autoposition/increment')
            ->load($this->getRequest()->getParam('increment_id'))
            ->delete();
        if ($model->getId()) {
            Mage::getSingleton('adminhtml/session')->addSuccess('Specify increment was deleted');
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $ids = $this->getRequest()->getParam('massaction');

        if (!is_array($ids)) {
            $this->_getSession()->addError($this->__('Select increment (s).'));
        } else {
            try {
                foreach ($ids as $id) {
                    $model = Mage::getModel('vs7_autoposition/increment')->load($id);
                    $model->delete();
                }

                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('vs7_autoposition')->__('Total of %d increments(s) have been deleted.', count($ids))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('')->__('An error occurred while deleting items.')
                );
                Mage::logException($e);
                return;
            }
        }
        $this->_redirect('*/*/');
    }
}
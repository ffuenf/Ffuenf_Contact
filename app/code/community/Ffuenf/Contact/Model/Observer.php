<?php
/**
 * Ffuenf_Contact extension.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category   Ffuenf
 *
 * @author     Achim Rosenhagen <a.rosenhagen@ffuenf.de>
 * @copyright  Copyright (c) 2015 ffuenf (http://www.ffuenf.de)
 * @license    http://opensource.org/licenses/mit-license.php MIT License
 */

class Ffuenf_Contact_Model_Observer
{
    /**
    * The indexPostPredispatch observer intercepts the post request object
    * before the post action is called. It then munges the additional reason
    * field into the comment field.
    *
    * @param type $observer
    */
    public function indexPostPredispatch($observer)
    {
        $request = Mage::app()->getRequest();
        $salutation = $request->getPost('salutation');
        $name = $request->getPost('name');
        $lastname = $request->getPost('lastname');
        $street = $request->getPost('street');
        $streetnumber = $request->getPost('streetnumber');
        $zip = $request->getPost('zip');
        $city = $request->getPost('city');
        $telephone = $request->getPost('telephone');
        $message = $request->getPost('message');
        $request->setPost('comment', $message);
    }
  
    /**
    * event: controller_action_layout_render_before_ . $this->getFullActionName();
    * in: Mage_Core_Controller_Varien_Action::renderLayout()
    * 
    * @param $event Varien_Event_Observer
    * @return void
    */
    public function addRobotsTagToContacts(Varien_Event_Observer $event)
    {
        $this->_setRobotsHeader($this->_helper()->getContactsRobots());
        $this->_setCanonicalHeader($this->getUrl('contact'));
        $breadcrumbs = $this->_getLayout()->getBlock('breadcrumbs');
        if ($this->_helper()->getContactsBreadcrumb() && $breadcrumbs) {
            $title = Mage::helper('ffuenf_contact')->__('Contact Us');
            $breadcrumbs->addCrumb('home', array('label'=>Mage::helper('cms')->__('Home'), 'title'=>Mage::helper('cms')->__('Go to Home Page'), 'link'=>Mage::getBaseUrl()));
            $breadcrumbs->addCrumb('cms_page', array('label'=>$title, 'title'=>$title));
        }
    }
    /**
    * 
    * @return Mage_Core_Model_Layout
    */
    protected function _getLayout()
    {
        return Mage::app()->getLayout();
    }
    /**
    * set Robots Tag in Response Header (HTTP/1.1)
    * 
    * @param string $value
    */
    public function _setRobotsHeader($value, $addToHtmlHead = true)
    {
        if (empty($value)) {
            $value = $this->_helper()->getDefaultRobots();
        }
        Mage::app()->getResponse()->setHeader('X-Robots-Tag', $value);
        if ($addToHtmlHead) {
            $this->_getLayout()->getBlock('head')->setData('robots', $value);
        }
        return $this;
    }

    /**
    * 
    * @param string $value url
    * @return Ffuenf_Contact_Model_Observer
    */
    public function _setCanonicalHeader($value, $addToHtmlHead = true)
    {
        if (!empty($value)) {
            $value = str_replace(array('?___SID=U', '&___SID=U'), '', $value);
            $link = '<' . $value . '>; rel="canonical"';
            Mage::app()->getResponse()->setHeader('Link', $link);
            if ($addToHtmlHead) {
                $this->_getLayout()->getBlock('head')->addLinkRel('canonical', $value);
            }
        }
        return $this;
    }

    /**
    * 
    * @return Ffuenf_Contact_Helper_Data
    */
    protected function _helper()
    {
        return Mage::helper('ffuenf_contact');
    }

    /**
    * 
    * @param string $url
    * @param array $params
    * @return string
    */
    public function getUrl($url, $params = array())
    {
        $params['_nosid'] = true;
        return Mage::getUrl($url, $params);
    }
}

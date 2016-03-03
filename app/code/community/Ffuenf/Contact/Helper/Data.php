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
 * @copyright  Copyright (c) 2016 ffuenf (http://www.ffuenf.de)
 * @license    http://opensource.org/licenses/mit-license.php MIT License
 */

class Ffuenf_Contact_Helper_Data extends Ffuenf_Common_Helper_Core
{
    const CONFIG_EXTENSION_ACTIVE = 'ffuenf_contact/general/enable';
    const XML_PATH_CONTACTS_ROBOTS     = 'ffuenf_contact/contact/robots';
    const XML_PATH_CONTACTS_BREADCRUMB = 'Ffuenf_Contact';

    /**
     * Variable for if the extension is active.
     *
     * @var bool
     */
    protected $bExtensionActive;

    /**
     * Check to see if the extension is active.
     *
     * @return bool
     */
    public function isExtensionActive()
    {
        return $this->getStoreFlag(self::CONFIG_EXTENSION_ACTIVE, 'bExtensionActive');
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        if (!Mage::getSingleton('customer/session')->isLoggedIn()) {
            return '';
        }
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        return trim($customer->getName());
    }

    /**
     * @return string
     */
    public function getUserEmail()
    {
        if (!Mage::getSingleton('customer/session')->isLoggedIn()) {
            return '';
        }
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        return $customer->getEmail();
    }

    /**
     * @return string
     */
    public function getReasons()
    {
        return explode('|', Mage::getStoreConfig('ffuenf_contact/formfields/reasons'));
    }

    /**
     * @return string
     */
    public function getContactsRobots()
    {
        return Mage::getStoreConfig(self::XML_PATH_CONTACTS_ROBOTS);
    }

    /**
     * @return bool
     */
    public function getContactsBreadcrumb()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_CONTACTS_BREADCRUMB);
    }
}

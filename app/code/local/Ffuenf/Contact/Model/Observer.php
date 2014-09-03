<?php
/**
* Magento
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@magentocommerce.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade Magento to newer
* versions in the future. If you wish to customize Magento for your
* needs please refer to http://www.magentocommerce.com for more information.
*
* @category    Ffuenf
* @package     Ffuenf_Contact
* @author      Achim Rosenhagen <a.rosenhagen@ffuenf.de>
* @copyright   Copyright (c) 2014 ffuenf (http://www.ffuenf.de)
* @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*/
class Ffuenf_Contact_Model_Observer {
  /**
  * The indexPostPredispatch observer intercepts the post request object
  * before the post action is called. It then munges the additional reason
  * field into the comment field.
  *
  * @param type $observer
  */
  public function indexPostPredispatch($observer) {
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
}
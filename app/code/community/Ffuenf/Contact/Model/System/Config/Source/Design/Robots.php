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

class Ffuenf_Contact_Model_System_Config_Source_Design_Robots
{
    public function toOptionArray()
    {
        $items = array();
        foreach ((array)Mage::app()->getConfig()->getNode('robots') as $_row) {
            $items[] = array(
                'value' => $_row,
                'label' => Mage::helper('ffuenf_contact')->__(str_replace(',', ', ', $_row))
            );
        }
        return $items;
    }
}

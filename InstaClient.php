<?php
/**
 * Class_Instagram_API
 *
 * @version  1.0
 * @package Stilero
 * @subpackage Class_Instagram_API
 * @author Daniel Eliasson Stilero Webdesign http://www.stilero.com
 * @copyright  (C) 2012-okt-20 Stilero Webdesign, Stilero AB
 * @license	GNU General Public License version 2 or later.
 * @link http://www.stilero.com
 */

// no direct access
//defined('_JEXEC') or die('Restricted access'); 

class InstaClient{
    
    /**
     *
     * @var string Instagram Client ID received from the Dev page 
     */
    var $id;
    /**
     *
     * @var string Instagram Client Secret received from the Dev page 
     */
    var $secret;
    
    public function __construct($id, $secret) {
        $this->id = $id;
        $this->secret = $secret;
    }
    
}

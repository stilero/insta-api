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

class InstaOAuth{
    
    protected static $_instagramOAuthUrl = 'https://api.instagram.com/oauth/';
    protected $InstaClient;
    protected $_redirectUri;
    protected $debug = true;
    
    public function __construct(&$InstaClient, $redirectUri) {
        $this->InstaClient = $InstaClient;
        $this->_redirectUri = $redirectUri;
    }
    
}

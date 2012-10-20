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

class InstaEndpoint{
    
    protected $requestUrl = 'https://api.instagram.com/v1/';
    protected $accessToken;
    protected $params;
    
    public function __construct($accessToken, $params = array()) {
        $this->accessToken = $accessToken;
        $this->params = $params;
        $this->params['access_token'] = $accessToken;
    }
    
    public function query(){
        $url = $this->requestUrl;
        $Communicator = new Communicator($url, $this->params);
        $Communicator->query();
        $jsonResponse = $Communicator->getResponse();
        return $jsonResponse;
    }
    
}

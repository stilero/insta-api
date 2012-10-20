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

class InstaEndpointUsersSearch extends InstaEndpointUsers{
    
    private static $endpointUrl = 'search';
    /**
     *
     * @var int  Count of media to return
     */
    private $count;
    /**
     *
     * @var string A query string.
     */
    private $q;
    
    public function __construct($accessToken, $q, $count = '') {
        parent::__construct($accessToken);
        $this->requestUrl = $this->requestUrl.self::$endpointUrl;
        $this->count = $count;
        $this->q = $q;
        $this->setParams();
    }
    
    private function setParams(){
        if($this->count != ''){
            $this->params['count'] = $this->count;
        }
        if($this->q != ''){
            $this->params['q'] = $this->q;
        }
        
    }
}

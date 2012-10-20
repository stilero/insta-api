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

class InstaEndpointUsersSelfFeed extends InstaEndpointUsers{
    
    private static $endpointUrl = 'self/feed';
    /**
     *
     * @var int  Count of media to return
     */
    private $count;
    /**
     *
     * @var int  Return media later than this min_id.
     */
    private $min_id;
    /**
     *
     * @var int Return media earlier than this max_id.s
     */
    private $max_id;
    
    public function __construct($accessToken, $count='', $min_id='', $max_id='') {
        parent::__construct($accessToken);
        $this->requestUrl = $this->requestUrl.self::$endpointUrl;
        $this->count = $count;
        $this->max_id = $max_id;
        $this->min_id = $min_id;
        $this->setParams();
    }
    
    private function setParams(){
        if($this->count != ''){
            $this->params['count'] = $this->count;
        }
        if($this->min_id != ''){
            $this->params['min_id'] = $this->min_id;
        }
        if($this->max_id != ''){
            $this->params['max_id'] = $this->max_id;
        }
    }
}

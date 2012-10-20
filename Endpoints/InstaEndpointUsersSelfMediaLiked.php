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
defined('_JEXEC') or die('Restricted access'); 

class InstaEndpointUsersSelfMediaLiked extends InstaEndpointUsers{
    
    private static $endpointUrl = 'self/media/liked';
    /**
     *
     * @var int  Count of media to return
     */
    private $count;
    /**
     *
     * @var int Return media liked before this id. 
     */
    private $max_like_id;
    
    public function __construct($accessToken, $maxLikeId='', $count = '') {
        parent::__construct($accessToken);
        $this->requestUrl = $this->requestUrl.self::$endpointUrl;
        $this->count = $count;
        $this->max_like_id = $maxLikeId;
        $this->setParams();
    }
    
    private function setParams(){
        if($this->count != ''){
            $this->params['count'] = $this->count;
        }
        if($this->max_like_id != ''){
            $this->params['max_like_id'] = $this->max_like_id;
        }
        
    }
}

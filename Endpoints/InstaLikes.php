<?php
/**
 * Class_Instagram_API
 *
 * @version  1.0
 * @package Stilero
 * @subpackage Class_Instagram_API
 * @author Daniel Eliasson Stilero Webdesign http://www.stilero.com
 * @copyright  (C) 2012-okt-21 Stilero Webdesign, Stilero AB
 * @license	GNU General Public License version 2 or later.
 * @link http://www.stilero.com
 */

// no direct access
//defined('_JEXEC') or die('Restricted access'); 

class InstaLikes extends InstaEndpoint{
    
    private static $endpointUrl = 'media/';
    
    public function __construct($accessToken) {
        parent::__construct($accessToken);
        $this->requestUrl = $this->requestUrl.self::$endpointUrl;
    }
    /**
     * Get a list of users who have liked this media. 
     * @param int $media_id Instagram Media ID
     * @return string JSON response
     */
    public function getLikesForMedia($media_id){
        $this->requestUrl = $this->requestUrl.$media_id.'/likes/'
                .'?access_token='.$this->accessToken;
        $response = $this->query();
        return $response;
    }
    /**
     * Set a like on this media by the currently authenticated user. 
     * @param int $media_id Instagram Media ID
     * @return string JSON response
     */
    public function likeMedia($media_id){
        $this->params = array('access_token' => $this->accessToken);
        $this->requestUrl = $this->requestUrl.$media_id.'/likes/';
        $response = $this->query();
        return $response; 
    }
    /**
     * Remove a like on this media by the currently authenticated user. 
     * @param int $media_id Instagram Media ID
     * @return string JSON response
     */
    public function unlikeMedia($media_id){
        $this->requestUrl = $this->requestUrl.$media_id.'/likes/'
                .'?access_token='.$this->accessToken;
        $response = $this->query('DELETE');
        return $response; 
    }
}

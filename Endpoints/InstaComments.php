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

class InstaComments extends InstaEndpoint{
    
    private static $endpointUrl = 'media/';
    
    public function __construct($accessToken) {
        parent::__construct($accessToken);
        $this->requestUrl = $this->requestUrl.self::$endpointUrl;
    }
    /**
     * Get a full list of comments on a media. 
     * @param int $media_id Instagram Media ID
     * @return string JSON response
     */
    public function getCommentsForMedia($media_id){
        $this->requestUrl = $this->requestUrl.$media_id.'/comments/'
                .'?access_token='.$this->accessToken;
        $response = $this->query();
        return $response;
    }
    /**
     * Create a comment on a media. 
     * @param int $media_id Instagram Media ID
     * @param string $comment  	Text to post as a comment on the media as specified in media-id.
     * @return string JSON response
     */
    public function postCommentForMedia($media_id, $comment){
        $this->params = array('text' => $comment);
        $this->requestUrl = $this->requestUrl.$media_id.'/comments/'
                .'?access_token='.$this->accessToken;
        $response = $this->query();
        return $response; 
    }
    /**
     * Remove a comment either on the authenticated user's media or authored by the authenticated user. 
     * @param int $media_id     Instagram Media ID
     * @param int $comment_id   Instagram Comment ID
     * @return string JSON response
     */
    public function deleteCommentForMedia($media_id, $comment_id){
        $this->requestUrl = $this->requestUrl.$media_id.'/comments/'.$comment_id.'/'
                .'?access_token='.$this->accessToken;
        $response = $this->query('DELETE');
        return $response;
    }
}

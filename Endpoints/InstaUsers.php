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

class InstaUsers extends InstaEndpoint{
    
    private static $endpointUrl = 'users/';
    
    public function __construct($accessToken) {
        parent::__construct($accessToken);
        $this->requestUrl = $this->requestUrl.self::$endpointUrl;
    }
    /**
     * Get basic information about a user. 
     * @param int $user_id
     * @return string json
     */
    public function getUserInfo($user_id){
        $this->requestUrl = $this->requestUrl.$user_id.'/'
                .'?access_token='.$this->accessToken;
        $restponse = $this->query();
        return $restponse;
    }
    /**
     * See the authenticated user's feed. 
     * @param int $count        Count of media to return.
     * @param int $min_id  	Return media later than this min_id.
     * @param int $max_id  	Return media earlier than this max_id.s
     * @return string json Response
     */
    public function getSelfFeed($count='', $min_id='', $max_id=''){
        $params = array(
            'count' => $count,
            'min_id' => $min_id,
            'max_id' => $max_id
        );
        $this->requestUrl = $this->requestUrl.'self/feed/'
                .'?access_token='.$this->accessToken
                .'&'.http_build_query($params);
        return $this->query();
    }
    /**
     * Get the most recent media published by a user. 
     * @param int $userid
     * @param int $count            Count of media to return.
     * @param int $max_timestamp    Return media before this UNIX timestamp.
     * @param int $min_timestamp    Return media after this UNIX timestamp.
     * @param int $min_id           Return media later than this min_id.
     * @param int $max_id           Return media earlier than this max_id.
     */
    public function getUserIdMediaRecent($userid, $count='', $max_timestamp='', $min_timestamp='', $min_id='', $max_id=''){
        $params = array(
            'count' => $count,
            'max_timestamp' => $max_timestamp,
            'min_timestamp' => $min_timestamp,
            'min_id' => $min_id,
            'max_id' => $max_id
        );
        $this->requestUrl = $this->requestUrl.$userid.'/media/recent/'
                .'?access_token='.$this->accessToken
                .'&'.http_build_query($params);
        return $this->query();
    }
    /**
     * See the authenticated user's list of media they've liked. 
     * Note that this list is ordered by the order in which the user liked the media. 
     * Private media is returned as long as the authenticated user has permission to view that media. 
     * Liked media lists are only available for the currently authenticated user. 
     * @param int $count            Count of media to return.
     * @param int $max_like_id     Return media liked before this id.
     */
    public function getSelfMediaLiked($count='', $max_like_id=''){
        $params = array(
            'count' => $count,
            'max_like_id' => $max_like_id
        );
        $this->requestUrl = $this->requestUrl.'self/media/liked/'
                .'?access_token='.$this->accessToken
                .'&'.http_build_query($params);
        return $this->query();
    }
    /**
     * Search for a user by name. 
     * @param string $query  	A query string.
     * @param int $count        Number of users to return.
     */
    public function search($query, $count=''){
        $params = array(
            'q' => $query,
            'count' => $count
        );
        $this->requestUrl = $this->requestUrl.'search/'
                .'?access_token='.$this->accessToken
                .'&'.http_build_query($params);
        return $this->query();
    }
}
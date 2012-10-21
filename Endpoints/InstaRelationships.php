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

class InstaRelationships extends InstaEndpoint{
    
    private static $endpointUrl = 'users/';
    
    public function __construct($accessToken) {
        parent::__construct($accessToken);
        $this->requestUrl = $this->requestUrl.self::$endpointUrl;
    }
    /**
     * Get the list of users this user follows.
     * @param int $user_id
     * @return string JSON response. 
     */
    public function getUserIdFollows($user_id){
       $this->requestUrl = $this->requestUrl.$user_id.'/follows/'
                .'?access_token='.$this->accessToken;
        $response = $this->query();
        return $response; 
    }
    /**
     * Get the list of users this user is followed by. 
     * @param int $user_id
     * @return string JSON response
     */
    public function getUserIdFollowedBy($user_id){
        $this->requestUrl = $this->requestUrl.$user_id.'/followed-by/'
                .'?access_token='.$this->accessToken;
        $response = $this->query();
        return $response; 
    }
    /**
     * List the users who have requested this user's permission to follow. 
     * @return string JSON response
     */
    public function getSelfRequestedBy(){
        $this->requestUrl = $this->requestUrl.'self/requested-by/'
                .'?access_token='.$this->accessToken;
        $response = $this->query();
        return $response; 
    }
    /**
     * Get information about a relationship to another user. 
     * Relationships are expressed using the following terms:
     * outgoing_status: Your relationship to the user. Can be "follows", "requested", "none".
     * incoming_status: A user's relationship to you. Can be "followed_by", "requested_by", "blocked_by_you", "none". 
     * @param int $user_id Instagram UserID
     * @return string JSON response
     */
    public function getUserIdRelationship($user_id){
        $this->requestUrl = $this->requestUrl.$user_id.'/relationship/'
                .'?access_token='.$this->accessToken;
        $response = $this->query();
        return $response; 
    }
    /**
     * Modify the relationship between the current user and the target user. 
     * @param int $user_id Instagram UserID
     * @param string $action  	One of follow/unfollow/block/unblock/approve/deny.
     * @return string JSON response
     */
    protected function setUserIdRelationship($user_id, $action){
        $this->params = array('action' => $action);
        $this->requestUrl = $this->requestUrl.$user_id.'/relationship/'
                .'?access_token='.$this->accessToken;
        $response = $this->query();
        return $response; 
    }
   /**
    * Follow user id
    * @param int $user_id Instagram UserID
    * @return string JSON response
    */
    public function followUserId($user_id){
        return $this->setUserIdRelationship($user_id, InstaRelationshipAction::FOLLOW);
    }
    /**
     * Unfollow user
     * @param int $user_id Instagram UserID
     * @return string JSON response
     */
    public function unfollowUserId($user_id){
        return $this->setUserIdRelationship($user_id, InstaRelationshipAction::UNFOLLOW);
    }
    /**
     * Block user
     * @param int $user_id Instagram UserID
     * @return string JSON response
     */
    public function blockUserId($user_id){
        return $this->setUserIdRelationship($user_id, InstaRelationshipAction::BLOCK);
    }
    /**
     * Unblock user
     * @param id $user_id Instagram UserID
     * @return string JSON response
     */
    public function unblockUserId($user_id){
        return $this->setUserIdRelationship($user_id, InstaRelationshipAction::UNBLOCK);
    }
    /**
     * Approve user request
     * @param int $user_id Instagram UserID
     * @return string JSON response
     */
    public function approveUserId($user_id){
        return $this->setUserIdRelationship($user_id, InstaRelationshipAction::APPROVE);
    }
    /**
     * Deny user request
     * @param int $user_id Instagram UserID
     * @return string JSON response
     */
    public function denyUserId($user_id){
        return $this->setUserIdRelationship($user_id, InstaRelationshipAction::DENY);
    }
}

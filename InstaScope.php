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

class InstaScope{
    
    /**
     * basic - to read any and all data related to a user (e.g. following/followed-by lists, photos, etc.) (granted by default)
     */
    const BASIC = 'basic'; 
    /**
     * comments - to create or delete comments on a user’s behalf
     */
    const COMMENTS = 'comments'; 
    /**
     * relationships - to follow and unfollow users on a user’s behalf
     */
    const RELATIONSHIPS = 'relationships';
    /**
     * likes - to like and unlike items on a user’s behalf
     */
    const LIKES = 'likes';

    public static function full(){
        $scope = self::BASIC.' '.
            self::COMMENTS.' '.
            self::LIKES.' '.
            self::RELATIONSHIPS;
        return $scope;
    }
    
    public static function likesComments(){
        $scope = self::BASIC.' '.
            self::COMMENTS.' '.
            self::LIKES;
        return $scope;
    }
    
    public static function likes(){
        $scope = self::BASIC.' '.
            self::LIKES;
        return $scope;
    }
    
    public static function comments(){
        $scope = self::BASIC.' '.
            self::COMMENTS.' ';
        return $scope;
    }
}

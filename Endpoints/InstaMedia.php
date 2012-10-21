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

class InstaMedia extends InstaEndpoint{
    
    private static $endpointUrl = 'media/';
    
    public function __construct($accessToken) {
        parent::__construct($accessToken);
        $this->requestUrl = $this->requestUrl.self::$endpointUrl;
    }
    /**
     * Get information about a media object. 
     * Note: if you authenticate with an OAuth Token, 
     * you will receive the user_has_liked key which quickly tells you 
     * whether the current user has liked this media item.
     * @param int $media_id Instagram Media ID
     * @return string JSON response
     */
    public function getId($media_id){
        $this->requestUrl = $this->requestUrl.$media_id.'/'
                .'?access_token='.$this->accessToken;
        $response = $this->query();
        return $response;
    }
    /**
     * Search for media in a given area. 
     * @param string $lat           Latitude of the center search coordinate (48.858844). If used, lng is required.
     * @param string $lng           Longitude of the center search coordinate (2.294351). If used, lat is required.
     * @param int $min_timestamp    A unix timestamp. All media returned will be taken later than this timestamp.
     * @param int $max_timestamp    A unix timestamp. All media returned will be taken earlier than this timestamp.
     * @param int $distance         Default is 1km (distance=1000), max distance is 5km.
     * @return string JSON response
     */
    public function search($lat='', $lng='', $min_timestamp='', $max_timestamp='', $distance=''){
        $params = array(
            'lat' => $lat,
            'lng' => $lng,
            'min_timestamp' => $min_timestamp,
            'max_timestamp' => $max_timestamp,
            'distance' => $distance
        );
        $this->requestUrl = $this->requestUrl.'search/'
                .'?access_token='.$this->accessToken
                .'&'.http_build_query($params);
        return $this->query();
    }
    /**
     * Get a list of what media is most popular at the moment. 
     * @return string JSON response
     */
    public function getPopular(){
        $this->requestUrl = $this->requestUrl.'popular/'
                .'?access_token='.$this->accessToken;
        $response = $this->query();
        return $response;
    }
}

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

class InstaLocations extends InstaEndpoint{
    
    private static $endpointUrl = 'locations/';
    
    public function __construct($accessToken) {
        parent::__construct($accessToken);
        $this->requestUrl = $this->requestUrl.self::$endpointUrl;
    }
    /**
     * Get information about a location. 
     * @param int $location_id Instagram Location ID
     * @return string JSON Response
     */
    public function getInfo($location_id){
        $this->requestUrl = $this->requestUrl.$location_id.'/'
                .'?access_token='.$this->accessToken;
        $response = $this->query();
        return $response;
    }
    /**
     * Get a list of recent media objects from a given location. 
     * @param int $location_id          Instagram Location ID
     * @param int $min_timestamp        Return media after this UNIX timestamp
     * @param type $max_timestamp  	Return media before this UNIX timestamp
     * @param type $min_id              Return media before this min_id.
     * @param type $max_id              Return media after this max_id.
     * @return string                   JSON Response
     */
    public function getRecentMediaByLocation($location_id, $min_timestamp='', $max_timestamp='', $min_id='', $max_id=''){
        $params = array(
            'min_timestamp' => $min_timestamp,
            'max_timestamp' => $max_timestamp,
            'min_id' => $min_id,
            'max_id' => $max_id,
        );
        $this->requestUrl = $this->requestUrl.$location_id.'/media/recent/'
                .'?access_token='.$this->accessToken
                .'&'.http_build_query($params);
        return $this->query();
    }
    /**
     * Search for a location by geographic coordinate. 
     * @param string $lat               Latitude of the center search coordinate (eg: 48.858844). If used, lng is required.
     * @param type $lng                 Longitude of the center search coordinate (eg: 2.294351). If used, lat is required.
     * @param type $distance            Distance in meters, Default is 1000m (distance=1000), max distance is 5000.
     * @param type $foursquare_v2_id    Returns a location mapped off of a foursquare v2 api location id. If used, you are not required to use lat and lng.
     * @param type $foursquare_id       Returns a location mapped off of a foursquare v1 api location id. If used, you are not required to use lat and lng. Note that this method is deprecated; you should use the new foursquare IDs with V2 of their API.
     * @return string                   JSON Response
     */
    public function search($lat='', $lng='', $distance='', $foursquare_v2_id='', $foursquare_id=''){
        $params = array(
            'lat' => $lat,
            'lng' => $lng,
            'distance' => $distance,
            'foursquare_v2_id' => $foursquare_v2_id,
            'foursquare_id' => $foursquare_id
        );
        $this->requestUrl = $this->requestUrl.'search/'
                .'?access_token='.$this->accessToken
                .'&'.http_build_query($params);
        return $this->query();
    }
}

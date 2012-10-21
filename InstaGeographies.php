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

class InstaGeographies extends InstaEndpoint{
    
    private static $endpointUrl = 'geographies/';
    
    public function __construct($accessToken) {
        parent::__construct($accessToken);
        $this->requestUrl = $this->requestUrl.self::$endpointUrl;
    }
    /**
     * Get very recent media from a geography subscription that you created. 
     * Note: you can only access Geographies that were explicitly created by your OAuth client. 
     * To backfill photos from the location covered by this geography, use the media search endpoint. 
     * @param int $geo_id   Instagram GEO ID
     * @param int $count    Max number of media to return.
     * @param int $min_id   Return media before this min_id.
     * @return type
     */
    public function getRecentMediaByGeoId($geo_id, $count='', $min_id=''){
        $params = array(
            'count' => $count,
            'min_id' => $min_id
        );
        $this->requestUrl = $this->requestUrl.$geo_id.'/media/recent/'
                .'?access_token='.$this->accessToken
                .'&'.http_build_query($params);
        return $this->query();
    }
}

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

class InstaTags extends InstaEndpoint{
    
    private static $endpointUrl = 'tags/';
    
    public function __construct($accessToken) {
        parent::__construct($accessToken);
        $this->requestUrl = $this->requestUrl.self::$endpointUrl;
    }
    /**
     * Get information about a tag object. 
     * @param string $tag_name Tag name
     * @return string JSON Response
     */
    public function getInfo($tag_name){
        $this->requestUrl = $this->requestUrl.$tag_name.'/'
                .'?access_token='.$this->accessToken;
        $response = $this->query();
        return $response;
    }
    /**
     * Get a list of recently tagged media. 
     * Note that this media is ordered by when the media was tagged with this tag, rather than the order it was posted. 
     * Use the max_tag_id and min_tag_id parameters in the pagination response to paginate through these objects. 
     * @param string $tag_name Tag name
     * @param int $min_id Return media before this min_id.
     * @param int $max_id Return media after this max_id.
     * @return string JSON Response
     */
    public function getRecentMediaByTag($tag_name, $min_id='', $max_id=''){
        $this->requestUrl = $this->requestUrl.$tag_name.'/media/recent/'
                .'?access_token='.$this->accessToken;
        $response = $this->query();
        return $response;
    }
    /**
     * Search for tags by name. Results are ordered first as an exact match, then by popularity. 
     * @param string $query  	A valid tag name without a leading #. (eg. snow, nofilter)
     * @return string JSON Response
     */
    public function search($query){
        $params = array(
            'q' => $query
        );
        $this->requestUrl = $this->requestUrl.'search/'
                .'?access_token='.$this->accessToken
                .'&'.http_build_query($params);
        return $this->query();
    }
}

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

class InstaEmbeddings extends InstaEndpoint{
    
    private static $endpointUrl = 'http://api.instagram.com/oembed/';
    
    public function __construct($accessToken) {
        parent::__construct($accessToken);
    }
    /**
     * Given a short link, returns information about the media associated with that link. 
     * @param string $url       A short link, like http://instagr.am/p/BUG/.
     * @param string $callback  A JSON callback to be invoked.
     * @param int $maxheight    Maximum height of returned media.
     * @param int $maxwidth     Maximum width of returned media.
     * @return string           JSON response
     */
    public function getOembeded($url){
        $params = array(
            'url' => $url
        );
        $this->requestUrl = self::$endpointUrl
                //.'?access_token='.$this->accessToken
                .'?'.http_build_query($params);
        return $this->query();
    }
}

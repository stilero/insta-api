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

class InstaOauthAccessCode extends InstaOAuth{
    
    const RESPONSE_TYPE_PARAM = 'code';
    private static $_instaCodeUrlPath = 'authorize/';
    public $code;
    
    public function __construct($InstaClient, $redirectUri) {
        parent::__construct($InstaClient, $redirectUri);
    }
    
    protected function getAuthorizationUrl(){
        $href = parent::$_instagramOAuthUrl.self::$_instaCodeUrlPath;
        $vars = array(
            'client_id' => $this->InstaClient->id,
            'redirect_uri' => $this->_redirectUri,
            'response_type' => self::RESPONSE_TYPE_PARAM,
            'scope' => InstaScope::COMMENTS.' '.InstaScope::LIKES.' '.InstaScope::RELATIONSHIPS
        );
        $query = http_build_query($vars);
         $url = $href.'?'.$query;
         return $url;
    }
    
    public function openAuthorizationUrl(){
        header('Location: '.$this->getAuthorizationUrl());
        exit(1);
    }
    
    public function getCodeFromRequest(){
        $this->code = $_GET[self::RESPONSE_TYPE_PARAM];
        return $this->code;
    }
}

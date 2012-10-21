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

class InstaOauthAccessToken extends InstaOAuth{
    
    const GRANT_TYPE = 'authorization_code';
    private static $_instaTokenUrlPath = 'access_token/';
    protected $accessCode;
    public $token;
    
    public function __construct($InstaClient, $redirectUri, $accessCode) {
        parent::__construct($InstaClient, $redirectUri);
        $this->accessCode = $accessCode;
    }
    
    private function getPostVars(){
        $vars = array(
            'client_id' => $this->InstaClient->id,
            'client_secret' => $this->InstaClient->secret,
            'grant_type' => self::GRANT_TYPE,
            'redirect_uri' => $this->_redirectUri,
            'code' => $this->accessCode
        );
        return $vars;
    }
    /**
     * Extracts a token from the Json response
     * @param string $jsonResponse JSON encoded response from instagram
     * @return string An access token, false on fail
     */
    private function getTokenFromJsonResponse($jsonResponse){
        $response = json_decode($jsonResponse);
        if(isset($response->access_token)){
            return $response->access_token;
        }
        return false;
    }
    /**
     * Requests an access token from Instagram
     * @return string   A valid access token
     */
    public function requestAccessToken(){
        $url = parent::$_instagramOAuthUrl . self::$_instaTokenUrlPath;
        $Communicator = new Communicator($url, $this->getPostVars());
        $Communicator->query();
        $jsonResponse = $Communicator->getResponse();
        $this->token = $this->getTokenFromJsonResponse($jsonResponse);
        return $this->token;
    }
    
}

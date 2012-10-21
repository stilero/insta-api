<?php
/**
 * Communicator handles server communication usin cURL
 *
 * @version  1.3
 * @author Daniel Eliasson - joomla at stilero.com
 * @copyright  (C) 2012-aug-31 Stilero Webdesign http://www.stilero.com
 * @category Classes
 * @license	GPLv2
 * 
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * 
 * This file is part of communicator.
 * 
 * communicator is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * communicator is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with communicator.  If not, see <http://www.gnu.org/licenses/>.
 */

// no direct access
//defined('_JEXEC') or die('Restricted access'); 

class Communicator {
    
    protected $_config;
    private $_header;
    private $_isPost;
    private $_curlHandler;
    private $_url;
    private $_postVars;
    private $_response;
    private $_responseInfoParts;
    private $_cookieFile;
    const HTTP_STATUS_OK = '200';

    function __construct($url="", $postVars="", $config="") {
        $this->_isPost = false;
        $this->_url = $url;
        if(!empty($postVars)){
            $this->_isPost = true;
            $this->_postVars = $postVars;
        }
        
        
        $this->_config = 
            array(
                'curlUserAgent'         =>  'Communicator - www.stilero.com',
                'curlConnectTimeout'    =>  20,
                'curlTimeout'           =>  20,
                'curlReturnTransf'      =>  true, //return the handle as a string
                'curlSSLVerifyPeer'     =>  false,
                'curlFollowLocation'    =>  true,
                'curlProxy'             =>  false,
                'curlProxyPassword'     =>  false,
                'curlEncoding'          =>  false,
                'curlHeader'            =>  false, //Include the header in the output
                'curlHeaderOut'         =>  true,
                'curlUseCookies'        =>  true,
                'debug'                 =>  false,
                'eol'                   =>  "<br /><br />"
            );
        if(is_array($config)) {
            $this->_config = array_merge($this->_config, $config);
        }
    }
    
    public function query(){
        $this->resetResponse();
        $this->_curlHandler = curl_init(); 
        $this->_setupCurl();
        $this->_response = curl_exec ($this->_curlHandler);
        $this->_responseInfoParts = curl_getinfo($this->_curlHandler); 
        curl_close ($this->_curlHandler);
        $this->_destroyCookieFile();
    }
    
    private function _setupCurl(){
        $this->_initCurlSettings();
        $this->_initCurlPostMode();
        $this->_initCurlHeader();
        $this->_initCurlProxyPassword();
        $this->_initCookieFile();
    }
    
    private function _initCurlSettings(){
        curl_setopt_array(
            $this->_curlHandler, 
            array(
                CURLOPT_URL             =>  $this->_url,
                CURLOPT_USERAGENT       =>  $this->_config['curlUserAgent'],
                CURLOPT_CONNECTTIMEOUT  =>  $this->_config['curlConnectTimeout'],
                CURLOPT_TIMEOUT         =>  $this->_config['curlTimeout'],
                CURLOPT_RETURNTRANSFER  =>  $this->_config['curlReturnTransf'],
                CURLOPT_SSL_VERIFYPEER  =>  $this->_config['curlSSLVerifyPeer'],
                CURLOPT_FOLLOWLOCATION  =>  $this->_config['curlFollowLocation'],
                CURLOPT_PROXY           =>  $this->_config['curlProxy'],
                CURLOPT_ENCODING        =>  $this->_config['curlEncoding'],
                CURLOPT_HEADER          =>  $this->_config['curlHeader'],
                CURLINFO_HEADER_OUT     =>  $this->_config['curlHeaderOut']
            )
        );
    }
    
    private function _initCurlPostMode(){
        if($this->_isPost){
            curl_setopt($this->_curlHandler, CURLOPT_POST, $this->_isPost);
            curl_setopt($this->_curlHandler, CURLOPT_POSTFIELDS, $this->_postVars);
        }
    }
    
    private function _initCurlHeader(){
        $this->_buildHTTPHeader();
        curl_setopt($this->_curlHandler, CURLOPT_HTTPHEADER, $this->_header);
    }
    
    protected function _buildHTTPHeader(){
        if(isset($this->_header)){
            return;
        }
        $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,"; 
        $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5"; 
        $header[] = "Cache-Control: max-age=0"; 
        $header[] = "Connection: keep-alive"; 
        $header[] = "Keep-Alive: 300"; 
        $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7"; 
        $header[] = "Accept-Language: en-us,en;q=0.5"; 
        $header[] = "Pragma: ";  
        $this->_header = $header;
    }
    
    private function _initCurlProxyPassword(){
        if ($this->_config['curlProxyPassword'] !== false) {
            curl_setopt($this->_curlHandler, CURLOPT_PROXYUSERPWD, $this->_config['curl_proxyuserpwd']);
        } 
    }
    
    private function _initCookieFile(){
        if(!$this->_config['curlUseCookies']){
            return;
        }
        if (!defined('DS')){
            define('DS', DIRECTORY_SEPARATOR);
        }
        try {
            $this->_cookieFile = tempnam(DS."tmp", "cookies");
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        if (!$this->_cookieFile){
            return;
        }
        curl_setopt($this->_curlHandler, CURLOPT_COOKIEFILE, $this->_cookieFile);
        curl_setopt($this->_curlHandler, CURLOPT_COOKIEJAR, $this->_cookieFile);
    }
    
    private function _destroyCookieFile(){
        if($this->_cookieFile != "" && $this->_config['curlUseCookies']){
            unlink($this->_cookieFile);
        }
    }
    
    public function resetResponse(){
        $this->_response = '';
        $this->_responseInfoParts = array();
    }
    
    public function setUrl($url){
        $this->_url = $url;
    }
    
    public function setHeader($header){
        $this->_header = $header;
    }
    
    public function setPostVars($postVars){
        if(is_array($postVars)){
            if(!empty($postVars)){
                $this->_isPost = true;
                $this->_postVars = http_build_query($postVars);
            }
        }else if($postVars != ""){
            $this->_postVars = $postVars;
            $this->_isPost = true;
        }
    }
    
    public function getResponse(){
        return $this->_response;
    }
    
    public function getInfo(){
        return $this->_responseInfoParts;
    }
    
    public function getInfoHTTPCode(){
        return $this->_responseInfoParts['http_code'];
    }
        
    public function isOK(){
        if ($this->_responseInfoParts['http_code'] == self::HTTP_STATUS_OK) {
            return true;
        }else{
            return false;
        }
    }
    
    public function __get($name) {
        return $this->$name;
    }
    
    public function __set($name, $value) {
        $this->$name = $value;
    }
}
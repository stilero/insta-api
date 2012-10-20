<?php
require_once 'Communicator.php';
require_once 'InstaError.php';
require_once 'InstaClient.php';
require_once 'InstaOauth.php';
require_once 'InstaOauthAccessCode.php';
require_once 'InstaOauthAccessToken.php';
require_once 'InstaScope.php';
require_once 'Endpoints/InstaEndpoint.php';
require_once 'Endpoints/InstaEndpointUsers.php';
require_once 'Endpoints/InstaEndpointUsersSelfFeed.php';
require_once 'Endpoints/InstaEndpointUsersSearch.php';
$redirectUri = 'http://localhost/joomla_extensions/insta-api/';
$client = new InstaClient('d655a4a9d47c471f9f7ddb7bcbbb237a', '499c4df733cd436689badba80bab960f');
$accessCode = new InstaOauthAccessCode($client, $redirectUri);

if(!isset($_GET['code'])){
    $accessCode->openAuthorizationUrl();
}
$code = $accessCode->getCodeFromRequest();
$token = new InstaOauthAccessToken($client, $redirectUri, $code);
$accessToken = $token->requestAccessToken();
$search = new InstaEndpointUsersSelfFeed($accessToken);
$result = $search->query();
var_dump($result);
?>

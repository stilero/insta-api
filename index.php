<?php
require_once 'Communicator.php';
require_once 'InstaError.php';
require_once 'InstaRelationshipAction.php';
require_once 'InstaClient.php';
require_once 'InstaOauth.php';
require_once 'InstaOauthAccessCode.php';
require_once 'InstaOauthAccessToken.php';
require_once 'InstaScope.php';
require_once 'Endpoints/InstaEndpoint.php';
require_once 'Endpoints/InstaUsers.php';
require_once 'Endpoints/InstaRelationships.php';
require_once 'Endpoints/InstaMedia.php';
require_once 'Endpoints/InstaComments.php';
require_once 'Endpoints/InstaLikes.php';
require_once 'Endpoints/InstaTags.php';
require_once 'Endpoints/InstaLocations.php';
require_once 'Endpoints/InstaEmbeddings.php';
$redirectUri = 'http://localhost/joomla_extensions/insta-api/';
$client = new InstaClient('d655a4a9d47c471f9f7ddb7bcbbb237a', '499c4df733cd436689badba80bab960f');
//$accessCode = new InstaOauthAccessCode($client, $redirectUri);
//
//if(!isset($_GET['code'])){
//    $accessCode->openAuthorizationUrl();
//}
//$code = $accessCode->getCodeFromRequest();
//$token = new InstaOauthAccessToken($client, $redirectUri, $code);
//print $accessToken = $token->requestAccessToken();exit;
$accessToken = '7702131.d655a4a.938595d4c4c04cccb540249fad4536e7';
$endpoint = new InstaEmbeddings($accessToken);
//$response = $endpoint->deleteCommentForMedia('306772392690611085_8903611', '306824471710822768' );
//$response = $endpoint->postCommentForMedia('306772392690611085_8903611', "Nice!");
$response = $endpoint->getOembeded('http://instagr.am/p/BUG/');
var_dump(json_decode($response));
?>

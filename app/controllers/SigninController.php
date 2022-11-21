<?php

namespace WebApp\Controller;

use Stilmark\Router\Request;
use League\OAuth2\Client\Provider\Google;
# https://github.com/thephpleague/oauth2-google
use League\OAuth2\Client\Provider\Github;
# https://github.com/thephpleague/oauth2-github

class SigninController extends Controller {

	function __construct()
	{

		if (!in_array(Request::args('provider'), explode(',',$_ENV['OAUTH_CLIENTS']))) {
			redirect('/');
		}

		switch(Request::args('provider')) {
			case 'google':
				$this->provider = new Google([
					'clientId'     => $_ENV['GOOGLE_CLIENT_ID'],
					'clientSecret' => $_ENV['GOOGLE_CLIENT_SECRET'],
					'redirectUri'  => 'https://'.$_SERVER['SERVER_NAME'].'/signin/google/callback'
				]);
				break;
			case 'github':
				$this->provider = new Github([
					'clientId'     => $_ENV['GITHUB_CLIENT_ID'],
					'clientSecret' => $_ENV['GITHUB_CLIENT_SECRET'],
					'redirectUri'  => 'https://'.$_SERVER['SERVER_NAME'].'/signin/github/callback'
				]);
				break;
			default:
				redirect('/');
		}
	}

	function callout()
	{
	    $authUrl = $this->provider->getAuthorizationUrl();
	    $_SESSION['oauth2state'] = $this->provider->getState();
		redirect($authUrl);
	}

	function callback() {

		if (Request::get('error')) {
			die('Got error: ' . htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'));
		} elseif(empty(Request::get('state')) || (Request::get('state') !== $_SESSION['oauth2state'])) {
		    unset($_SESSION['oauth2state']);
		    die('Invalid state');
		} else {
		    $token = $this->provider->getAccessToken('authorization_code', [
		        'code' => Request::get('code')
		    ]);

		    try {
		    	$user = $this->provider->getResourceOwner($token);
		    } catch (Exception $e) {
				die('Something went wrong: ' . $e->getMessage());
			}

		}

		switch(Request::args('provider')) {

			case 'google':
		        $_SESSION['signin'] = [
		        	'provider' => 'google',
		        	'token' => $token->getToken(),
		        	'tokenExpires' => $token->getExpires(),
		        	'id' => $user->getId(),
		        	'email' => $user->getEmail(),
		        	'name' => $user->getName(),
		        	'firstname' => $user->getFirstName(),
		        	'lastname' => $user->getLastName(),
		        	'locale' => $user->getLocale(),
		        	'hostedDomain' => $user->getHostedDomain(),
		        	'avatar' => $user->getAvatar()
		        ];
				break;

			case 'github':
		        $_SESSION['signin'] = [
		        	'provider' => 'github',
		        	'token' => $token->getToken(),
		        	'id' => $user->getId(),
		        	'email' => $user->getEmail(),
		        	'name' => $user->getName(),
		        	'nickname' => $user->getNickname()
		        ];
				break;
		}

		dd($_SESSION);

	}

	function options()
	{
        return [
            'template' => 'signin',
            'data' => [
                'providers' => explode(',',$_ENV['OAUTH_CLIENTS'])
            ]
        ];
	}

}
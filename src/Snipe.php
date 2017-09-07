<?php

namespace Notyourtechguy\Sniper;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\SessionCookieJar;

class Snipe {

	protected $client;
	protected $cookieJar;
	protected $username;
	protected $password;
	
	public function __construct($username, $password)
	{
	    $this->username = $username;
	    $this->password = $password;
		$this->cookieJar = new SessionCookieJar('SESSION_STORAGE', true);
		$this->client = new Client([
			'base_uri' => 'http://my.adnu.edu.ph/index.php/',
			'cookies' => $this->cookieJar,
		]);

		$this->login();

		return $this->client;
	}

	public function login()
	{
		$this->client->request('POST', 'login', [
			'form_params' => [
				'password' => $this->password,
				'username' => $this->username,
			],
		]);
	}

	public function browse($uri)
	{
		$this->client->request('GET', $uri);
	}

    public function getCookie()
    {
        $response = $this->cookieJar->toArray();

        return $response;
    }

	public function getData($index)
    {
        $cookie = $this->getCookie();

        return $this->decode($cookie[$index]['Value']);
    }

    public function decode($data)
    {
        $decoded = urldecode($data);
        $decoded = unserialize($decoded);

        return $decoded;
    }

}
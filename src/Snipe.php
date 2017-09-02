<?php

namespace Notyourtechguy\Snipe;

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

	public function getData()
    {
        $cookie = $this->getCookie();

        return $this->decode($cookie[1]['Value']);
    }

    public function decode($data)
    {
        $decoded = urldecode($data);
        $decoded = unserialize($decoded);

        return $decoded;
    }

    public function getClassmates()
    {
        $this->browse('mySubjectsCMates2/classList/2017-1-00814');
        $response = $this->getData();
        return $response['logged_in']['CLASSLIST'];
    }


}
<?php
error_reporting(0);

// file_put_contents("/config.ini", substr(md5(time()),0,20));
class Authentication
{
	private $username;
	private $sess;
	private $token;
	function __construct($username)
	{
		$this->token = file_get_contents("/config.ini");
		$this->username = $username;
		$this->sess = md5($this->token.$this->username);
	}

	function initcookie()
	{
		setcookie("username",$this->username);
		setcookie("session",$this->sess);
	}

	function isAdmin($username,$sess)
	{	
		return $sess === md5($this->token.$username);
	}
}

$user = new Authentication("admin");
if(!isset($_COOKIE['username']) || !isset($_COOKIE['session']))
{
	$user->initcookie();
}else{
	$username = $_COOKIE['username'];
	$sess = $_COOKIE['session'];
	if($username === "admin"){
		echo("FxkU!FAKE ADMIN!<br>");
	}else{
		if($user->isAdmin($username,$sess))
		{
			include_once "flag.php";
			die("<h1>Hello Admin!</h1><h2>you flag is:  ".$flag."</h2>");
		}else{
			echo("<h1>Hello! my guest</h1>");
		}
	}

}

highlight_file(__file__);

<?php
use Aura\Session\SessionFactory;

$sessionFactory = new SessionFactory;
$session = $sessionFactory->newInstance($_COOKIE);

static class Session {
	static $sessionInstance;
	static $segment;
}

Session::$sessionInstance =& $session;
Session::$segment = $session->getSegment('global');

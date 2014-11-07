<?php

class RouteTest extends TestCase {

	public function testHomeRoute()
	{
		Route::enableFilters();
		$this->call('GET', '/');
    	$this->assertRedirectedToRoute('login');
	}

	public function testNonLoggedInRoute()
	{
		Route::enableFilters();
		$this->call('GET', '/player');
    	$this->assertRedirectedToRoute('login');
	}
}
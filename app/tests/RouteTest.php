<?php

class RouteTest extends TestCase {

	
	public function testHomeRoute()
	{
		$this->call('GET', '/');

    	$this->assertResponseOk();
	}

	public function testPlayerRoute()
	{
		$this->fakerTestUsers(1);

		$this->call('GET', '/player/1');

    	$this->assertResponseOk();
	}

	public function testPlayernotfoundRedirect()
	{
		$this->call('GET', '/player/999');

		$this->assertRedirectedToRoute('home');
		$this->assertSessionHas('message');
	}

}

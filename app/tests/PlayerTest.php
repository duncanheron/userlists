<?php
class PlayerTest extends TestCase {

	public function testAlwaysPass()
	{
		$this->assertTrue(true);
	}
	protected $mock;
	protected $player;
	
	public function tearDown()
	{
	  Mockery::close();
	}

	public function __construct()
    {
    	// $this->player = $this->createInMemoryUser();
    }

    public function testPlayerCantLogin()
    {
    	
    }
}

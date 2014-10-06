<?php
class PlayerTest extends TestCase {

	protected $mock;
	protected $player;
	
	public function tearDown()
	{
	  Mockery::close();
	}

	public function __construct()
    {
    	
    }

    private function getRealPlayer($testEmail)
    {
    	if (! $this->player) {
	    	// create one real user
	    	$faker = Faker\Factory::create();

			$this->player = new Player;
			// $testEmail = $faker->email;
			$this->player->firstname = $faker->firstName;
			$this->player->lastname = $faker->lastName;
			$this->player->email = $testEmail;
			$this->player->password = $faker->word;
			// print "player--created\n\n";
			$this->assertTrue($this->player->save());
			return $this->player;
    	} else {
    		// print "player--used\n\n";
    		return $this->player;
    	}
    }

	public function testPlayerExistsViaController()
	{
		$testEmail = 'fake@faker.com';
		$player = $this->getRealPlayer($testEmail);

		// check we can retrieve the player
		$newPlayer = Player::find(1);
		$this->assertEquals($newPlayer->email, $testEmail);
	 
	}

	public function testPlayerDoesntExistsViaController()
	{
		$faker = Faker\Factory::create();

		$testEmail = 'neverexists@faker.com';
		// $player = $this->getRealPlayer($testEmail);
		$response = $this->action(
			'POST', 
			'PlayerController@checkplayer', 
			array('email' => $testEmail)
		);
		// $this->assertTrue($player->save());
		// check we can retrieve the player
		$newPlayer = Player::find(1);
		$this->assertNull($newPlayer);
		$this->assertRedirectedToRoute('home');
		$this->assertSessionHas('message');
	}

	public function testPlayerChoiceYes()
	{
		$testEmail = 'fake@faker.com';
		$player = $this->getRealPlayer($testEmail);

		$response = $this->call(
			'POST', 
			'player/'.$player->id,
			array(
				'response' => '1',
				'player_id' => $player->id)
		);
		
		$this->assertEquals('1', Input::get('response'));
		$this->assertSessionHas('message','Rain or shine.');
	}

	public function testPlayerChoiceNo()
	{
		$testEmail = 'fake@faker.com';
		$player = $this->getRealPlayer($testEmail);

		$response = $this->call(
			'POST', 
			'player/'.$player->id,
			array(
				'response' => '0',
				'player_id' => $player->id)
		);
		
		$this->assertRedirectedTo('player/'.$player->id);
		$this->assertSessionHas('message','If this changes come back and let us know.');
	}

	public function testPlayerChoiceEmpty()
	{
		$testEmail = 'fake@faker.com';
		$player = $this->getRealPlayer($testEmail);

		$response = $this->call(
			'POST', 
			'player/'.$player->id,
			array(
				'response' => '',
				'player_id' => $player->id)
		);
		$this->assertRedirectedTo('player/'.$player->id);
	}

	public function testPlayerExistsRedirect()
	{
	
		$testEmail = 'fake@faker.com';
		$player = $this->getRealPlayer($testEmail);

		$response = $this->call(
			'POST', 
			'/',
			array(
				'response' => '',
				'email' => $player->email)
		);
		$this->assertRedirectedTo('player/'.$player->id);
	}
}

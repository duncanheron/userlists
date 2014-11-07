<?php
use \Mockery;

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	protected $userMock;
	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

	/**
	 * Migrates the database and set the mailer to 'pretend'.
	 * This will cause the tests to run quickly.
	 *
	 */
	private function prepareForTests()
	{
	    Artisan::call('migrate');
	    // Artisan::call('db:seed');
	    Mail::pretend(true);
	    $this->mockUser = Mockery::mock('Eloquent', 'User');
	}

	/**
	 * Default preparation for each test
	 *
	 */
	public function setUp()
	{
	    parent::setUp();
	 
	    $this->prepareForTests();

	}

	protected function createInMemoryUser()
	{
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
	}

	protected function fakerTestUsers($numberOfPlayers)
	{
		$faker = Faker\Factory::create();
 
		for ($i = 1; $i <= $numberOfPlayers; $i++)	{
			$player = Player::create(
				array(
					'id'        => $i,
					'firstname' => $faker->firstName,
					'lastname'  => $faker->lastName,
					'email'     => $faker->email,
					'password'  => Hash::make('test')
				)
			);

		}
	}

}

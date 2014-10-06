<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

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

	public function fakerTestUsers($numberOfPlayers)
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

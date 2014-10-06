<?php

class PlayerSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->command->info('Deleting existing Players ...');
        DB::table('players')->delete();

		$player = User::create(
			array(
	        	'firstname' => 'Duncan',
	        	'lastname' => 'Heron',
	            'email' => 'duncanuk@gmail.com',
	            'password' => Hash::make('test')
	        )
	    );
	    $faker = Faker\Factory::create();
 
		for ($i = 0; $i < 10; $i++)	{
			$player = User::create(
				array(
					'firstname' => $faker->firstName,
					'lastname' => $faker->lastName,
					'email' => $faker->email,
					'password' => Hash::make('test')
				)
			);
		}
		
		$this->command->info('Players table seeded using Faker ...');
	}

}

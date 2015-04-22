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
                'id'        => 1,
                'team_id'   => 1,
                'firstname' => 'Duncan',
                'lastname'  => 'Heron',
                'email'     => 'duncanuk@gmail.com',
                'password'  => Hash::make('test')
            )
        );

        $faker = Faker\Factory::create();
        for ($i = 2; $i <= 10; $i++) {
            $player = User::create(
                array(
                    'id'        => $i,
                    'team_id'   => 1,
                    'firstname' => $faker->firstName,
                    'lastname'  => $faker->lastName,
                    'email'     => $faker->email,
                    'password'  => Hash::make('test')
                )
            );
        }
        
        $this->command->info('Players table seeded using Faker ...');
    }

}

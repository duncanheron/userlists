<?php

class PlayersPlayingSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->command->info('Deleting existing playing history ...');
        DB::table('players_playing')->delete();

        /**
         * Create my main playing history
         */
        $this->command->info('Creating my players playing history ...');
        for ($i = 0; $i < 10; $i++) {
            $date = $i == 0
                    ? strtotime('last Tuesday -1 week')
                    : date('now');
            $players = UsersAttending::create(
                array(
                    'player_id' => 1,
                    'week_as_int' => date("W") - $i,
                    'response' => 1,
                    'created_at' => date('Y-m-d H:i:s', $date),
                    'updated_at' => date('Y-m-d H:i:s', $date)
                )
            );
        }

        /**
         * Create auto generated players history playing history
         */
        /*$this->command->info('Creating random players playing history ...');
        $faker = Faker\Factory::create();
 
        for ($i = 0; $i < 5; $i++) {
            for($j = 0; $j < 3; $j++) {
                $date = $j == 0
                        ? strtotime('last Tuesday -1 week')
                        : '';
                $player = User::create(
                    array(
                        'player_id' => $i,
                        'week_as_int' => date("W") - 1,
                        'response' => 1,
                        'created_at' => $faker->dateTime($date),
                        'updated_at' => $faker->dateTime($date)
                    )
                );
            }
        }*/
        
        $this->command->info('Players table seeded with playing history ...');
    }

}

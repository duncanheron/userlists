<?php

class TeamSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->command->info('Deleting existing Teams ...');
        DB::table('teams')->delete();

        $team = Team::create(
            array(
                'id'        => 1,
                'name' => 'The scouse army',
            )
        );
        
        $this->command->info('Teams table seeded using Faker ...');
    }

}

<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
//
        $this->call('UserTableSeeder');
        $this->command->info('Users table seeded!');
//        $this->call('ContentsTableSeeder');
//        $this->command->info('Contents table seeded!');
    }

}

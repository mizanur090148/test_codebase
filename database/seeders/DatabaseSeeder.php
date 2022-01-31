<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
	        GroupsTableSeeder::class,
	        FactoriesTableSeeder::class,
            DepartmentsTableSeeder::class,
	        RolesTableSeeder::class,
	        UsersTableSeeder::class,
            RoleUserTableSeeder::class
	    ]);
    }
}

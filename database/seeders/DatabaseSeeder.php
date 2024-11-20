<?php

namespace ModuleMyFoundation\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->command->call('module:migrate', ['module' => 'MyFoundation']);
        
        $this->call(MyFoundationBaseSeeder::class);
        $this->call(MyFoundationDataSeeder::class);
        $this->call(MyFoundationUserSeeder::class);
    }
}

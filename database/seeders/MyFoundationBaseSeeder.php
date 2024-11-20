<?php

namespace ModuleMyFoundation\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Module\System\Imports\BaseImport;

class MyFoundationBaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $path = base_path(
            'modules' . DIRECTORY_SEPARATOR .
                'myfoundation' . DIRECTORY_SEPARATOR .
                'database' . DIRECTORY_SEPARATOR .
                'masters' . DIRECTORY_SEPARATOR .
                'base-seeder.xlsx'
        );

        if (File::exists($path)) {
            Excel::import(new BaseImport($this->command), $path);
        }
    }
}

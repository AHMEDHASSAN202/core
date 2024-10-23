<?php

namespace Modules\Core\Database\Seeders;

use App\Models\Admin\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run(): void
    {
        Admin::factory()->count(1)->create();
    }
}

<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::now();
        DB::statement('DELETE FROM super_admins');
        DB::table('super_admins')->insert([
            [
                'id' => 1,
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'phone' => '01915985336',
                'image' => null,
                'password' => Hash::make(123456),
                'created_at' => $date,
                'updated_at' => $date,
            ],
        ]);
    }
}

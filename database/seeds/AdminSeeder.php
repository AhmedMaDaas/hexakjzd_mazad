<?php

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make(123045),
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make(123045),
            'photo' => 'users/413-4138963_unknown-person-unknown-person-png.png',
            'admin_id' => $admin->id,
        ]);
    }
}

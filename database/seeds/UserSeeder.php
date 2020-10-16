<?php

use App\Models\Fund;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrcreate([
            'email' => 'admin@admin.com',
            'name' => 'Admin',
            'password' => Hash::make('admin'),
            'is_admin' => true,
            'fund_id' => Fund::first()->id,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Example data for seeding
        

        // Seed 5 users with the role 'group'
        $groupUsers = [
            [
                'name' => 'Group_E',
                'email' => 'group_user1@example.com',
                'password' => Hash::make('password123'),
                'role' => 'group',
            ],
            [
                'name' => 'Group_D',
                'email' => 'group_user2@example.com',
                'password' => Hash::make('password123'),
                'role' => 'group',
            ],
            [
                'name' => 'Group_C',
                'email' => 'group_user3@example.com',
                'password' => Hash::make('password123'),
                'role' => 'group',
            ],
            [
                'name' => 'Group_B',
                'email' => 'group_user4@example.com',
                'password' => Hash::make('password123'),
                'role' => 'group',
            ],
            [
                'name' => 'Group_A',
                'email' => 'group_user5@example.com',
                'password' => Hash::make('password123'),
                'role' => 'group',
            ],
        ];

        // Insert data into the users table
        DB::table('users')->insert($groupUsers);

        // Seed 5 users with the role 'guest'
        $guestUsers = [
            [
                'name' => 'Guest User 1',
                'email' => 'guest_user1@example.com',
                'password' => Hash::make('password123'),
                'role' => 'guest',
            ],
            [
                'name' => 'Guest User 2',
                'email' => 'guest_user2@example.com',
                'password' => Hash::make('password123'),
                'role' => 'guest',
            ],
            [
                'name' => 'Guest User 3',
                'email' => 'guest_user3@example.com',
                'password' => Hash::make('password123'),
                'role' => 'guest',
            ],
            [
                'name' => 'Guest User 4',
                'email' => 'guest_user4@example.com',
                'password' => Hash::make('password123'),
                'role' => 'guest',
            ],
            [
                'name' => 'Guest User 5',
                'email' => 'guest_user5@example.com',
                'password' => Hash::make('password123'),
                'role' => 'guest',
            ],
            [
                'name' => 'admin',
                'email' => 'admin@123',
                'password' => Hash::make('admin'),
                'role' => 'admin',
            ],
        ];

        // Insert data into the users table
        DB::table('users')->insert($guestUsers);
    }
}

<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = \App\Role::find(1);      
        $admin = new \App\User([
            'username' => 'admin',
            'fullname' => 'Administrator',
            'email' => 'admin@administrator.com',
            'password' => '1',
            'avatar' => '',
        ]);
        $role1->users()->save($admin);
            
        $role2 = \App\Role::find(2);
        $user1 = new \App\User([
            'role_id' => 2,
            'username' => 'user1',
            'fullname' => 'User 1',
            'email' => 'user1@user.com',
            'password' => '1',
            'avatar' => '',
        ]);
        $role2->users()->save($user1);

        $user2 = new \App\User([
            'role_id' => 2,
            'username' => 'user2',
            'fullname' => 'User 2',
            'email' => 'user2@user.com',
            'password' => '1',
            'avatar' => '',
        ]);
        $role2->users()->save($user2);
    }
}

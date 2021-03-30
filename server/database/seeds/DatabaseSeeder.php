<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // p
        // $this->call(CategoriesTableSeeder::class);
        // $this->call(MenusTableSeeder::class);
        // $this->call(BotsTableSeeder::class);
        // $this->call(RatingsTableSeeder::class);
        // c
        // $this->call(SubcategoriesTableSeeder::class);
        // $this->call(SubmenusTableSeeder::class);
        // $this->call(CommentsTableSeeder::class);
        // $this->call(TagsTableSeeder::class);
        // $this->call(StoresTableSeeder::class);
        
        // $this->call(UsersTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}

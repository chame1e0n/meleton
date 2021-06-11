<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('users')->truncate();
        DB::table('user_books')->truncate();
        DB::table('books')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        DB::table('users')->insert([
            ['id' => 1,   'first_name' => 'Ivan',       'last_name' => 'Ivanov',        'age' => 18,    'email' => 'address1@email.com',    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',    'created_at' => date('Y-m-d H:i:s')],
            ['id' => 2,   'first_name' => 'Marina',     'last_name' => 'Ivanova',       'age' => 14,    'email' => 'address2@email.com',    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',    'created_at' => date('Y-m-d H:i:s')],
            ['id' => 3,   'first_name' => 'Vitalii',    'last_name' => 'Zinkov',        'age' => 7,     'email' => 'address3@email.com',    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',    'created_at' => date('Y-m-d H:i:s')],
            ['id' => 4,   'first_name' => 'Kostya',     'last_name' => 'Shepelev',      'age' => 8,     'email' => 'address4@email.com',    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',    'created_at' => date('Y-m-d H:i:s')],
            ['id' => 5,   'first_name' => 'Max',        'last_name' => 'Shetinin',      'age' => 9,     'email' => 'address5@email.com',    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',    'created_at' => date('Y-m-d H:i:s')],
            ['id' => 6,   'first_name' => 'Iuliana',    'last_name' => 'Kondratenko',   'age' => 10,    'email' => 'address6@email.com',    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',    'created_at' => date('Y-m-d H:i:s')],
        ]);
        DB::table('books')->insert([
            ['id' => 1,   'name' => 'Romeo and Juliet',         'author' => 'William Shakespeare',  'created_at' => date('Y-m-d H:i:s')],
            ['id' => 2,   'name' => 'War and Peace',            'author' => 'Leo Tolstoy',          'created_at' => date('Y-m-d H:i:s')],
            ['id' => 3,   'name' => 'The Hunger Games',         'author' => 'Suzanne Collins',      'created_at' => date('Y-m-d H:i:s')],
            ['id' => 4,   'name' => 'Hamlet',                   'author' => 'William Shakespeare',  'created_at' => date('Y-m-d H:i:s')],
            ['id' => 5,   'name' => 'To Kill a Mockingbird',    'author' => 'Harper Lee',           'created_at' => date('Y-m-d H:i:s')],
            ['id' => 6,   'name' => 'Macbeth',                  'author' => 'William Shakespeare',  'created_at' => date('Y-m-d H:i:s')],
        ]);
        DB::table('user_books')->insert([
            ['id' => 1,   'user_id' => 1,   'book_id' => 2, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 2,   'user_id' => 2,   'book_id' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 3,   'user_id' => 3,   'book_id' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 4,   'user_id' => 3,   'book_id' => 4, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 5,   'user_id' => 4,   'book_id' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 6,   'user_id' => 4,   'book_id' => 4, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 7,   'user_id' => 4,   'book_id' => 5, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 8,   'user_id' => 5,   'book_id' => 3, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 9,   'user_id' => 5,   'book_id' => 4, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 10,  'user_id' => 6,   'book_id' => 4, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 11,  'user_id' => 6,   'book_id' => 6, 'created_at' => date('Y-m-d H:i:s')],
        ]);
    }
}

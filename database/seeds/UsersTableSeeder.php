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
        DB::table('users')->insert([
            'category' => 'ADMIN',
            'status' => 'A',
            'name' => 'ADMINISTRADOR',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin@admin.com'),
        ]);
        
        DB::table('users')->insert([
            'name' => 'CLIENTE TESTE 1',
            'email' => 'cliente1@teste.com',
            'password' => bcrypt('cliente1@teste.com'),
        ]);
        
        DB::table('users')->insert([
            'name' => 'CLIENTE TESTE 2',
            'email' => 'cliente2@teste.com',
            'password' => bcrypt('cliente2@teste.com'),
        ]);
    }
}

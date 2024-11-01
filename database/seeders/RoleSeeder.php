<?php
//
//namespace Database\Seeders;
//
//use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\DB;
//
//class RoleSeeder extends Seeder
//{
//    /**
//     * Run the database seeds.
//     */
//    public function run(): void
//    {
//        // Verifica si el rol 'admin' no existe antes de crearlo
//        if (!DB::table('roles')->where('name', 'admin')->exists()) {
//            DB::table('roles')->insert(['name' => 'admin']);
//        }
//
//        // Verifica si el rol 'user' no existe antes de crearlo
//        if (!DB::table('roles')->where('name', 'user')->exists()) {
//            DB::table('roles')->insert(['name' => 'user']);
//        }
//    }
//}

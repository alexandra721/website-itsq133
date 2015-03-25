<?php

    class UserTableSeeder extends Seeder {

        public function run()
        {
            DB::table('users')->delete();

            User::create(array(
                'username'  =>  'admin',
                'password'  =>  Hash::make('password'),
                'email'     =>  'sarmiento11102@gmail.com',
                'firstname' =>  'Jan Joseph',
                'lastname'  =>  'Sarmiento',
                'role'      =>  'ADMIN'
            ));

            User::create(array(
                'username'  =>  'user',
                'password'  =>  Hash::make('password'),
                'email'     =>  'sarmiento11102@gmail.com',
                'firstname' =>  'Januario',
                'lastname'  =>  'Teves',
                'role'      =>  'USER'
            ));
        }

    }

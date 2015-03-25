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
                'role'      =>  'ADMIN',
                'profile_photo'      =>  '/profile_photos/1.jpg'
            ));

            User::create(array(
                'username'  =>  'admin1',
                'password'  =>  Hash::make('password'),
                'email'     =>  'sarmiento11102@gmail.com',
                'firstname' =>  'Januario',
                'lastname'  =>  'Teves',
                'role'      =>  'ADMIN',
                'profile_photo'      =>  '/profile_photos/2.jpg'
            ));

            User::create(array(
                'username'  =>  'admin2',
                'password'  =>  Hash::make('password'),
                'email'     =>  'sarmiento11102@gmail.com',
                'firstname' =>  'Jones',
                'lastname'  =>  'Doctor',
                'role'      =>  'ADMIN',
                'profile_photo'      =>  '/profile_photos/1.jpg'
            ));

            User::create(array(
                'username'  =>  'user1',
                'password'  =>  Hash::make('password'),
                'email'     =>  'sarmiento11102@gmail.com',
                'firstname' =>  'Jones',
                'lastname'  =>  'Doctor',
                'role'      =>  'USER',
                'profile_photo'      =>  '/profile_photos/1.jpg'
            ));
        }
    }

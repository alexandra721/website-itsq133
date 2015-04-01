<?php

    class UserTableSeeder extends Seeder {

        public function run()
        {
            User::create(array(
                'username'  =>  'super',
                'password'  =>  Hash::make('super'),
                'email'     =>  'sarmiento11102@gmail.com',
                'firstname' =>  'Super',
                'lastname'  =>  'Bat',
                'role'      =>  'ADMIN',
                'profile_photo'      =>  '/profile_photos/1.jpg'
            ));

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
                'username'  =>  'admin3',
                'password'  =>  Hash::make('password'),
                'email'     =>  'sarmiento11102@gmail.com',
                'firstname' =>  'Mike',
                'lastname'  =>  'Hunt',
                'role'      =>  'ADMIN',
                'profile_photo'      =>  '/profile_photos/1.jpg'
            ));

            User::create(array(
                'username'  =>  'user1',
                'password'  =>  Hash::make('password'),
                'email'     =>  'sarmiento11102@gmail.com',
                'firstname' =>  'Chris P.',
                'lastname'  =>  'Bacon',
                'role'      =>  'USER',
                'profile_photo'      =>  '/profile_photos/1.jpg'
            ));

            User::create(array(
                'username'  =>  'user2',
                'password'  =>  Hash::make('password'),
                'email'     =>  'sarmiento11102@gmail.com',
                'firstname' =>  'Max',
                'lastname'  =>  'Well',
                'role'      =>  'USER',
                'profile_photo'      =>  '/profile_photos/1.jpg'
            ));

            User::create(array(
                'username'  =>  'user3',
                'password'  =>  Hash::make('password'),
                'email'     =>  'sarmiento11102@gmail.com',
                'firstname' =>  'Hugh',
                'lastname'  =>  'Jazz',
                'role'      =>  'USER',
                'profile_photo'      =>  '/profile_photos/1.jpg'
            ));

            User::create(array(
                'username'  =>  'user4',
                'password'  =>  Hash::make('password'),
                'email'     =>  'sarmiento11102@gmail.com',
                'firstname' =>  'Dick',
                'lastname'  =>  'Small',
                'role'      =>  'USER',
                'profile_photo'      =>  '/profile_photos/1.jpg'
            ));

            User::create(array(
                'username'  =>  'user5',
                'password'  =>  Hash::make('password'),
                'email'     =>  'sarmiento11102@gmail.com',
                'firstname' =>  'Wang',
                'lastname'  =>  'Jugs',
                'role'      =>  'USER',
                'profile_photo'      =>  '/profile_photos/1.jpg'
            ));
        }
    }

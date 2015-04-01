<?php

    class CommentsTableSeeder extends Seeder {

        public function run()
        {
//            DB::table('users')->delete();

            Comment::create(array(
                'user_id'   =>  1,
                'content'   => 'Sample comment numbah 1',
                'post_id'   =>  1
            ));

            Comment::create(array(
                'user_id'   =>  1,
                'content'   => 'Sample comment numbah 2',
                'post_id'   =>  1
            ));

            Comment::create(array(
                'user_id'   =>  1,
                'content'   => 'Sample comment numbah 4',
                'post_id'   =>  1
            ));

            Comment::create(array(
                'user_id'   =>  1,
                'content'   => 'Sample comment numbah 5',
                'post_id'   =>  1
            ));

            Comment::create(array(
                'user_id'   =>  1,
                'content'   => 'Sample comment numbah 6',
                'post_id'   =>  1
            ));
        }
    }

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
        $u1=App\User::create([

            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'avatar'=>'avatars/avatar.jpg',
            'admin' => 1
        ]);
        $u2=App\User::create([

            'name' => 'Ahmad',
            'email' => 'Ahmad@gmail.com',
            'password' => bcrypt('password'),
            'avatar' => 'avatars/avatar.jpg'
            
        ]);
        $u3=App\User::create([

            'name' => 'Ali',
            'email' => 'Ali@gmail.com',
            'password' => bcrypt('password'),
            'avatar' => 'avatars/avatar.jpg'
            
        ]);
        $u4=App\User::create([

            'name' => 'Rama',
            'email' => 'Rama@gmail.com',
            'password' => bcrypt('password'),
            'avatar' => 'avatars/avatar.jpg'
            
        ]);

        $t1='Laravel';
        $ch1 = App\Channel::create([

            'title' => $t1,
            'slug' =>str_slug($t1)

        ]);
        $t2='PHP';
        $ch2 = App\Channel::create([

            'title' => $t2,
            'slug' => str_slug($t2)

        ]);
        $t3='HTML';
        $ch3 = App\Channel::create([

            'title' => $t3,
            'slug' => str_slug($t3)

        ]);
        $t4 = 'JAVA';
        $ch4 = App\Channel::create([

            'title' => $t4,
            'slug' => str_slug($t4)

        ]);

        $t5= 'What is Laravel ?';
        $d1 = App\Discussion::create([

            'user_id' => $u1->id,
            'channel_id'=>$ch1->id,
            'title' => $t5,
            'slug' => str_slug($t5),
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'

        ]);
        $t6 = ' What is HTTP middleware ?';
        $d2 = App\Discussion::create([

            'user_id' => $u2->id,
            'channel_id' => $ch1->id,
            'title' => $t6,
            'slug' => str_slug($t6),
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'

        ]);
        $t7 = 'How to install PHP on windows ?';
        $d3 = App\Discussion::create([

            'user_id' => $u3->id,
            'channel_id' => $ch2->id,
            'title' => $t7,
            'slug' => str_slug($t7),
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'

        ]);
        $t8 = 'What is HTML ?';
        $d4 = App\Discussion::create([

            'user_id' => $u4->id,
            'channel_id' => $ch3->id,
            'title' => $t8,
            'slug' => str_slug($t8),
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'

        ]);

        $r1=App\Reply::create([

            'user_id'=> $u2->id,
            'discussion_id'=> $d1->id,
            'content'=> 'Lorem ipsum dolor sit amet'

        ]);
        $r2=App\Reply::create([

            'user_id' => $u3->id,
            'discussion_id'=> $d1->id,
            'content' => 'Lorem ipsum dolor sit amet'

        ]);
        $r3=App\Reply::create([

            'user_id' => $u1->id,
            'discussion_id' => $d2->id,
            'content' => 'Lorem ipsum dolor sit amet'

        ]);

        $l1=App\Like::create([
            'user_id'=>$u1->id,
            'reply_id'=>$r1->id
        ]);

        $l2 = App\Like::create([
            'user_id' => $u2->id,
            'reply_id' => $r1->id
        ]);

    }
}

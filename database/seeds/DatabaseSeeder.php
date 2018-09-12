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
        //run seeders
        // $this->call(UsersTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        //delete if info on these exists
        DB::table('users')->truncate();
        DB::table('posts')->truncate();
        DB::table('roles')->truncate();
        DB::table('categories')->truncate();
        DB::table('photos')->truncate();
        DB::table('comment_replies')->truncate();

        //runs factory for user and his or her post
        factory(App\User::class, 10)->create()->each(function ($user){

            $user->posts()->save(factory(App\Post::class)->create());

        });

        //fill roles table
        factory(App\Role::class, 3)->create();
        //fill categories table
        factory(App\Category::class, 10)->create();
        //fill photos table
        factory(App\Photo::class, 1)->create();
        //fill comments and their replies table
        factory(App\Comment::class, 10)->create()->each(function ($comment){

            $comment->commentreplies()->save(factory(App\CommentReply::class)->create());

        });

    }
}

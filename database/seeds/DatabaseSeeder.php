<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
    	for ($i=0; $i < 20; $i++) { 
    		$post = new App\Post;
    		$post->title = $faker->sentence;
    		$post->body = $faker->paragraph;
    		$post->category_id = rand(1, 5);
            $post->user_id = rand(1,2);
    		$post->save();
    	}

        $categories = ['General','Technology','Computer','Internet','Moblie'];
        foreach ($categories as $name) {
            $category= new App\Category;
            $category ->name =$name;
            $category->save();
        }

        for ($i=0; $i <20 ; $i++) { 
            $comment=new App\Comment;
            $comment->comment=$faker->paragraph;
            $comment->post_id = rand(10, 20);
            $comment->save();
        }

        $bob = new App\User;
        $bob->name='Bob';
        $bob->email='bob@gmail.com';
        $bob->password=bcrypt('123456');
        $bob->save();

        $alice = new App\User;
        $alice->name='Alice';
        $alice->email='alice@gmail.com';
        $alice->password=bcrypt('12345678');
        $alice->save();
        // $this->call(UsersTableSeeder::class);
    }
}

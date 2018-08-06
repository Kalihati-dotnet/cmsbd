<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class PostsCategoryAndMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [ 
              'id' => 1,
              'parent_id'=>null,
              'name' => 'Category 1',
              'created_at' => now()
            ],
            [ 
              'id' => 2,
              'parent_id'=>1,
              'name' => 'Category 1 of 1',
              'created_at' => now()
            ],
            [
              'id' => 3,
              'parent_id'=>1,
              'name' => 'Category 2 of 1',
              'created_at' => now()
            ],
            [
              'id' => 4,
              'parent_id'=>null,
              'name' => 'Category 2',
              'created_at' => now()
            ],
            [ 
              'id' => 5,
              'parent_id'=>4,
              'name' => 'Category 1 of 2',
              'created_at' => now()
            ],
            [ 
              'id' => 6,
              'parent_id'=>null,
              'name' => 'JavaScript',
              'created_at' => now()
            ],
            [ 
              'id' => 7,
              'parent_id'=>null,
              'name' => 'PHP',
              'created_at' => now()
            ],
            [ 
              'id' => 8,
              'parent_id'=>null,
              'name' => 'MySQL',
              'created_at' => now()
            ],
        ]);
    
        $faker = Factory::create();
        //  Product::truncate();
          foreach(range(1,25) as $i){
            \App\Models\Post::create([
                  "user_id"=> $faker->numberBetween(1,5),
                  "slug" => $faker->slug,
                  "title" => $faker->name,
                  "body" => $faker->text,
                  "excerpt" => $faker->text,
                  "status"=>'PUBLISHED',
                  "category_id"=> $faker->numberBetween(1,8),
              ]);
          }
  
          foreach(range(1,10) as $i){
            \App\Models\Tag::create([
                  "name" => $faker->word,
                  "created_at" => now()
              ]);
          }
          foreach(range(1,10) as $i){
            \App\Models\PostTag::create([
                  "post_id" =>$faker->unique()->numberBetween(1,25),
                  "tag_id" =>$faker->numberBetween(1,10)
              ]);
          }
    
          DB::table('menus')->insert([
            ['id' => 1, 'parent_id'=>null,'name' => 'Menus', 'created_at' => now()],
            ['id' => 2, 'parent_id'=>null,'name' => 'Resources','created_at' => now()],
            ['id' => 3, 'parent_id'=>1,'name' => 'Main','created_at' => now()],
            ['id' => 4, 'parent_id'=>1, 'name' => 'Aside', 'created_at' => now() ],
            ['id' => 5, 'parent_id'=>1,'name' => 'Footer','created_at' => now()],
            ['id' => 6, 'parent_id'=>3,'name' => 'Education', 'created_at' => now()],
            ['id' => 7, 'parent_id'=>6,'name' => 'Math','created_at' => now()],
            ['id' => 8, 'parent_id'=>6, 'name' => 'English','created_at' => now()],
            ['id' => 9, 'parent_id'=>3, 'name' => 'Open Source','created_at' => now()],
            ['id' => 10, 'parent_id'=>9,'name' => 'Software','created_at' => now()]
        ]);

    }
}

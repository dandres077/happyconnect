<?php

use Illuminate\Database\Seeder;
use App\Blogs;

class BlogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Blogs::class, 10)->create();
    }
}

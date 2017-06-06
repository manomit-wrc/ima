<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = new \App\Category();
        $categories->name = "Category-1";
        $categories->status = "1";
        
        $categories->save();


        $categories1 = new \App\Category();
        $categories1->name = "Category-2";
        $categories1->status = "1";
        
        $categories1->save();


        $categories2 = new \App\Category();
        $categories2->name = "Category-3";
        $categories2->status = "1";
        
        $categories2->save();


        $categories3 = new \App\Category();
        $categories3->name = "Category-4";
        $categories3->status = "1";
        
        $categories3->save();
    }
}

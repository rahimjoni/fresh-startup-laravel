<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::updateOrCreate([

            'title'             => 'About Us',
            'slug'              => 'about-us',
            'excerpt'           => 'This is about page',
            'body'              => '<h1>This is title</h1>',
            'meta_description'  => 'This is meta description',
            'meta_keyword'      => 'about, etc',
            'status'            => true,
        ]);
    }
}

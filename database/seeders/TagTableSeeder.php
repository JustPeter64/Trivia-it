<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tag = new \App\Models\Tag();
        $tag->name = 'Leerzaam';
        $tag->save();

        $tag = new \App\Models\Tag();
        $tag->name = 'Grappig';
        $tag->save();

        $tag = new \App\Models\Tag();
        $tag->name = 'Moeilijk';
        $tag->save();

        $tag = new \App\Models\Tag();
        $tag->name = 'Makkelijk';
        $tag->save();

        $tag = new \App\Models\Tag();
        $tag->name = 'Dieren';
        $tag->save();

        $tag = new \App\Models\Tag();
        $tag->name = 'Sport';
        $tag->save();

        $tag = new \App\Models\Tag();
        $tag->name = 'Geschiedenis';
        $tag->save();

        $tag = new \App\Models\Tag();
        $tag->name = 'Aardrijkskunde';
        $tag->save();

        $tag = new \App\Models\Tag();
        $tag->name = 'Wetenschap';
        $tag->save();

        $tag = new \App\Models\Tag();
        $tag->name = 'Technologie';
        $tag->save();

        $tag = new \App\Models\Tag();
        $tag->name = 'Muziek';
        $tag->save();

        $tag = new \App\Models\Tag();
        $tag->name = 'Film';
        $tag->save();
    }
}

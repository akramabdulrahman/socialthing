<?php

use Illuminate\Database\Seeder;

class mediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Media::class, 1)->create()->each(function($s) {
            $s->save();
        });;

    }
}

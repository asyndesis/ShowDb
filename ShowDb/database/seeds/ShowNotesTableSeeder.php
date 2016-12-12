<?php

use Illuminate\Database\Seeder;

class ShowNotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = array_map('str_getcsv', file(__DIR__ . '/../../resources/seeds/show_notes.csv'));

        foreach($csv as $entry) {
            DB::table('show_notes')->insert([
                'show_id'    => $entry[0],
                'user_id'    => $entry[1],
                'note'       => $entry[2],
                'published'  => $entry[3],
                'creator_id' => $entry[5],
                'order'      => $entry[6],
            ]);
        }

    }
}

<?php

use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // medicijn seed 1
        DB::table('medicines')->insert([
            'naam' => 'Paracetamol',
            'dosering' => '1 pil',
            'wanneer' => '7d',
            'datum_van' => '2020/09/30',
            'datum_tot' => '2020/10/30',
            'tijd' => '20:00'
        ]);

         // medicijn seed 1
         DB::table('medicines')->insert([
            'naam' => 'Ibuprofen',
            'dosering' => '2 mg',
            'wanneer' => '4d',
            'datum_van' => '2020/06/30',
            'datum_tot' => '2020/10/30',
            'tijd' => '19:00'
        ]);
    }
}

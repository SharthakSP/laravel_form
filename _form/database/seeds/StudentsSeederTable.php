<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
           [
               'roll_no'=>12,
               'name'=>"Sharthak Sharma",
               'class'=>"Bs.IT"
           ],
            [
                    'roll_no'=>11,
                    'name'=>"Sharthak Poudel",
                    'class'=>"Bs.IT(Honors)"
            ]
        ]);
    }
}

<?php
use App\City;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->delete();
        City::create(array('id' => 1, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 'name' => 'Riga', 'country_id' => 1));
        City::create(array('id' => 2, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 'name' => 'Valka', 'country_id' => 1));
        City::create(array('id' => 3, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 'name' => 'Liepāja', 'country_id' => 1));
        City::create(array('id' => 4, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 'name' => 'Tallinn', 'country_id' => 2));
        City::create(array('id' => 5, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 'name' => 'Vilnus', 'country_id' => 3));
        City::create(array('id' => 6, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 'name' => 'Madrid', 'country_id' => 5));
        City::create(array('id' => 7, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 'name' => 'London', 'country_id' => 4));
        City::create(array('id' => 8, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 'name' => 'Leiden', 'country_id' => 6));
        City::create(array('id' => 9, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 'name' => 'Jelgava', 'country_id' => 1));
        City::create(array('id' => 10, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 'name' => 'Rēzekne', 'country_id' => 1));
        City::create(array('id' => 11, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 'name' => 'Ventspils', 'country_id' => 1));
    }
}


  
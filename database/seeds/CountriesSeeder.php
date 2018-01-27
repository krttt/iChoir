<?php
use App\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();
        Country::create(array(
        	'id' => 1, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 
        	'name' => 'Latvia'));
        Country::create(array(
            'id' => 2, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 
            'name' => 'Estonia'));
        Country::create(array(
            'id' => 3, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 
            'name' => 'Lithuania'));
        Country::create(array(
            'id' => 4, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 
            'name' => 'Great Brittain'));
        Country::create(array(
            'id' => 5, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 
            'name' => 'Spain'));
        Country::create(array(
            'id' => 6, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 
            'name' => 'Netherlands'));
    }
}

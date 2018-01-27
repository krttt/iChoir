<?php
use App\Event;
use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->delete();
        Event::create(array(
        	'id' => 1, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 
        	'name' => 'Pavasara koncerts',
            'date' => '2018-03-22',
            'begin_time' => '19:00:00',
            'end_time' => '21:00:00',
            'price' => '10.00',
            'description' => 'Koris ielūdz uz pavasara atklāšanas koncertu!',
            'city_id' => 1,
            'choir_id' => 1
        ));
        Event::create(array(
            'id' => 2, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 
            'name' => 'Krustiem zvaigznes debesīs',
            'date' => '2018-01-20',
            'begin_time' => '17:00:00',
            'end_time' => '19:00:00',
            'price' => '0.00',
            'description' => 'Ielūdzam uz koncertu Baložu kultūras namā - piedalās sieviešu koris "Ziemeļstīga", vīru ansamblis "Lai skan", bērnu ansamblis "Baltā dūja", VP deju kolektīvs "Baloži", kā arī RTU jauktais koris "Vivere". Gaidīsim jūs!',
            'city_id' => 1,
            'choir_id' => 1
        ));
        Event::create(array(
            'id' => 3, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 
            'name' => 'Baltic Tour 2018',
            'date' => '2018-01-18',
            'begin_time' => '19:00:00',
            'end_time' => '21:00:00',
            'price' => '0.00',
            'description' => 'Jauniešu koris BALSIS un koris CENTRE CHORALE satiksies Mazajā Ģildē. Koncertā 18. janvārī 19.00 telpu piepildīs Baltijas valstu komponistu skaņdarbi un mūzika no Amerikas Savienotajām Valstīm - korāļi, folk, pop, garīgā mūzika, Amerikas pamatiedzīvotāju un tautas mūzika. Ieeja bez maksas.',
            'city_id' => 1,
            'choir_id' => 2
        ));

        Event::create(array(
            'id' => 4, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 
            'name' => 'Viveres Ziemas pārgājiens III',
            'date' => '2018-02-15',
            'begin_time' => '11:00:00',
            'end_time' => '21:00:00',
            'price' => '0.00',
            'description' => 'Ikgadējais ziemas pārgājiens tuvojas! Sagatavojam siltas zeķes, tēju un labu garastāvokli :)',
            'city_id' => 2,
            'choir_id' => 1,
            'private' => 1
        ));

    }
}


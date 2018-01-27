<?php
use App\Choir;
use Illuminate\Database\Seeder;

class ChoirsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('choirs')->delete();
        Choir::create(array('id' => 1, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 'name' => 'Vivere',
            'description' => 'Koris dibināts 2007. gadā kā Rīgas Tehniskās universitātes Rīgas biznesa skolas koris. 2013. gada septembrī tas pārtapa par Rīgas Tehniskās universitātes jaukto kori "Vivere". Vārds "Vivere" tulkojumā no latīņu valodas nozīmē "dzīvot". Korī apvienojušies studenti un dažādu profesiju pārstāvji ar dažādu dzīves pieredzi, bet mūs visus vieno mūzika un dziedātprieks. Kori vada dziesmu svētku virsdiriģents Gints Ceplenieks.'
             ));
        Choir::create(array('id' => 2, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 'name' => 'Balsis',
 'description' => 'Latvian youth choir BALSIS is audible proof of the idea that "Latvia is the land that sings!". Founded in 1987 and currently led by Artistic Director Ints Teterovskis and Conductor Laura Leontjeva, youth choir BALSIS is one of Latvia’s most accomplished choirs. The choir comprises singers from Riga, many of whom are students and others who have professional careers.'
    ));
        Choir::create(array('id' => 3, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 'name' => 'Aura',
 'description' => 'The mixed choir of University of Latvia the faculty of Physics and Mathematics conducted by Edgars Vitols.'
    ));
    }
}



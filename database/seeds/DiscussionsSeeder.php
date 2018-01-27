<?php
use App\Discussion;
use Illuminate\Database\Seeder;

class DiscussionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discussions')->delete();
        Discussion::create(array(
        	'id' => 1, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 
        	'topic' => 'Recovering from flu',
            'text' => 'I recently caught a cold and at first my voice didnt seem to be affected at all, but then I completely lost my voice. After some time my chest voice came back, and then a few days later I had my falsetto.
				Fast forward two weeks, and my mixed voice and range is still completely gone (and the dry post-flu cough seems to be persisting)! I cant sing a tune if my life dependent on it. All I hear is screechy distortion all over the place, as if this was the first time I ever sang.
How to recover from the illness? What sort of practice routine should I exercise to strengthen the mixed voice and get the chords conducting again? Do you think antibiotics would help?',
            'created_at' => '2018-01-15 21:00:00',
            'user_id' => 3
        ));

        Discussion::create(array(
            'id' => 2, 'created_at' => '2018-01-12 16:00:00', 'updated_at' => '2018-01-12 16:00:00', 
            'topic' => 'Rītdienas mēģinājuma plāns',
            'text' => '
Labvakar! 

Rītdienas mēģinājuma plāns: 
Sākam 18.30! 
1) 18.30 sākas kustību mēģinājums 
2) 19.45 sākas darbs ar diriğentēm, kas nāk pie mums uz diriģēšanas "interviju" 
3) 20.00 sākas mērīšanās tautu tērpiem, bet paralēli turpinās mēģinājums. 

Lūdzu, esam visi obligāti un laicīgi. Ja kāds tiek tikai uz mērīšanos, lūdzu esiet! ',
            'created_at' => '2018-01-10 17:00:00',
            'user_id' => 2,
            'private' => 1,
            'choir_id' => 1
        ));
    }
}





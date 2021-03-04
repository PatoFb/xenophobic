<?php

namespace App\Http\Controllers;

use App\Models\Emotion;
use Illuminate\Support\Facades\DB;

class EmotionsController extends Controller
{
    public function extract_emotion() {
        require('C:/xampp/htdocs/xenophobic/vendor/paralleldots/apis/autoload.php');
        $key1 = "6KxccbNLUwbPiAWE3pVOlTfFeEQWqHGobleBZQXr2fo";
        set_api_key($key1);
        get_api_key();
        $tweets = Emotion::orderBy('ID', 'asc')->get();
        foreach($tweets as $tweet) {
            $text = $tweet->Text;
            $id = $tweet->ID;

            $values = emotion($text);
            $emotion = json_decode($values, true);
            $Happy = $emotion['emotion']['Happy'];
            $Fear = $emotion['emotion']['Fear'];
            $Angry = $emotion['emotion']['Angry'];
            $Sad = $emotion['emotion']['Sad'];
            $Excited = $emotion['emotion']['Excited'];
            $Bored = $emotion['emotion']['Bored'];
            DB::table('emotions')
                ->where('ID', $id)
                ->update(['Happy' => $Happy, 'Fear' => $Fear, 'Angry' => $Angry, 'Sad' => $Sad, 'Excited' => $Excited, 'Bored' => $Bored]);
            sleep(3);
        }
        return redirect('/');
    }
}

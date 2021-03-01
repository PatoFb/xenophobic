<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MeaningCloud\MCRequest;
use MeaningCloud\MCLangResponse;
use MeaningCloud\MCSentimentRequest;

//My keys, use your own >:c
//$key1 = "6KxccbNLUwbPiAWE3pVOlTfFeEQWqHGobleBZQXr2fo";
//$key2 = "J2dPe9qEdFqd6Jm5K0SMBL2HigVSj8yhJFZesztSuTs";
//$license_key = '9c9a628658c69a4282cfddf0a2e91a3f';

class FeaturesController extends Controller
{
    public function extract() {
        require('C:/xampp/htdocs/xenophobic/vendor/paralleldots/apis/autoload.php');
        $key1 = "Your first ParallelDots key";
        $key2 = "Your second ParallelDots key";
        set_api_key($key1);
        get_api_key();
        $server = 'https://api.meaningcloud.com/';
        $license_key = 'Your MeaningCloud key';
        $tweets = Feature::orderBy('ID', 'asc')->get();
        $i = 0;
        foreach($tweets as $tweet) {
            $text = $tweet->Text;
            $id = $tweet->ID;

            $mc = new MCRequest($server.'lang-2.0', $license_key);
            $mc->setContentTxt($text);
            $langResponse = new MCLangResponse($mc->sendRequest());
            $languages = $langResponse->getLanguages();
            $language = $languages[0];
            $codeLanguage = $langResponse->getLanguageCode($language);
            $mc_sentiment = new MCSentimentRequest($license_key, $codeLanguage, $text);
            $sentimentsResponse = $mc_sentiment->sendSentimentRequest();
            $agreement = $sentimentsResponse->getGlobalAgreement();
            $score_tag = $sentimentsResponse->getGlobalScoreTag();
            $subjectivity = $sentimentsResponse->getSubjectivity();
            $confidence = $sentimentsResponse->getGlobalConfidence();
            $irony = $sentimentsResponse->getIrony();

            $values = emotion($text);
            $emotion = json_decode($values, true);
            $Happy = $emotion['emotion']['Happy'];
            $Fear = $emotion['emotion']['Fear'];
            $Angry = $emotion['emotion']['Angry'];
            $Sad = $emotion['emotion']['Sad'];
            $Excited = $emotion['emotion']['Excited'];
            $Bored = $emotion['emotion']['Bored'];
            DB::table('features')
                ->where('ID', $id)
                ->update(['Happy' => $Happy, 'Fear' => $Fear, 'Angry' => $Angry, 'Sad' => $Sad, 'Excited' => $Excited, 'Bored' => $Bored,
                    'agreement' => $agreement, 'score_tag' => $score_tag, 'subjectivity' => $subjectivity, 'confidence' => $confidence, 'irony' => $irony]);
            if(++$i == 850) {
                set_api_key($key2);
                get_api_key();
            }
            sleep(4);
        }
        return redirect('/');
    }
}

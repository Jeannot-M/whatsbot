<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SynthesisController extends Controller
{
    public function index()
    {
        // streaming chunk size string
        define('CHUNK_SIZE', 1024);

        $XI_API_KEY = "800ba45d3daf9456376d5863e7f95651";
        $VOICE_SAMPLE_PATH1 = public_path('audios/file1.mp3');
        $VOICE_SAMPLE_PATH2 = public_path('audios/file1.mp3');
        $OUTPUT_PATH = public_path('audios/file1.mp3');

        $add_voice_url = "https://api.elevenlabs.io/v1/voices/add";

        $headers = [
            "Accept" => "application/json",
            "xi-api-key" => $XI_API_KEY
        ];

        $data = [
            "voice_id" => "AZnzlk1XvdvUeBnXmlld",
            'name' => 'Domi',
            'labels' => '{"accent": "American", "gender": "Female"}',
            'description' => 'An old American male voice with a slight hoarseness in his throat. Perfect for news.'
        ];

        $files = [
            [
                'name' => 'files',
                'contents' => fopen($VOICE_SAMPLE_PATH1, 'r'),
                'filename' => 'sample1.mp3',
                'headers' => [
                    'Content-Type' => 'audio/mpeg'
                ]
            ],
            [
                'name' => 'files',
                'contents' => fopen($VOICE_SAMPLE_PATH2, 'r'),
                'filename' => 'sample2.mp3',
                'headers' => [
                    'Content-Type' => 'audio/mpeg'
                ]
            ]
        ];

        $response = Http::withHeaders($headers)->attach($files)->post($add_voice_url, $data);
        $voice_id = $response->json()["voice_id"];

        // get default voice settings
        $response = Http::withHeaders(["Accept" => "application/json"])
            ->get("https://api.elevenlabs.io/v1/voices/settings/default")
            ->json();
        $stability = $response["stability"];
        $similarity_boost = $response["similarity_boost"];

        $tts_url = "https://api.elevenlabs.io/v1/text-to-speech/{$voice_id}/stream";

        $headers["Content-Type"] = "application/json";

        $data = [
            "text" => "Je me demande Some very long text to be read by the voice",
            "model_id" => "eleven_monolingual_v1",
            "voice_settings" => [
                "stability" => $stability,
                "similarity_boost" => $similarity_boost
            ]
        ];

        $response = Http::withHeaders($headers)->post($tts_url, $data, ['stream' => true]);

        $file = fopen($OUTPUT_PATH, 'w');

        $response->getBody()->rewind(); // Rembobiner le corps de la réponse

        foreach ($response->getBody()->getContents() as $chunk) {
            fwrite($file, $chunk);
        }

        fclose($file);


        // Retrieve history. It should contain generated sample.
        $history_url = "https://api.elevenlabs.io/v1/history";

        $headers = [
            "Accept" => "application/json",
            "xi-api-key" => $XI_API_KEY
        ];

        $response = Http::withHeaders($headers)->get($history_url);

        return $response->body();
    }
}

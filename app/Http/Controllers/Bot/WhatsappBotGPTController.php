<?php

namespace App\Http\Controllers\Bot;

use OpenAI;
use App\Models\Whatsapp;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Twilio\Rest\Client as TwilioClient;

class WhatsappBotGPTController extends Controller
{
    
    public function incoming(Request $request)
    {

        $phone = $request->input('From');
        $message = $request->input('Body');

        // Trouver l'utilisateur ou le créer s'il n'existe pas
        // $user = Whatsapp::firstOrCreate(['phone_number' => $phone,'last_message' => $message]);

        // Augmenter le compteur de messages de l'utilisateur
        // $user->message_count++;
        // $user->save();

        // Si l'utilisateur a envoyé trois messages, envoyer un message de souscription
        // if ($user->message_count === 3) {
        //     $this->sendSubscriptionMessage($phone);
        // }
        
        // Traitement des messages entrants avec GPT-3.5-turbo
        $response = $this->processWithGpt($message);

        // Envoyer la réponse à l'utilisateur
        $this->sendMessage($phone, $response);
    }


    private function sendMessage($to, $message)
    {
        $twilio = new TwilioClient(env('TWILIO_SID'), env('TWILIO_TOKEN'));

        $twilio->messages->create('whatsapp:' . $to, [
            'from' => 'whatsapp:' . env('TWILIO_WHATSAPP_NUMBER'),
            'body' => $message
        ]);
    }
    public function processWithGpt($prompt)  
    {
        try {
            $apikey  = env('OPENAI_API_KEY');
            $client = OpenAI::client($apikey);

        
            $result = $client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => $prompt,
                    ],
                    [
                        'role' => 'user',
                        'content' => "Ecris-moi un poeme à l'africaine",
                    ]
                ],
            ]);
        
            if(isset($result['choices']) && isset($result['choices'][0]) && isset($result['choices'][0]['message']) && isset($result['choices'][0]['message']['content'])) {
                echo $result['choices'][0]['message']['content'];
            } else {
                // Handle the case where no response was generated
                echo "No response was generated";
            }
    
        } catch (\Exception $e) {
            // handle exception
            echo "An error occurred: " . $e->getMessage();
        }
    }





}

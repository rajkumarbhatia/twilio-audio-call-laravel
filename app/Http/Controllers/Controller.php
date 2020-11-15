<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Twilio\Rest\Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VoiceGrant;
use Twilio\TwiML\VoiceResponse;
use Illuminate\Http\Request;
use Twilio\Jwt\ClientToken;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
    	return view("index");
    }

    public function token(Request $request){
    	$data = $request->all();

    	$twilioAccountSid = env("TWILIO_ACCOUNT_SID");
		$twilioApiKey = env("TWILIO_API_KEY");
		$twilioApiSecret = env("TWILIO_API_SECRET");

		// Required for Voice grant
		$outgoingApplicationSid = env("TWILIO_SID");
		// An identifier for your app - can be anything you'd like
		$identity = $data["identity"]; // Jack // Client name

		// Create access token, which we will serialize and send to the client
		$token = new AccessToken(
		    $twilioAccountSid,
		    $twilioApiKey,
		    $twilioApiSecret,
		    3600,
		    $identity
		);

		// Create Voice grant
		$voiceGrant = new VoiceGrant();
		$voiceGrant->setOutgoingApplicationSid($outgoingApplicationSid);

		// Optional: add to allow incoming calls
		$voiceGrant->setIncomingAllow(true);

		// Add grant to token
		$token->addGrant($voiceGrant);

		return response()->json([
			"identity" => $data['identity'],
			"token" => $token->toJWT() 
		]);


    }

    public function voice(Request $request){

    	$data = $request->all();
    	$response = new VoiceResponse();

    	// make sure you passing caller id from client side. 
    	// Twilio.Device.connect(params); <----- in param object
		$dial = $response->dial('', ['callerId' => $data["outgoing_caller_id"]]);
		$client = $dial->client($request->To);

		// Sending custom parameters, We will use in client side 
		$client->parameter([
            "name" => "outgoing_caller_id",
            "value" => $data["outgoing_caller_id"],
        ]);

		return $response;

    }
}
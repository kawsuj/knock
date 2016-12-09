<?php

use Knock\Transaction;
use Knock\Event;
use Illuminate\Support\Str;

function logEvent($event_code, $event_data, $transaction_id=null){
 	$tx;
	if ($transaction_id === null){
		$tx = new Transaction;
		$tx->save();
		$transaction_id = $tx->id;
	}

	$event = new Event();
	$event->transaction = $transaction_id;
	$event->event_code = Str::slug($event_code);
	$event->event_data = $event_data;
	$event->save();

	return $transaction_id; 
}

function get_client_ip() {
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
			else if(getenv('HTTP_X_FORWARDED'))
				$ipaddress = getenv('HTTP_X_FORWARDED');
				else if(getenv('HTTP_FORWARDED_FOR'))
					$ipaddress = getenv('HTTP_FORWARDED_FOR');
					else if(getenv('HTTP_FORWARDED'))
						$ipaddress = getenv('HTTP_FORWARDED');
						else if(getenv('REMOTE_ADDR'))
							$ipaddress = getenv('REMOTE_ADDR');
							else
								$ipaddress = 'UNKNOWN';
								return $ipaddress;
}

function getLocation(){
	$json = file_get_contents("http://freegeoip.net/json/".get_client_ip());
	return $json;
}


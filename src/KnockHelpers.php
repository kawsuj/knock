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
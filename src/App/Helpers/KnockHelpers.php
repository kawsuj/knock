<?php


function logEvent($event_code, $event_data, $transaction=null){
	//Uncomment or use your own logging
/* 	$tx;

	if ($transaction === null){
		$tx = new Transaction;
		$tx->save();
		$transaction = $tx->id;
	}

	$event = new Event();
	$event->transaction = $transaction;
	$event->event_code = Str::slug($event_code);
	$event->event_data = $event_data;
	$event->save();

	return $transaction; */
}
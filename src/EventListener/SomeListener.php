<?php

// src/EventListener/SomeListener.php

namespace App\EventListener;

use App\Event\SomeEvent;
use Psr\Log\LoggerInterface;


class SomeListener
{
	function __construct(SomeEvent $event, LoggerInterface $logger)
	{
		$this->event = $event;
		$this->logger = $logger;
	}

	public function onSomeEevent()
	{
		
		$data = $this->event->getData();
		$this->logger->info('Some event occurred with data: ' . $data);
	}
}
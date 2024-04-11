<?php

// src/Event/SomeEvent.php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;


class SomeEvent extends Event
{

	const NAME = "some.event";

	protected $data;

	public function __construct($data = null)
	{
		$this->data = $data;
	}

	public function getData()
	{
		return $this->data; 
	}

	public function setData(string $data): self
	{
		$this->data = $data;
		return $this;
	}
}
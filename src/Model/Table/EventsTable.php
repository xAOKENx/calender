<?php

  namespace APP\Model\Table;

  use Cake\ORM\Table;

  class EventsTable extends Table
  {
    public function initialize(array $config)
    {
    $this->addBehavior('Timestamp');
    }
  }

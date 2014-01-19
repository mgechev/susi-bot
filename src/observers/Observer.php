<?php

/* Requires enums/Events.php */

abstract class Observer {
  private $events;

  public function __construct($events) {
    if (!is_array($events)) {
      $events = array($events);
    }
    $this->events = $events;
  }

  public function notify($event, $message, $subject = '') {
    if (in_array($event, $this->events)) {
      $this->notifyHelper($message, $subject);
    }
  }

  abstract protected function notifyHelper($message, $subject);
}

?>
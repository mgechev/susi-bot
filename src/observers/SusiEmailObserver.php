<?php

/* Requires enums/Events.php observers/Observer.php */

class SusiEmailObserver extends Observer {
  private $email;
  private $events;

  public function __construct($events, $email) {
    $this->email = $email;
    parent::__construct($events);
  }

  protected function notifyHelper($message, $subject) {
    mail($this->email, $subject, $message);
  }
}

?>
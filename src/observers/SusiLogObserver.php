<?php

/* Requires enums/Events.php observers/Observer.php */

class SusiLogObserver extends Observer {
  private $newLine;
  private $count;

  public function __construct($events, $newLine) {
    parent::__construct($events);
    $this->newLine = $newLine;
    $this->count = 0;
  }

  protected function notifyHelper($message, $subject) {
    $this->count += 1;
    echo $this->count . '. ' . $subject . ' - ' . $message . $this->newLine;
  }

}

?>
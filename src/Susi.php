<?php

require_once('proxy/SusiProxy.php');
require_once('enums/Events.php');

class Susi {

  private $susi;
  private $observers;

  public function __construct($username, $password, $observers) {
    $this->susi = new SusiProxy($username, $password);
    if (!is_array($observers)) {
      $observers = array($observers);
    }
    $this->observers = $observers;
  }

  public function login() {
    $result = $this->susi->login();
    if ($result) {
      $this->notify(Events::LOGGED_IN, 'You\'ve logged in successfully.', 'SUSI - Logged in');
    } else {
      $this->notify(Events::NOT_LOGGED_IN, 'You\'ve NOT logged in.', 'SUSI - Not logged in');
    }
  }

  public function isCampaignStarted() {
    $result = $this->susi->isCampaignStarted();
    if ($result) {
      $this->notify(Events::CAMPAIGN_STARTED, 'Campaign have been started.', 'SUSI - Campaign started');
    } else {
      $this->notify(Events::CAMPAIGN_NOT_STARTED, 'Campaign have NOT been started.', 'SUSI - Campaign not started');
    }
  }

  public function addDiscipline($discipline) {
    $result = $this->susi->addDiscipline($discipline);
    if ($result) {
      $this->notify(Events::ADD_DISCIPLINE_SUCCESS, $discipline . ' have been successfully added!', 'SUSI - ' . $discipline);
    } else {
      $this->notify(Events::ADD_DISCIPLINE_FAIL, $discipline . ' can not be added!', 'SUSI - Fail ' . $discipline);
    }
  }

  private function notify($event, $message, $subject = '') {
    $count = count($this->observers);
    for ($i = 0; $i < $count; $i += 1) {
      $this->observers[$i]->notify($event, $message, $subject);
    }
  }
}

?>
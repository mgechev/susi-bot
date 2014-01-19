<?php

header('Content-type: text/plain');

require_once('src/Susi.php');
require_once('src/observers/Observer.php');
require_once('src/observers/SusiEmailObserver.php');
require_once('src/observers/SusiLogObserver.php');
require_once('src/enums/Events.php');

$observers = array(new SusiEmailObserver(array(Events::ADD_DISCIPLINE_SUCCESS), 'mgechev@gmail.com'),
                   new SusiLogObserver(array(Events::ADD_DISCIPLINE_SUCCESS, Events::ADD_DISCIPLINE_FAIL,
                                            Events::LOGGED_IN, Events::NOT_LOGGED_IN, Events::CAMPAIGN_STARTED, Events::CAMPAIGN_NOT_STARTED), "\n"));

$susi = new Susi('USERNAME', 'PASSWORD', $observers, $options);

$susi->login();
$susi->isCampaignStarted();
$susi->addDiscipline('Практическо програмиране с Perl');
$susi->addDiscipline('Програмиране с Ruby on Rails');
$susi->addDiscipline('Многоплатформени мобилни приложения');

?>

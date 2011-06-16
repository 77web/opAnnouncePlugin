<?php

include dirname(__FILE__).'/../../bootstrap/functional.php';

$browser = new opTestFunctional(new sfBrowser(), new lime_test(null, new lime_output_color()));
$browser->setMobile();

include dirname(__FILE__).'/../../bootstrap/database.php';

//non-member access
$browser
  ->get('/announce/list')
    ->isStatusCode(200)
    ->with('request')->begin()
      ->isParameter('module', 'announce')
      ->isParameter('action', 'list')
    ->end()
;
//insecure announce
$browser
  ->get('/announce/1')
    ->isStatusCode(200)
    ->with('request')->begin()
      ->isParameter('module', 'announce')
      ->isParameter('action', 'show')
    ->end()
;
//secure announce
$browser
  ->get('/announce/2')
    ->isForwardedTo('member', 'login')
;

//member access
$browser->login('sns@example.com', 'password');
$browser->setCulture('en');
//list
$browser->get('/announce/list')
  ->isStatusCode(200)
    ->with('request')->begin()
      ->isParameter('module', 'announce')
      ->isParameter('action', 'list')
    ->end()
;
//insecure announce
$browser
  ->get('/announce/1')
    ->isStatusCode(200)
    ->with('request')->begin()
      ->isParameter('module', 'announce')
      ->isParameter('action', 'show')
    ->end()
;
//secure announce
$browser
  ->get('/announce/2')
    ->isStatusCode(200)
    ->with('request')->begin()
      ->isParameter('module', 'announce')
      ->isParameter('action', 'show')
    ->end()
;
//for pc announce
$browser
  ->get('/announce/5')
    ->isStatusCode(404)
    ->with('request')->begin()
      ->isParameter('module', 'announce')
      ->isParameter('action', 'show')
    ->end()
;
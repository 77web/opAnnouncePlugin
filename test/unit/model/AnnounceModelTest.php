<?php

include(dirname(__FILE__).'/../../bootstrap/unit.php');
include(dirname(__FILE__).'/../../bootstrap/database.php');

$t = new lime_test(23, new lime_output_color());

$table = Doctrine::getTable('Announce');
$ordinary_announce = $table->find(1);
$before_pub_date_announce = $table->find(3);
$draft_announce = $table->find(4);

//check is public
$t->diag('Announce::isPublic');
$t->ok($ordinary_announce->isPublic(), 'if is_public is true and no publish_date set, the announce is public.');

$t->ok(!$before_pub_date_announce->isPublic(), 'the announce is not public before publish_date even if is_public is true');
var_dump($before_pub_date_announce->getPublishDate());

$t->ok(!$draft_announce->isPublic(), 'always is not public if is_public is false');

//publish date
$t->diag('Announce::getPublishDate');
$t->is($before_pub_date_announce->getPublishDate(), $before_pub_date_announce->get('publish_date'), 'if publish_date is set, returns publish_date');
$t->is($ordinary_announce->getPublishDate(), $ordinary_announce->getCreatedAt(), 'if publish_date is null, returns created_at');

//isVisible
$t->diag('Announce::getIsVisible');
$forPcAndMobile = $ordinary_announce;
$forPcOnly = $table->find(5);
$forMobileOnly = $table->find(6);
$t->ok($forPcAndMobile->isVisible('pc_frontend'), 'if both is_pc and is_mobile  is true, visible in pc_frontend');
$t->ok($forPcAndMobile->isVisible('mobile_frontend'), 'if both is_pc and is_mobile  is true, visible in mobile_frontend');
$t->ok($forPcOnly->isVisible('pc_frontend'), 'if is_pc only. visible in pc_frontend');
$t->ok(!$forPcOnly->isVisible('mobile_frontend'), 'if is_pc only, invisible in mobile_frontend');
$t->ok(!$forMobileOnly->isVisible('pc_frontend'), 'if is_mobile only. invisible in pc_frontend');
$t->ok($forMobileOnly->isVisible('mobile_frontend'), 'if is_mobile only, visible in mobile_frontend');

//pager
$t->diag('AnnounceTable::getAppPublicPager');

$pager = $table->getAppPublicPager(true, 'mobile_frontend', 3, 1);
$t->isa_ok($pager, 'sfDoctrinePager', 'returns sfDoctrinePager instance');
$t->is($pager->getPage(), 1, 'the page is 1');
$t->is($pager->getNbResults(), 4, 'there are 4 public announces for mobile');
$t->is(count($pager->getResults()), 3, 'found 3 announces');

$pager = $table->getAppPublicPager(true, 'pc_frontend', 3, 2);
$t->isa_ok($pager, 'sfDoctrinePager', 'returns sfDoctrinePager instance');
$t->is($pager->getPage(), 2, 'the page is 2');
$t->is($pager->getNbResults(), 4, 'there are 4 public announces for pc');
$t->is(count($pager->getResults()), 1, 'found 1 announce');

$pager = $table->getAppPublicPager(false, 'pc_frontend', 3, 1);
$t->isa_ok($pager, 'sfDoctrinePager', 'returns sfDoctrinePager instance');
$t->is($pager->getPage(), 1, 'the page is 1');
$t->is($pager->getNbResults(), 1, 'there is only 1 public announce for pc when the user is not a member');
$t->is(count($pager->getResults()), 1, 'found 1 announce');
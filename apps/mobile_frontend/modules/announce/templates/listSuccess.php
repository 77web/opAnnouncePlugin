<?php

$title = __('Announcements');

if($pager->getNbResults() > 0)
{
  $list = array();
  foreach($pager->getResults() as $announce)
  {
    $list[] = op_format_date($announce->getPublishDate(), 'XDateTimeJa').link_to($announce->getTitle(), '@announce_show?id='.$announce->getId());
  }
  op_include_list('announceList', $list, array('title'=>$title));
  op_include_pager_total($pager, 'announce/list?page=%s');
}
else
{
  op_include_box('announceList', __('No announce.'), array('title'=>$title));
}
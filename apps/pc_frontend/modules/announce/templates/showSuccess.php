<?php

$date = '<p class="date">'.op_format_date($announce->getPublishDate(), 'XDateTimeJa').'</p>';
$body = $announce->getIsHtml() ? $announce->getBody(ESC_RAW) : nl2br(op_auto_link_text($announce->getBody()));
$body = $date.$body;

op_include_box('announceBox', $body, array('title'=>$announce->getTitle()));
<?php

/**
 * common components for pc_frontend, mobile_frontend
 * @package opAnnouncePlugin
 * @subpackage lib
 * @auther Hiromi Hishida<info@77-web.com>
 */
abstract class opAnnouncePluginAnnounceComponents extends sfComponents
{
  public function executeLatest($request)
  {
    $this->list = Doctrine::getTable('Announce')->getLatest(sfConfig::get('sf_app'), sfConfig::get('app_latest_count', 1));
  }
}
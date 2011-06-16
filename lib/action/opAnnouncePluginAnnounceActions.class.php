<?php

/**
 * common actions for pc_frontend, mobile_frontend
 * @package opAnnouncePlugin
 * @subpackage lib
 * @auther Hiromi Hishida<info@77-web.com>
 */
abstract class opAnnouncePluginAnnounceActions extends sfActions
{
  public function executeList(sfWebRequest $request)
  {
    $this->size = isset($this->size) ? $this->size : 20;
    $this->page = $request->getParameter('page', 1);
    if($this->page < 1) $this->page = 1;
    $isMember = $this->getUser()->isSNSMember();
    
    $this->pager = Doctrine::getTable('Announce')->getAppPublicPager($isMember, sfConfig::get('sf_app'), $this->size, $this->page);
  }
  
  public function executeShow(sfWebRequest $request)
  {
    $this->announce = $this->getRoute()->getObject();
    $this->forward404Unless($this->announce->isPublic() && $this->announce->isVisible(sfConfig::get('sf_app')));
    
    if($this->announce->getIsSecure() && !$this->getUser()->isSNSMember())
    {
      $this->forward(sfConfig::get('sf_login_module'), sfConfig::get('sf_login_action'));
    }
  }
}
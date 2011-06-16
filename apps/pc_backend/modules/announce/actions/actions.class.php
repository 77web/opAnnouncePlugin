<?php

/**
 * announce actions.
 *
 * @package    OpenPNE
 * @subpackage announce
 * @author     Hiromi Hishida<info@77-web.com>
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class announceActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('announce', 'list');
  }
  
  public function executeList(sfWebRequest $request)
  {
    $size = 50;
    $page = $request->getParameter('page', 1);
    if($page < 1) $page = 1;
    
    $this->pager = Doctrine::getTable('Announce')->getPager($size, $page);
  }
  
  public function executeAdd(sfWebRequest $request)
  {
    $this->form = new AnnounceForm();
    
    $this->processForm();
  }
  
  public function executeEdit(sfWebRequest $request)
  {
    $this->announce = $this->getRoute()->getObject();
    $this->form = new AnnounceForm($this->announce);
    
    $this->processForm();
  }
  
  protected function processForm()
  {
    $request = $this->getRequest();
    if($request->isMethod(sfRequest::POST))
    {
      if($this->form->isMultipart())
      {
        $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
      }
      else
      {
        $this->form->bind($request->getParameter($this->form->getName()));
      }
      
      if($this->form->isValid())
      {
        $announce = $this->form->save();
        
        $this->getUser()->setFlash('notice', 'Saved successfully.');
        $this->redirect('@announce_edit?id='.$announce->getId());
      }
    }
    
    $this->setTemplate('form');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->announce = $this->getRoute()->getObject();
    
    if($request->isMethod(sfRequest::POST))
    {
      $request->checkCSRFProtection();
      $this->announce->delete();
      
      $this->getUser()->setFlash('notice', 'Deleted successfully.');
      $this->redirect('announce/list');
    }
    
    $this->form = new BaseForm();
    return sfView::INPUT;
  }
}

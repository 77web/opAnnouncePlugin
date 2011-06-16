<?php

/**
 * PluginAnnounce form.
 *
 * @package    opAnnouncePlugin
 * @subpackage form
 * @author     Hiromi Hishida<info@77-web.com>
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginAnnounceForm extends BaseAnnounceForm
{
  public function setup()
  {
    parent::setup();
    
    unset($this['id'], $this['created_at'], $this['updated_at']);
    
    $this->getWidgetSchema()->getFormFormatter()->setTranslationCatalogue('form_announce');
  }
}

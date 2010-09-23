<?php
 
require_once(sfConfig::get('sf_plugins_dir').'/sfGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');
 
class sfGuardAuthActions extends BasesfGuardAuthActions
{

    public function executeRegister(sfWebRequest $request) {
        $user = new sfGuardUser();
        $openid_username = $this->getUser()->getAttribute('openid_username');
        if(!empty($openid_username)) {
            $user->setUsername($openid_username);
        }
        $this->getUser()->setAttribute('openid_username', '');
        $this->form = new sfGuardUserForm($user);
        if('POST' == $request->getMethod()) {
            if($this->processForm($request, $this->form)) {
                $this->getUser()->setFlash('info', 'You have been successfully registered!');
                $this->redirect('@registered');
            }
        }
    }
    
    public function executeRegistered(sfWebRequest $request) {
        //do nothing
    }
    
    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()));
        if ($form->isValid()) {
            $user = $form->save();
            return true;
        }
        return false;
    }

}
<?php
 
require_once(sfConfig::get('sf_plugins_dir').'/sfGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');
 
class sfGuardAuthActions extends BasesfGuardAuthActions
{

    public function executeRegister(sfWebRequest $request) {
        if($this->getUser()->isAuthenticated()) {
            $this->redirect('@homepage');
        }
        $user = new sfGuardUser();
        $openid_username = $this->getUser()->getAttribute('openid_username');
        if(!empty($openid_username)) {
            $user->setUsername($openid_username);
        }
        $this->getUser()->setAttribute('openid_username', '');
        $this->form = new sfGuardUserForm($user);
        $this->form->getValidator('password')->setOption('required', true);
        $this->form->getValidator('first_name')->setOption('required', true);
        $this->form->getValidator('last_name')->setOption('required', true);
        if('POST' == $request->getMethod()) {
            $registered_user = $this->processForm($request, $this->form);
            if(!empty($registered_user)) {
                $this->getUser()->signin($registered_user);
                $this->getUser()->setFlash('info', 'You have been successfully registered!');
                $this->redirect('@registered');
            }
        }
    }
    
    public function executeRegistered(sfWebRequest $request) {
        //do nothing
    }
    
    protected function processForm(sfWebRequest $request, sfForm $form) {
        $user = null;
        $form->bind($request->getParameter($form->getName()));
        if ($form->isValid()) {
            $user = $form->save();
        }
        return $user;
    }

}
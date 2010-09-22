<?php

/**
 * openidAuth actions.
 *
 * @package    MealApp
 * @subpackage openidAuth
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class openidAuthActions extends BasesfPHPOpenIDAuthActions
{

    public function executeSignin(sfWebRequest $request) {
        $this->getUser()->setAttribute('openid_real_back_url', $this->getRequest()->getReferer());
        $getRedirectedHtmlResult = $this->getRedirectHtml($request->getPostParameter('openid'));
        if(!empty($getRedirectedHtmlResult['url']) && !$request->isXmlHttpRequest()) {
            $this->getUser()->setAttribute('openid_username', $request->getPostParameter('openid'));
            $this->redirect($getRedirectedHtmlResult['url']);
        }
    }

    public function executeOpenidError() {
        $error = $this->getUser()->getFlash('openid_error');
        $this->getUser()->setFlash('error', $error);
        $this->redirect('@sf_guard_signin');
    }
      
    public function openIDCallback($openid_validation_result) {
        $user = SfGuardUserPeer::retrieveByUsername($this->getUser()->getAttribute('openid_username'));
        if(empty($user)) {
            $this->redirect('@register');
        } else {
            $this->getUser()->signin($user, false);
            sfContext::getInstance()->getResponse()->setCookie('known_openid_identity', $openid_validation_result['identity']);
            $back = $this->getUser()->getAttribute('openid_real_back_url');
            $this->getUser()->getAttributeHolder()->remove('openid_real_back_url');
            if(empty($back)) {
                $back = '@homepage';
            }
            $this->redirect($back);
        }
        
    }
    
}
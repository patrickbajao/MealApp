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
        $getRedirectedHtmlResult = $this->getRedirectHtml($request->getPostParameter('openid'));
        if(!empty($getRedirectedHtmlResult['url'])) {
            $this->redirect($getRedirectedHtmlResult['url']);
        }
    }

    public function executeOpenidError() {
        $error = $this->getRequest()->getErrors();
        $this->getUser()->setFlash('error', $error);
    }

    public function openIDCallback($openid_validation_result) {
        $this->getUser()->setAuthenticated(true);
        sfContext::getInstance()->getResponse()->setCookie('known_openid_identity', $openid_validation_result['identity']);
        $back = '@homepage';
        $this->redirect($back);
    }
    
}
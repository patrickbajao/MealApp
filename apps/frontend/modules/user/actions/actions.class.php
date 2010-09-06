<?php

/**
 * user actions.
 *
 * @package    MealApp
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
    }
    
    public function executeHome(sfWebRequest $request) {
    }
    
    public function executeLogin(sfWebRequest $request) {
        $username = $request->getParameter('username');
        $password = $request->getParameter('password');
        if(('patrick' == $username) && ('password' == $password)) {
            $this->redirect('user/home');
        } else {
            $this->getUser()->setFlash('login_error', 'Please enter a correct username or password.');
            $this->redirect('/');
        }
    }
    
}

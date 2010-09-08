<?php

/**
 * menu actions.
 *
 * @package    MealApp
 * @subpackage menu
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class menuActions extends sfActions
{
    public function executeShow(sfWebRequest $request) {
    }
    
    public function executeOrder(sfWebRequest $request) {
        $meal_id  = $request->getParameter('meal');
        $items    = $request->getPostParameter('item');
        if(!empty($items)) {
            $success = false;
            foreach($items as $key => $value) {
                if(1 == $items[$key]) {
                    $order = new MealOrder();
                    $order->setMealId($meal_id);
                    $order->setItemId($key);
                    $order->setSfGuardUserId($this->getUser()->getGuardUser()->getId());
                    if($order->save()) {
                        $success = true;
                    }
                }
            }
            if($success) {
                $this->getUser()->setFlash('info', 'Your order has been placed.');
                $this->redirect('/menu/' . $meal_id);
            } else {
                $this->getUser()->setFlash('error', 'There was a problem encountered in placing your order.');
            }
        }
    }
}
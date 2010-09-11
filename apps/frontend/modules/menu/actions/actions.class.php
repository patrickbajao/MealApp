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
        if('POST' == $request->getMethod()) {
            if(!empty($items)) {
                $success = false;
                foreach($items as $item_id) {
                    $order = new MealOrder();
                    $order->setMealId($meal_id);
                    $order->setItemId($item_id);
                    $order->setSfGuardUserId($this->getUser()->getGuardUser()->getId());
                    if($order->save()) {
                        $success = true;
                    }
                }
                if($success) {
                    $this->getUser()->setFlash('info', 'Your order has been placed.');
                    $this->redirect('menu/' . $meal_id);
                }
            } else {
                $this->getUser()->setFlash('info', 'Please order some food.');
            }
        }
        // Get the menu and its items and set the values for the view
        $this->menu  = MenuPeer::getPlaceMenu(MealPeer::getMealPlaceId($meal_id));
        $this->items = $this->menu->getMenuItems();
    }
}
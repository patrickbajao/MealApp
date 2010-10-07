<?php

/**
 * Meal form.
 *
 * @package    MealApp
 * @subpackage form
 * @author     Your name here
 */
class MealForm extends BaseMealForm
{
    public function configure() {
        $this->widgetSchema['type'] = new sfWidgetFormChoice(array(
                'choices'  => array('breakfast' => 'Breakfast', 'lunch' => 'Lunch', 'dinner' => 'Dinner'),
                'default'  => array('breakfast', 0)
            ));
        unset($this['created_at'], $this['updated_at']);
        
        $this->widgetSchema['meal_place_list']->setOption('renderer_class', 'sfWidgetFormSelectDoubleList');
        $this->widgetSchema['meal_place_list']->setOption('renderer_options', array('label_unassociated' => 'Places', 'label_associated' => 'For Voting'));
        $this->widgetSchema['meal_place_list']->setLabel('Places for Voting');
    }
}

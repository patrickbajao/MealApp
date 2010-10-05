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
    }
}

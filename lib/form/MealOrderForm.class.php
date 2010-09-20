<?php

/**
 * MealOrder form.
 *
 * @package    MealApp
 * @subpackage form
 * @author     Your name here
 */
class MealOrderForm extends BaseMealOrderForm
{
    
    public function configure() {
        unset($this['id'],$this['meal_id'], $this['sf_guard_user_id'], $this['created_at'], $this['updated_at']);
        $this->disableLocalCSRFProtection();
        $this->widgetSchema['item_id'] = new sfWidgetFormPropelChoice(array('model' => 'Item', 'criteria' => $this->getOption('criteria'), 'add_empty' => false, 'multiple' => true, 'expanded' => true));
        $this->validatorSchema['item_id'] = new sfValidatorPropelChoice(array('model' => 'Item', 'criteria' => $this->getOption('criteria'), 'column' => 'id', 'multiple' => true));
    }
    
}
<?php

/**
 * Item Suggestion form.
 *
 * @package    MealApp
 * @subpackage form
 * @author     Your name here
 */
class ItemSuggestionForm extends BaseSuggestionForm
{

    public function configure() {
        unset(
            $this['id'],
            $this['contact']
        );
        $this->widgetSchema['place_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['type']->setDefault('item');
        
        $this->validatorSchema['price']->setOption('required', true);
    }
    
}

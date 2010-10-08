<?php

/**
 * Place Suggestion form.
 *
 * @package    MealApp
 * @subpackage form
 * @author     Your name here
 */
class PlaceSuggestionForm extends BaseSuggestionForm
{

    public function configure() {
        unset(
            $this['id'],
            $this['price']
        );
        $this->widgetSchema['place_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['type']->setDefault('place');
    }
    
}

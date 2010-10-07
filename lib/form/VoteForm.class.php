<?php

/**
 * Vote form.
 *
 * @package    MealApp
 * @subpackage form
 * @author     Your name here
 */
class VoteForm extends BaseVoteForm
{

    public function configure() {
        unset($this['meal_id'], $this['sf_guard_user_id'], $this['created_at'], $this['updated_at']);
        $this->widgetSchema['place_id'] = new sfWidgetFormPropelChoice(array('model' => 'MealPlace', 'criteria' => $this->getOption('criteria'), 'key_method' => 'getPlaceId', 'peer_method' => 'doSelectJoinPlace', 'add_empty' => false, 'multiple' => false, 'expanded' => true));
    }
    
}

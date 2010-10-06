<?php

/**
 * MealPlace form base class.
 *
 * @method MealPlace getObject() Returns the current form's model object
 *
 * @package    MealApp
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseMealPlaceForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'meal_id'  => new sfWidgetFormPropelChoice(array('model' => 'Meal', 'add_empty' => false)),
      'place_id' => new sfWidgetFormPropelChoice(array('model' => 'Place', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'meal_id'  => new sfValidatorPropelChoice(array('model' => 'Meal', 'column' => 'id')),
      'place_id' => new sfValidatorPropelChoice(array('model' => 'Place', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('meal_place[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MealPlace';
  }


}

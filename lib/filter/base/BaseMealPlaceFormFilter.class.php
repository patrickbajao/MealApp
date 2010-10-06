<?php

/**
 * MealPlace filter form base class.
 *
 * @package    MealApp
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseMealPlaceFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'meal_id'  => new sfWidgetFormPropelChoice(array('model' => 'Meal', 'add_empty' => true)),
      'place_id' => new sfWidgetFormPropelChoice(array('model' => 'Place', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'meal_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Meal', 'column' => 'id')),
      'place_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Place', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('meal_place_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MealPlace';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'meal_id'  => 'ForeignKey',
      'place_id' => 'ForeignKey',
    );
  }
}

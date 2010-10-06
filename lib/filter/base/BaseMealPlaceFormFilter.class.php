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
    ));

    $this->setValidators(array(
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

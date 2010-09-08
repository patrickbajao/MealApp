<?php

/**
 * Meal filter form base class.
 *
 * @package    MealApp
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseMealFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'place_id'   => new sfWidgetFormPropelChoice(array('model' => 'Place', 'add_empty' => true)),
      'type'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'place_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Place', 'column' => 'id')),
      'type'       => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('meal_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Meal';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'place_id'   => 'ForeignKey',
      'type'       => 'Text',
      'created_at' => 'Date',
    );
  }
}

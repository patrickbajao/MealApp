<?php

/**
 * Vote filter form base class.
 *
 * @package    MealApp
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseVoteFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'meal_place_id'    => new sfWidgetFormPropelChoice(array('model' => 'MealPlace', 'add_empty' => true)),
      'sf_guard_user_id' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'meal_place_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'MealPlace', 'column' => 'id')),
      'sf_guard_user_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('vote_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Vote';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'meal_place_id'    => 'ForeignKey',
      'sf_guard_user_id' => 'ForeignKey',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}

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
      'place_id'         => new sfWidgetFormPropelChoice(array('model' => 'Place', 'add_empty' => true)),
      'type'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'voting_stopped'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'ordering_stopped' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'scheduled_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'meal_place_list'  => new sfWidgetFormPropelChoice(array('model' => 'Place', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'place_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Place', 'column' => 'id')),
      'type'             => new sfValidatorPass(array('required' => false)),
      'voting_stopped'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'ordering_stopped' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'scheduled_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'meal_place_list'  => new sfValidatorPropelChoice(array('model' => 'Place', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('meal_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addMealPlaceListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(MealPlacePeer::MEAL_ID, MealPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(MealPlacePeer::PLACE_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(MealPlacePeer::PLACE_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Meal';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'place_id'         => 'ForeignKey',
      'type'             => 'Text',
      'voting_stopped'   => 'Boolean',
      'ordering_stopped' => 'Boolean',
      'scheduled_at'     => 'Date',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
      'meal_place_list'  => 'ManyKey',
    );
  }
}

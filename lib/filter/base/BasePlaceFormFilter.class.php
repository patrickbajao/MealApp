<?php

/**
 * Place filter form base class.
 *
 * @package    MealApp
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePlaceFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'     => new sfWidgetFormFilterInput(),
      'contact'         => new sfWidgetFormFilterInput(),
      'image'           => new sfWidgetFormFilterInput(),
      'meal_place_list' => new sfWidgetFormPropelChoice(array('model' => 'Meal', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'            => new sfValidatorPass(array('required' => false)),
      'description'     => new sfValidatorPass(array('required' => false)),
      'contact'         => new sfValidatorPass(array('required' => false)),
      'image'           => new sfValidatorPass(array('required' => false)),
      'meal_place_list' => new sfValidatorPropelChoice(array('model' => 'Meal', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('place_filters[%s]');

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

    $criteria->addJoin(MealPlacePeer::PLACE_ID, PlacePeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(MealPlacePeer::MEAL_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(MealPlacePeer::MEAL_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Place';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'name'            => 'Text',
      'description'     => 'Text',
      'contact'         => 'Text',
      'image'           => 'Text',
      'meal_place_list' => 'ManyKey',
    );
  }
}

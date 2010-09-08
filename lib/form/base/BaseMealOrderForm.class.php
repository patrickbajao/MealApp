<?php

/**
 * MealOrder form base class.
 *
 * @method MealOrder getObject() Returns the current form's model object
 *
 * @package    MealApp
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseMealOrderForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'meal_id'          => new sfWidgetFormPropelChoice(array('model' => 'Meal', 'add_empty' => false)),
      'item_id'          => new sfWidgetFormPropelChoice(array('model' => 'Item', 'add_empty' => false)),
      'sf_guard_user_id' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'meal_id'          => new sfValidatorPropelChoice(array('model' => 'Meal', 'column' => 'id')),
      'item_id'          => new sfValidatorPropelChoice(array('model' => 'Item', 'column' => 'id')),
      'sf_guard_user_id' => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'updated_at'       => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('meal_order[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MealOrder';
  }


}

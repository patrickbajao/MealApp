<?php

/**
 * Meal form base class.
 *
 * @method Meal getObject() Returns the current form's model object
 *
 * @package    MealApp
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseMealForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'place_id'         => new sfWidgetFormPropelChoice(array('model' => 'Place', 'add_empty' => true)),
      'type'             => new sfWidgetFormInputText(),
      'voting_stopped'   => new sfWidgetFormInputCheckbox(),
      'ordering_stopped' => new sfWidgetFormInputCheckbox(),
      'scheduled_at'     => new sfWidgetFormDateTime(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'meal_place_list'  => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Place')),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'place_id'         => new sfValidatorPropelChoice(array('model' => 'Place', 'column' => 'id', 'required' => false)),
      'type'             => new sfValidatorString(array('max_length' => 9)),
      'voting_stopped'   => new sfValidatorBoolean(array('required' => false)),
      'ordering_stopped' => new sfValidatorBoolean(array('required' => false)),
      'scheduled_at'     => new sfValidatorDateTime(),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'updated_at'       => new sfValidatorDateTime(array('required' => false)),
      'meal_place_list'  => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Place', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('meal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Meal';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['meal_place_list']))
    {
      $values = array();
      foreach ($this->object->getMealPlaces() as $obj)
      {
        $values[] = $obj->getPlaceId();
      }

      $this->setDefault('meal_place_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveMealPlaceList($con);
  }

  public function saveMealPlaceList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['meal_place_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(MealPlacePeer::MEAL_ID, $this->object->getPrimaryKey());
    MealPlacePeer::doDelete($c, $con);

    $values = $this->getValue('meal_place_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new MealPlace();
        $obj->setMealId($this->object->getPrimaryKey());
        $obj->setPlaceId($value);
        $obj->save();
      }
    }
  }

}

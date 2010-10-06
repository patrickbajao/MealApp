<?php

/**
 * Place form base class.
 *
 * @method Place getObject() Returns the current form's model object
 *
 * @package    MealApp
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePlaceForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'name'            => new sfWidgetFormInputText(),
      'description'     => new sfWidgetFormTextarea(),
      'contact'         => new sfWidgetFormInputText(),
      'image'           => new sfWidgetFormInputText(),
      'meal_place_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Meal')),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'            => new sfValidatorString(array('max_length' => 150)),
      'description'     => new sfValidatorString(array('required' => false)),
      'contact'         => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'image'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'meal_place_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Meal', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('place[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Place';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['meal_place_list']))
    {
      $values = array();
      foreach ($this->object->getMealPlaces() as $obj)
      {
        $values[] = $obj->getMealId();
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
    $c->add(MealPlacePeer::PLACE_ID, $this->object->getPrimaryKey());
    MealPlacePeer::doDelete($c, $con);

    $values = $this->getValue('meal_place_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new MealPlace();
        $obj->setPlaceId($this->object->getPrimaryKey());
        $obj->setMealId($value);
        $obj->save();
      }
    }
  }

}

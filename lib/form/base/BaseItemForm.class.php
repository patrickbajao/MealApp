<?php

/**
 * Item form base class.
 *
 * @method Item getObject() Returns the current form's model object
 *
 * @package    MealApp
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseItemForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'menu_id'     => new sfWidgetFormPropelChoice(array('model' => 'Menu', 'add_empty' => false)),
      'name'        => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
      'price'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'menu_id'     => new sfValidatorPropelChoice(array('model' => 'Menu', 'column' => 'id')),
      'name'        => new sfValidatorString(array('max_length' => 150)),
      'description' => new sfValidatorString(array('required' => false)),
      'price'       => new sfValidatorNumber(),
    ));

    $this->widgetSchema->setNameFormat('item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Item';
  }


}

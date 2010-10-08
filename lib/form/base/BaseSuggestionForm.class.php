<?php

/**
 * Suggestion form base class.
 *
 * @method Suggestion getObject() Returns the current form's model object
 *
 * @package    MealApp
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSuggestionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'place_id'    => new sfWidgetFormPropelChoice(array('model' => 'Place', 'add_empty' => true)),
      'type'        => new sfWidgetFormInputText(),
      'name'        => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
      'contact'     => new sfWidgetFormInputText(),
      'price'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'place_id'    => new sfValidatorPropelChoice(array('model' => 'Place', 'column' => 'id', 'required' => false)),
      'type'        => new sfValidatorString(array('max_length' => 5)),
      'name'        => new sfValidatorString(array('max_length' => 150)),
      'description' => new sfValidatorString(array('required' => false)),
      'contact'     => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'price'       => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('suggestion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Suggestion';
  }


}

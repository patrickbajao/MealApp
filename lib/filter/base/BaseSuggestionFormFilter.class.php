<?php

/**
 * Suggestion filter form base class.
 *
 * @package    MealApp
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseSuggestionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'place_id'    => new sfWidgetFormPropelChoice(array('model' => 'Place', 'add_empty' => true)),
      'type'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description' => new sfWidgetFormFilterInput(),
      'contact'     => new sfWidgetFormFilterInput(),
      'price'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'place_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Place', 'column' => 'id')),
      'type'        => new sfValidatorPass(array('required' => false)),
      'name'        => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'contact'     => new sfValidatorPass(array('required' => false)),
      'price'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('suggestion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Suggestion';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'place_id'    => 'ForeignKey',
      'type'        => 'Text',
      'name'        => 'Text',
      'description' => 'Text',
      'contact'     => 'Text',
      'price'       => 'Number',
    );
  }
}

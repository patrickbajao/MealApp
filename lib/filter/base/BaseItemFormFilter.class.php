<?php

/**
 * Item filter form base class.
 *
 * @package    MealApp
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseItemFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'place_id'    => new sfWidgetFormPropelChoice(array('model' => 'Place', 'add_empty' => true)),
      'name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description' => new sfWidgetFormFilterInput(),
      'price'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'image'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'place_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Place', 'column' => 'id')),
      'name'        => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'price'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'image'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Item';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'place_id'    => 'ForeignKey',
      'name'        => 'Text',
      'description' => 'Text',
      'price'       => 'Number',
      'image'       => 'Text',
    );
  }
}

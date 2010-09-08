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
      'menu_id'     => new sfWidgetFormPropelChoice(array('model' => 'Menu', 'add_empty' => true)),
      'name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description' => new sfWidgetFormFilterInput(),
      'price'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'menu_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Menu', 'column' => 'id')),
      'name'        => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'price'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
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
      'menu_id'     => 'ForeignKey',
      'name'        => 'Text',
      'description' => 'Text',
      'price'       => 'Number',
    );
  }
}

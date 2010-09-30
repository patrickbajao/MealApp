<?php

/**
 * Items Upload form.
 *
 * @package    MealApp
 * @subpackage form
 * @author     Your name here
 */
class ItemsUploadForm extends BaseItemForm
{

    public function configure() {
        unset(
            $this['id'],
            $this['name'],
            $this['description'],
            $this['price']
        );
              
        $this->widgetSchema['items'] = new sfWidgetFormInputFile(array('label' => 'CSV File'));
        
        $this->widgetSchema->setHelp('items', 'The CSV file should have the following format "<strong>item name,description,price</strong>".');
        
        $this->getWidgetSchema()->getFormFormatter()->setHelpFormat('<span class="help">%help%</span>');
        
        $this->validatorSchema->setOption('allow_extra_fields', true);
    }
    
}

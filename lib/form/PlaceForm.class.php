<?php

/**
 * Place form.
 *
 * @package    MealApp
 * @subpackage form
 * @author     Your name here
 */
class PlaceForm extends BasePlaceForm
{
    public function configure() {
        $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
            'label'     => 'Image',
            'file_src'  => '/uploads/places/' . $this->getObject()->getImage(),
            'is_image'  => true,
            'edit_mode' => !$this->isNew(),
            'template'  => '<div><ul><li>%file%</li><li>%input%</li><li>%delete% %delete_label%</li></ul></div>',
        ));
        $this->validatorSchema['image_delete'] = new sfValidatorPass();
        $this->validatorSchema['image'] = new sfValidatorFile(array(
            'required'   => false,
            'path'       => sfConfig::get('sf_upload_dir').'/places',
            'mime_types' => 'web_images',
        ));
    }
}

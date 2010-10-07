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
            'file_src'  => '/uploads/places/thumbnails/' . $this->getObject()->getImage(),
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
    
    protected function processUploadedFile($field, $filename = null, $values = null) {
       $fn = parent::processUploadedFile($field, $filename, $values);
       
       if (!is_null($values[$field])) {
            $thumbnails = array('dir' => 'thumbnails', 'width' => 70, 'height' => 70);
            $current_file = sfConfig::get('sf_upload_dir') . '/places/' . $thumbnails['dir'] . '/' . $fn;
            if(is_file($current_file)) {
                unlink($current_file);
            }
            if(!file_exists(sfConfig::get('sf_upload_dir') . '/places/' . $thumbnails['dir'])) { 
                mkdir(sfConfig::get('sf_upload_dir') . '/places/' . $thumbnails['dir']); 
            }
            $thumbnail = new sfThumbnail($thumbnails['width'], $thumbnails['height'], true, false);
            $thumbnail->loadFile(sfConfig::get('sf_upload_dir') . '/places/' . $fn);
            $thumbnail->save(sfConfig::get('sf_upload_dir'). '/places/' . $thumbnails['dir'] . '/' . $fn, $values[$field]->getType());
        }
        
        return $fn;
    }
    
    protected function removeFile($field) {
        parent::removeFile($field);
        
        $directory = $this->validatorSchema[$field]->getOption('path');
        $thumbnail = $directory . DIRECTORY_SEPARATOR . 'thumbnails' . DIRECTORY_SEPARATOR . $this->getObject()->getImage();
        if(is_file($thumbnail)) {
            unlink($thumbnail);
        }
    }
}

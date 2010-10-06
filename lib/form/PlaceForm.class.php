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
    
    protected function processUploadedFile($field, $filename = null, $values = null) {

       $fn = parent::processUploadedFile($field, $filename, $values);

       if ($filename != "") {
            $thumbnails[] = array('dir' => 'thumbnails', 'width' => 150, 'height' => 150);
            foreach ($thumbnails as $thumb_param) {
                $current_file = sfConfig::get('sf_upload_dir') . '/places/' . $thumb_param['dir'] . '/' . $fn;
                if(is_file($current_file)) {
                    unlink($current_file);
                }
            }
            foreach ($thumbnails as $thumb_param) {
                $thumbnail = new sfThumbnail($thumb_param['width'], $thumb_param['height'], true, false);
                $thumbnail->loadFile(sfConfig::get('sf_upload_dir') . '/places/' . $fn);
                $thumbnail->save(sfConfig::get('sf_upload_dir').'/places/' . $thumb_param['dir'] . '/' . $fn, 'image/jpeg');
            }
        }
        return $fn;
    }
}

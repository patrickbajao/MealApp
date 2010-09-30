<?php

require_once dirname(__FILE__).'/../lib/itemGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/itemGeneratorHelper.class.php';

/**
 * item actions.
 *
 * @package    MealApp
 * @subpackage item
 * @author     Earl Patrick Bajao
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class itemActions extends autoItemActions
{

    public function executeIndex(sfWebRequest $request) {
        parent::executeIndex($request);
        
        $this->form = new ItemsUploadForm();
    }
    
    public function executeUpload(sfWebRequest $request) {
        $place_id = $request->getPostParameter('item[place_id]');
        $place    = PlacePeer::retrieveByPk($place_id);
        if(empty($place)) {
            $this->getUser()->setFlash('error', 'The place chosen for the items upload does not exists.');
            $this->redirect('item');
        }
        
        $form = new ItemsUploadForm();
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if($form->isValid()) {
            $file   = $request->getFiles($form->getName());
            $reader = new sfCsvReader($file['items']['tmp_name']);
            $reader->open();
            
            $count     = 0;
            $row_count = 0;
            while ($data = $reader->read()) {
                $item_form = new ItemForm();
                $csrf_token = $item_form->getCSRFToken('07f47c910c686d54b12541b69f31136304087879');
                $item = array(
                    'place_id' => $place_id,
                    'name' => $data[0],
                    'description' => $data[1],
                    'price' => $data[2],
                    '_csrf_token' => $csrf_token
                );
                $item_form->bind($item);
                if($item_form->isValid()) {
                    $item_form->save();
                    $count++;
                }
                $row_count++;
            }
            $reader->close();
            if($count == $row_count) {
                $this->getUser()->setFlash('notice', $count . ' out of ' . $all_count . ' items have been added successfully.');
            } else {
                $this->getUser()->setFlash('error', 'Only ' . $count . ' out of ' . $all_count . ' items have been added successfully.');
            }
            $this->redirect('item');
        }
    }

}

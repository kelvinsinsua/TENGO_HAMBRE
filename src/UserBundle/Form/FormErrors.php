<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormErrors
 *
 * @author gregol
 */
namespace UserBundle\Form;
    
class FormErrors
{

    /**
     * @param \Symfony\Component\Form\Form $form
     *
     * @return array $errors
     */
    public function getArray(\Symfony\Component\Form\Form $form)
    {
        return $this->getErrors($form, $form->getName());
    }

    /**
     * @param \Symfony\Component\Form\Form $baseForm
     * @param \Symfony\Component\Form\Form $baseFormName
     *
     * @return array $errors
     */
    private function getErrors($baseForm, $baseFormName) {
        $errors = array();
        if ($baseForm instanceof \Symfony\Component\Form\Form) {
            foreach($baseForm->getErrors() as $error) {
                $errors[] = array(
                    "mess"      => $error->getMessage(),
                    "key"       => $baseFormName
                );
            }

            foreach ($baseForm->all() as $key => $child) {
                if(($child instanceof \Symfony\Component\Form\Form)) {
                    $cErrors = $this->getErrors($child, $baseFormName . "_" . $child->getName());
                    $errors = array_merge($errors, $cErrors);
                }
            }
        }
        return $errors;
    }
}

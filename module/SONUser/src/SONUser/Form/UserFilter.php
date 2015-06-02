<?php

namespace SONUser\Form;

use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress;

class UserFilter extends InputFilter {
    
    public function __construct() {
        $this->add(array(
            'name' => "nome",
            'required' => true,
            'filters' => array(
                array("name" => "StripTags"),
                array("name" => "StringTrim")
            ),
            'validators' => array(
                array("name" => "NotEmpty", 'options' => array("isEmpty" => "Não pode estar vazio."))
            )
        ));
        
        $validator = new EmailAddress;
        $validator->setOptions(array('domain' => FALSE));
        
        $this->add(array(
            'name' => "password",
            'required' => true,
            'filters' => array(
                array("name" => "StripTags"),
                array("name" => "StringTrim")
            ),
            'validators' => array(
                array("name" => "NotEmpty", 'options' => array("isEmpty" => "Não pode estar vazio."))
            )
        ));
        
        $this->add(array(
            'name' => "confirmation",
            'required' => true,
            'filters' => array(
                array("name" => "StripTags"),
                array("name" => "StringTrim")
            ),
            'validators' => array(
                array("name" => "NotEmpty", 'options' => array("isEmpty" => "Não pode estar vazio.")),
                array("name" => 'identical', 'options' => array('token' => "password"))
            )
        ));
    }
}

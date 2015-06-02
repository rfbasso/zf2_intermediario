<?php

namespace SONUser\Form;

use Zend\Form\Form;


class User extends Form {
    
    public function __construct($name = null, $options = array()) {
        parent::__construct('user', $options);
        $this->setInputFilter(new UserFilter());
        $this->setAttribute('method', 'POST');
        $this->setAttribute('style', 'width: 50%');
        
        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);
        
        $nome = new \Zend\Form\Element\Text('nome');
        $nome->setLabel("Nome: ")
                ->setAttributes(array(
                    "placeholder" => "Entre com o nome",
                    'class' => 'form-control'
                ));
        $this->add($nome);
        
        $email = new \Zend\Form\Element\Text('email');
        $email->setLabel("E-mail: ")
                ->setAttributes(array(
                    "placeholder" => "Entre com o e-mail",
                    'class' => 'form-control'
                ));
        $this->add($email);
        
        $password = new \Zend\Form\Element\Password('password');
        $password->setLabel("Senha: ")
                ->setAttributes(array(
                    "placeholder" => "Entre com a senha",
                    'class' => 'form-control'
                ));
        $this->add($password);
        
        $confirmation = new \Zend\Form\Element\Password('confirmation');
        $confirmation->setLabel("Confirme a Senha: ")
                ->setAttributes(array(
                    "placeholder" => "Confirme sua Senha",
                    'class' => 'form-control'
                ));
        $this->add($confirmation);
        
        $csrf = new \Zend\Form\Element\Csrf("security");
        $this->add($csrf);
        
        $this->add(
            array(
                "name" => "submit", 
                "type" => 'Zend\Form\Element\Submit',
                'attributes' => array(
                    'value' => "Salvar",
                    'class' => 'btn btn-success'
                )
            )
        );
    }
}

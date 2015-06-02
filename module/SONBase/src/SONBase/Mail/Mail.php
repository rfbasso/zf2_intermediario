<?php

namespace SONBase\Mail;

use Zend\Mail\Transport\Smtp as SmtpTransport,
    Zend\Mail\Message;

use Zend\View\Model\ViewModel;

use Zend\Mime\Message as MimeMessage,
    Zend\Mime\Part as MimePart;

class Mail {
    
    protected $transport;
    protected $view;
    protected $body;
    protected $mensagem;
    protected $subject;
    protected $to;
    protected $data;
    protected $page;
    
    public function __construct(SmtpTransport $transport, $view, $page) {
        $this->transport = $transport;
        $this->view = $view;
        $this->page = $page;
    }
    
    function setSubject($subject) {
        $this->subject = $subject;
        return $this;
    }

    function setTo($to) {
        $this->to = $to;
        return $this;
    }

    function setData($data) {
        $this->data = $data;
        return $this;
    }
    
    public function renderView($page, array $data) {
        $model = new ViewModel;
        $model->setTemplate("mailer/{$page}.phtml");
        $model->setOption('has_parent', true);        
        $model->setVariables($data);
        
        return $this->view->render($model);
    }
    
    public function prepare() {
        $html = new MimePart($this->renderView($this->page, $this->data));
        $html->type = "text/html";
        
        $body = new MimeMessage();
        $body->setParts(array($html));
        
        $this->body = $body;
        
        $config = $this->transport->getOptions()->toArray();
        
        $this->mensagem = new Message;
        $this->mensagem->addFrom($config['connection_config']["from"])
                ->addTo($this->to)
                ->setSubject($this->subject)
                ->setBody($this->body);
        
        return $this;                
    }
    
    public function send() {
        $this->transport->send($this->mensagem);
    }


}

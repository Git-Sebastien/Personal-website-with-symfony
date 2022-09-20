<?php 

namespace App\Entity;

class ContactMail
{

    protected $name;
    protected $email;
    protected $subject;
    protected $message;
    protected $captcha;

    /**
     * Get the value of name
     */ 
    public function getName()
    {
            return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
            $this->name = $name;

            return $this;
    }

    /**
     * Get the value of subject
     */ 
    public function getSubject()
    {
            return $this->subject;
    }

    /**
     * Set the value of subject
     *
     * @return  self
     */ 
    public function setSubject($subject)
    {
            $this->subject = $subject;

            return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of captcha
     */ 
    public function getCaptcha()
    {
        return $this->captcha;
    }

    /**
     * Set the value of captcha
     *
     * @return  self
     */ 
    public function setCaptcha($captcha)
    {
        $this->captcha = $captcha;

        return $this;
    }
}
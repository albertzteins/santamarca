<?php

class ContactForm
{
  private $send_to;
  private $name;
  private $phone;
  private $mail;
  private $subject;
  private $message;

  public function __construct($send_to)
  {
    $this->send_to = $send_to;
  }

  /* Setters */
  public function setSendTo($send_to) { $this->send_to = $send_to; }
  public function setName($name) { $this->name = $name; }
  public function setPhone($phone) { $this->phone = $phone; }
  public function setMail($mail) { $this->mail = $mail; }
  public function setSubject($subject) { $this->subject = $subject; }
  public function setMessage($message) { $this->message = $message; }

  /* Getters */
  public function getSendTo() { return $this->send_to; }
  public function getName() { return $this->name; }
  public function getPhone() { return $this->phone; }
  public function getMail() { return $this->mail; }
  public function getSubject() { return $this->subject; }
  public function getMessage() { return $this->message; }

  /* Methods */
  public function sendMail()
  {
    
    $headers = 'From: web@santamarca.com.mx' . chr(10) . 'Reply-To: ' . $this->getMail() . chr(10) . 'X-Mailer: PHP' . chr(10);
    
    $mail = mail($this->getSendTo(), $this->getSubject(), $this->getMessage(), $headers);

    if ($mail)
      return true;
    else
      return false;
  }
}

?>

<?php

if ($script == 'contacto')
{
  if (getFormValue('name') && getFormValue('mail') && getFormValue('problem'))
  {
    require 'models/ContactForm.class.php';
  
    $contact = new ContactForm('hola@santamarca.com.mx');
  
    $contact->setMail(getFormValue('mail'));
    $contact->setName(getFormValue('name'));
    $contact->setPhone(getFormValue('phone'));
  
    $contact->setSubject($contact->getName() . ' envió un mensaje desde Santamarca.com.mx');
    $contact->setMessage('Mail: ' . $contact->getMail() . chr(10) .
      'Teléfono: ' . $contact->getPhone() . chr(10) .
      chr(10) .
      $contact->getName() . ' escribió:' . chr(10) .
      getFormValue('problem'));
  
    if ($contact->sendMail())
      header('HTTP/1.0 200 OK');
    else
      header('HTTP/1.0 500 Internal server error');
  }
  else
    header('HTTP/1.0 400 Bad request');
}
else
  header('HTTP/1.0 404 Not found');

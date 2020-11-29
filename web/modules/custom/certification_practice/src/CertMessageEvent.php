<?php

namespace Drupal\certification_practice;


use Symfony\Component\EventDispatcher\Event;

/**
 * Event class to be dispatched from the CertMessage service.
 */
class CertMessageEvent extends Event {

  const EVENT = 'certification_practice.message_event';

  /**
   * The message.
   *
   * @var string
   */
  protected $message;

  /**
   * @return mixed
   */
  public function getValue() {
    return $this->message;
  }

  /**
   * @param mixed $message
   */
  public function setValue($message) {
    $this->message = $message;
  }

}

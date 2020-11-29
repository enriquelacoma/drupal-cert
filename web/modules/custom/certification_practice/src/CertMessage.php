<?php

namespace Drupal\certification_practice;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use DateTime;

/**
 * Prepares message.
 */
class CertMessage {

  use StringTranslationTrait;

  /**
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;
  /**
   * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
   */
  protected $eventDispatcher;

  /**
   * CertMessage constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher
   */
  public function __construct(ConfigFactoryInterface $config_factory, EventDispatcherInterface $eventDispatcher) {
    $this->configFactory = $config_factory;
    $this->eventDispatcher = $eventDispatcher;
  }

  /**
   * Returns the salutation.
   */
  public function getMessage() {
    $config = $this->configFactory->get('certification_practice.message');
    $message = $config->get('message');
    if ($message && $message !== "") {
      $event = new CertMessageEvent();
      $event->setValue($message);
      $this->eventDispatcher->dispatch(CertMessageEvent::EVENT, $event);
      return $event->getValue();
    }
    $time = new DateTime();
    if ((int) $time->format('G') >= 00 && (int) $time->format('G') < 12) {
      $daytime = $this->t('Good morning');
    }
    if ((int) $time->format('G') >= 12 && (int) $time->format('G') < 18) {
      $daytime = $this->t('Good afternoon');
    }
    if ((int) $time->format('G') >= 18) {
      $daytime = $this->t('Good evening');
    }
    return $daytime . " " . $config->get('message');
  }

}

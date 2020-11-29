<?php

namespace Drupal\certification_practice;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Config\ConfigFactoryInterface;
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
   * CertMessage constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * Returns the salutation.
   */
  public function getMessage() {
    $config = $this->configFactory->get('certification_practice.message');
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

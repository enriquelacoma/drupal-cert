<?php

namespace Drupal\certification_practice\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller certification modules.
 */
class CertController extends ControllerBase {

  /**
   * Certfication message.
   *
   * @return array
   *   The message.
   */
  public function certPracticeMessage() {
    return [
      '#markup' => $this->t('Certification Message.'),
    ];
  }

}

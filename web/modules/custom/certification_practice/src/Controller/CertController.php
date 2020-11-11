<?php

namespace Drupal\certification_practice\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller certification modules.
 */
class CertController extends ControllerBase {

  /**
   * Certification message.
   *
   * @return array
   *   The message.
   */
  public function certPracticeMessage($user) {
    $msg = $this->t('Certification Message. User id: @user_id', ['@user_id' => $user]);
    return [
      '#markup' => $msg,
    ];
  }

}

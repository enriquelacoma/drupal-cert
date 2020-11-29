<?php

namespace Drupal\certification_practice\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Message configuration.
 */
class MessageConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['certification_practice.message'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'message_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('certification_practice.message');
    $form['message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Message'),
      '#description' => $this->t('Add the message to shown.'),
      '#default_value' => $config->get('message'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('certification_practice.message')
      ->set('message', $form_state->getValue('message'))
      ->save();
    parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $length = 10;
    $msg = $form_state->getValue('message');
    if (strlen($msg) > $length) {
      $form_state->setErrorByName('message', $this->t('Max length: ') . $length);
    }
  }

}

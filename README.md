To install phpcs take this steps:
* Install drupal coder globally, it is not compatible with Drupal 9:
    ```
    composer global require drupal/coder
    ```
* Add the global drupal rules to this install:
    ```
    ./vendor/bin/phpcs  --config-set installed_paths ~/.composer/vendor/drupal/coder/coder_sniffer
    ```
* Check if the standars have been added (Drupal and DrupalPractice):
    ```
    ./vendor/bin/phpcs -i
     The installed coding standards are PEAR, Zend, PSR2, MySource, Squiz, PSR1, PSR12, Drupal and DrupalPractice
    ```
* Run code review:
    ```
    ./vendor/bin/phpcs --standard=Drupal web/modules/custom/
    ```
    ```
    ./vendor/bin/phpcs --standard=DrupalPractice web/modules/custom/
    ```


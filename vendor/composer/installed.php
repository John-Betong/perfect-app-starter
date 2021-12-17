<?php return array(
    'root' => array(
        'pretty_version' => '1.0.0+no-version-set',
        'version' => '1.0.0.0',
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'reference' => NULL,
        'name' => 'krubio/perfect-app-skeleton',
        'dev' => true,
    ),
    'versions' => array(
        'krubio/perfect-app-framework' => array(
            'pretty_version' => '3.0',
            'version' => '3.0.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../krubio/perfect-app-framework',
            'aliases' => array(),
            'reference' => 'origin/master',
            'dev_requirement' => false,
        ),
        'krubio/perfect-app-skeleton' => array(
            'pretty_version' => '1.0.0+no-version-set',
            'version' => '1.0.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'reference' => NULL,
            'dev_requirement' => false,
        ),
    ),
);

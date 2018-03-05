<?php

/**
 * This configuration will be read and overlaid on top of the
 * default configuration. Command line arguments will be applied
 * after this file is read.
 */
return [
    'target_php_version' => 7.2,
    'progress_bar' => true,
    'dead_code_detection' => true,
    'directory_list' => [
        'vendor/',
        'src/',
        'tests/',
    ],
    "exclude_analysis_directory_list" => [
        'vendor/',
        'tests/'
    ],
    'minimum_severity' => 0,
    'suppress_issue_types' => [
        'PhanUnreferencedPublicMethod',
        'PhanUnreferencedFunction',
        'PhanUnreferencedClass'
    ]
];
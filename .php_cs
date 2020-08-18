<?php

$finder = Symfony\Component\Finder\Finder::create()
    ->notPath('vendor')
    ->notPath('storage')
    ->in(__DIR__)
    ->name('*.php')
    ->notName('*.blade.php');

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => ['sortAlgorithm' => 'alpha'],
        'no_unused_imports' => true,

        'return_type_declaration' => true,
        'array_indentation' => true,

        'whitespace_after_comma_in_array' => true,
        'trim_array_spaces' => true,
        'no_whitespace_before_comma_in_array' => true,
        'no_trailing_comma_in_singleline_array' => true,

    ])
    ->setFinder($finder);

<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude(['vendor', 'storage', 'node_modules', 'bootstrap/cache'])
    ->name('*.php')
    ->notName('*.blade.php');

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR2' => true,
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'no_unused_imports' => true,

        'return_type_declaration' => true,
        'array_indentation' => true,

        'whitespace_after_comma_in_array' => true,
        'trim_array_spaces' => true,
        'no_whitespace_before_comma_in_array' => true,
        'no_trailing_comma_in_singleline_array' => true,
    ])
    ->setFinder($finder);

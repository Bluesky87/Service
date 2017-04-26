<?php

return PhpCsFixer\Config::create()
    ->setUsingCache(false)
    ->setRules(array(
        '@PSR2' => true,
        'full_opening_tag' => true,
        'method_separation' => true,
    ))
    ->setFinder(PhpCsFixer\Finder::create()
                    ->in(__DIR__));
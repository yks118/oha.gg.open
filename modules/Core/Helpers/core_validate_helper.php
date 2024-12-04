<?php

use Modules\Core\Config\Validation;

if (! function_exists('validate_rule_match'))
{
    function validate_rule_match(string $class, string $property, string $name): string
    {
        /** @var Validation $validation */
        $validation = config($class);

        try {
            return $validation->getRuleMatch($property, $name);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

if (! function_usable('validate_rule_max_length'))
{
    function validate_rule_max_length(string $class, string $property, string $name): int
    {
        /** @var Validation $validation */
        $validation = config($class);

        try {
            return $validation->getRuleMaxLength($property, $name);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

if (! function_usable('validate_rule_min_length'))
{
    function validate_rule_min_length(string $class, string $property, string $name): int
    {
        /** @var Validation $validation */
        $validation = config($class);

        try {
            return $validation->getRuleMinLength($property, $name);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

if (! function_usable('validate_rule_html_tag'))
{
    function validate_rule_html_tag(string $class, string $property, string $name): string
    {
        $htmlTag = '';

        $maxLength = validate_rule_max_length($class, $property, $name);
        if ($maxLength > 0)
        {
            $htmlTag .= ' max_length="' . $maxLength . '"';
        }

        $minLength = validate_rule_min_length($class, $property, $name);
        if ($minLength > 0)
        {
            $htmlTag .= ' required';
        }

        return trim($htmlTag);
    }
}

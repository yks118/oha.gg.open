<?php

if (! function_usable('print_r2'))
{
    function print_r2(mixed $data): string
    {
        return '<pre><code>' . print_r($data, true) . '</code></pre>';
    }
}

if (! function_usable('script'))
{
    function script(string $js, string $type = 'text/javascript'): string
    {
        return '<script type="' . $type . '">' . $js . '</script>';
    }
}

if (! function_usable('uuid'))
{
    /**
     * @link https://stackoverflow.com/questions/2040240/php-function-to-generate-v4-uuid#answer-15875555
     */
    function uuid(): ?string
    {
        try
        {
            $data = random_bytes(16);

            $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }
        catch (\Random\RandomException $e)
        {
            return null;
        }
    }
}

if (! function_usable('is_dev'))
{
    function is_dev(): bool
    {
        return ! is_cli() && ENVIRONMENT === 'development';
    }
}

if (! function_usable('is_prod'))
{
    function is_prod(): bool
    {
        return ! is_cli() && ! is_dev();
    }
}

if (! function_usable('is_admin'))
{
    function is_admin(): bool
    {
        return is_dev();
    }
}

if (! function_usable('color_hex_to_rgb'))
{
    function color_hex_to_rgb(string $hex): string
    {
        list($r, $g, $b) = sscanf($hex, trim('%02x%02x%02x', ' #'));
        return $r . ',' . $g . ',' . $b;
    }
}

if (! function_usable('color_rgb_to_hex'))
{
    function color_rgb_to_hex(string $rgb): string
    {
        list($r, $g, $b) = explode(',', $rgb);
        return sprintf('%02x%02x%02x', $r, $g, $b);
    }
}

if (! function_usable('array_avg'))
{
    function array_avg(array $array): int
    {
        $array = array_filter($array);
        return array_sum($array) / count($array);
    }
}

if (! function_usable('is_decimal'))
{
    function is_decimal(mixed $value): bool
    {
        return (float) $value != (int) $value;
    }
}
<?php

if (! function_usable('site_to'))
{
    /**
     * site_to
     *
     * + 가 공백으로 바뀌는 현상을 수정하기 위한 함수
     *
     * @param string $controller
     * @param string ...$args
     *
     * @return string
     */
    function site_to(string $controller, ...$args): string
    {
        foreach ($args as $key => $value)
        {
            $args[$key] = str_replace('+', '%2B', $value);
        }

        $url = url_to($controller, ...$args);
        $url = str_replace('+', '%2B', $url);
        return $url;
    }
}

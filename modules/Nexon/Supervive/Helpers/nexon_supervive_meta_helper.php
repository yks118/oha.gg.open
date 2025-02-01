<?php

if (! function_usable('nexon_supervive_meta_url'))
{
    function nexon_supervive_meta_url(string $path): string
    {
        return 'https://open.api.nexon.com/static/supervive/meta/' . $path;
    }
}

if (! function_usable('nexon_supervive_meta_hunter'))
{
    /**
     * nexon_supervive_meta_hunter
     *
     * 헌터 관련 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/supervive/?id=40
     * @since 2025.01.16
     *
     * @return array{
     *     hunter_img: array{array{
     *         hunter_id: string,
     *         hunter_name: string,
     *         hunter_img_url: string,
     *     }},
     * }
     */
    function nexon_supervive_meta_hunter(): array
    {
        $cacheKey = 'nexon_supervive_meta_hunter';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_supervive_meta_url('hunter');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_supervive_meta_item'))
{
    /**
     * nexon_supervive_meta_item
     *
     * 아이템 관련 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/supervive/?id=40
     * @since 2025.01.16
     *
     * @return array{
     *     item_img: array{array{
     *         item_id: string,
     *         item_name: string,
     *         item_img_url: string,
     *     }},
     * }
     */
    function nexon_supervive_meta_item(): array
    {
        $cacheKey = 'nexon_supervive_meta_item';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_supervive_meta_url('item');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_supervive_meta_rankgrade'))
{
    /**
     * nexon_supervive_meta_rankgrade
     *
     * 아이템 관련 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/supervive/?id=40
     * @since 2025.01.16
     *
     * @return array{
     *     rankgrade_img: array{array{
     *         rankgrade_id: string,
     *         rankgrade_name: string,
     *         rankgrade_img_url: string,
     *     }},
     * }
     */
    function nexon_supervive_meta_rankgrade(): array
    {
        $cacheKey = 'nexon_supervive_meta_rankgrade';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_supervive_meta_url('rankgrade');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

<?php

if (!function_exists('t')) {
    function t(string $key, ?string $itemKey = null, array $replace = [], string $domain = 'messages'): string
    {
        if ($itemKey) {
            $replace['item'] = __("$domain.$itemKey");
        }

        return __("$domain.$key", $replace);
    }
}

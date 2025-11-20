<?php

if (!function_exists('highlightText')) {
    function highlightText($text, $query)
    {
        if (empty(trim($query))) {
            return $text;
        }

        $words   = preg_split('/\s+/', $query);
        $pattern = '/(' . implode('|', array_map('preg_quote', $words)) . ')/i';

        return preg_replace($pattern, '<span class="search-highlight">$1</span>', $text);
    }
}
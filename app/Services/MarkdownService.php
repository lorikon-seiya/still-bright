<?php

namespace App\Services;

use League\CommonMark\GithubFlavoredMarkdownConverter;

class MarkdownService
{
    public static function parse(?string $markdown): string
    {
        if (! $markdown) {
            return '';
        }

        $converter = new GithubFlavoredMarkdownConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        return $converter->convert($markdown)->getContent();
    }
}

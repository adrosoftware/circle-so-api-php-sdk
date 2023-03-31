<?php

declare(strict_types=1);

function json_response(string $file): string
{
    return file_get_contents(__DIR__ . "/stubs/responses/{$file}.json");
}
<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use \Illuminate\Support\Facades\Route;

/**
 * Get singular and lower from given string
 *
 * @param string $string
 * @return string
 */
function singular_lower(string $string): string
{
    return Str::of($string)->lower()->singular();
}

/**
 * Get plural and lower from given string
 *
 * @param string $string
 * @return string
 */
function plural_lower(string $string): string
{
    return Str::of($string)->lower()->plural();
}

/**
 * Get singular and pascal from given string
 *
 * @param string $string
 * @return string
 */
function singular_studly(string $string): string
{
    return Str::of($string)->studly()->singular();
}

/**
 * Get plural and pascal from given string
 *
 * @param string $string
 * @return string
 */
function plural_studly(string $string): string
{
    return Str::of($string)->studly()->plural();
}

/**
 * Get plural and pascal from given string
 *
 * @param string $string
 * @return string
 */
function plural_pascal(string $string): string
{
    return Str::of($string)->studly()->plural();
}

/**
 * Get plural and kebab from given string
 *
 * @param string $string
 * @return string
 */
function plural_kebab(string $string): string
{
    return Str::plural(Str::kebab($string));
}

/**
 * Get plural and snake from given string
 *
 * @param string $string
 * @return string
 */
function plural_snake(string $string): string
{
    return Str::plural(Str::snake($string));
}

/**
 * Get singular and camel from given string
 *
 * @param string $string
 * @return string
 */
function singular_camel(string $string): string
{
    return Str::singular(Str::camel($string));
}

/**
 * Get plural and camel from given string
 *
 * @param string $string
 * @return string
 */
function plural_camel(string $string): string
{
    return Str::plural(Str::camel($string));
}


/**
 * @param string $string
 * @return string
 */
function readableName(string $string): string
{
    return Str::replace('_', ' ', strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string)));
}

/**
 * Get singular and camel from given string
 *
 * @param string $string
 * @return string
 */
function singular_capital(string $string): string
{
    return Str::singular(Str::upper($string));
}


function extractLazyLoadObjects(array $models): array
{
    $relations = [];

    foreach ($models as $model => $columns) {
        if (!$columns || !count($columns)) {
            $relations[] = $model;
            continue;
        }

        $columns = array_filter($columns, function ($value) {
            return !empty($value);
        });


        $columns = implode(',', $columns);
        $relations[] = $model . ":" . $columns;
    }

    return $relations;
}

function getLocalizedKey(Model $model, string $key)
{
    $key = $key . '_' . app()->getLocale();

    return $model->$key;
}

/**
 * get supported languages
 * @return array
 */
function supportedLanguages(): array
{
    return ['en', 'ar'];
}

/**
 * @param string $name
 * @param string|null $class
 * @return string
 */
function tableDataCell(string $name, string|null $class = null): string
{
    return "<td class='$class'> $name </td>\n";
}

/**
 * check active tab
 * @param $route
 * @return string | null
 */
function activeTab($route): string|null
{
    return Route::currentRouteName() == $route ? 'active' : null;
}


function showDropdown(array $routes): string|null
{
    $currentRouteName = Route::currentRouteName();

    if (in_array($currentRouteName, $routes)) {
        return 'show';
    }
    return null;
}

/**
 * web response
 * @param array $data
 * @param array $headers
 * @return JsonResponse
 */
function webResponse(array $data, array $headers = []): JsonResponse
{
    return response()->json($data, $data['status'], $headers);
}

/**
 * @return string
 */
function mediaBaseURL(): string
{
    if (config('filesystems.default') == 's3') {
        $baseUrl = config('filesystems.disks.s3.url');
    } else {
        $baseUrl = config('filesystems.disks.media.url');
    }

    return $baseUrl;
}

/**
 * @param string $path
 * @return string
 */
function mediaFullURL(string $path): string
{
    if (config('filesystems.default') == 's3') {
        $baseUrl = config('filesystems.disks.s3.url');
    } else {
        $baseUrl = config('filesystems.disks.media.url');
    }

    return $baseUrl . '/' . $path;
}

/**
 * @return Authenticatable
 */
//function getAuthAdmin(): Authenticatable
//{
//    return (new GetAuthAdminService())->get();
//}

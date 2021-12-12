<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Link\StoreRequest;
use File;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    /**
     * @param  StoreRequest  $request
     * @return JsonResponse|void
     */
    public function shorten(StoreRequest $request): JsonResponse
    {
        if (env('DEMO', false)) {
            return responder()->error('Action disabled in demo')->respond(403);
        }
        if (!(bool) setting('homepage_enabled')) {
            abort(404);
        }
        return (new LinkController())->store($request);
    }

    /**
     * Return the available languages list.
     *
     * @return JsonResponse
     */
    public function listLanguages(): JsonResponse
    {
        return (new LanguageController())->index();
    }

    /**
     * Get the language strings.
     *
     * @param $locale
     * @return JsonResponse
     * @throws FileNotFoundException
     */
    public function getLanguageStrings($locale): JsonResponse
    {
        return responder()->success(json_decode(File::get(base_path().'/resources/lang/'.$locale.'.json'), true))->respond();
    }
}

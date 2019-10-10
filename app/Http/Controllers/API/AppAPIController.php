<?php

namespace App\Http\Controllers\API;

use App\App;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateAppAPIRequest;
use App\Http\Requests\API\UpdateAppAPIRequest;
use Illuminate\Http\Request;
use Response;

/**
 * Class AppController.
 */
class AppAPIController extends AppBaseController
{
    /**
     * Display a listing of the App.
     * GET|HEAD /apps.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = App::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $apps = $query->get();

        return $this->sendResponse($apps->toArray(), 'Apps retrieved successfully');
    }

    /**
     * Store a newly created App in storage.
     * POST /apps.
     *
     * @param CreateAppAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAppAPIRequest $request)
    {
        $input = $request->all();

        /** @var App $app */
        $app = App::create($input);

        return $this->sendResponse($app->toArray(), 'App saved successfully');
    }

    /**
     * Display the specified App.
     * GET|HEAD /apps/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($access_token)
    {
        /** @var App $app */
        $app = App::with('meta')->where('access_token', $access_token)->first();

        if (empty($app)) {
            return $this->sendError('App not found');
        }

        return $this->sendResponse($app->toArray(), 'App retrieved successfully');
    }

    /**
     * Update the specified App in storage.
     * PUT/PATCH /apps/{id}.
     *
     * @param int $id
     * @param UpdateAppAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAppAPIRequest $request)
    {
        /** @var App $app */
        $app = App::find($id);

        if (empty($app)) {
            return $this->sendError('App not found');
        }

        $app->fill($request->all());
        $app->save();

        return $this->sendResponse($app->toArray(), 'App updated successfully');
    }

    /**
     * Remove the specified App from storage.
     * DELETE /apps/{id}.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var App $app */
        $app = App::find($id);

        if (empty($app)) {
            return $this->sendError('App not found');
        }

        $app->delete();

        return $this->sendResponse($id, 'App deleted successfully');
    }
}

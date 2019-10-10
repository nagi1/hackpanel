<?php

namespace App\Http\Controllers\API;

use App\App;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateKeyAPIRequest;
use App\Http\Requests\API\UpdateKeyAPIRequest;
use App\Key;
use App\Plan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Response;

/**
 * Class KeyController.
 */
class KeyAPIController extends AppBaseController
{
    /**
     * Undocumented function
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Undocumented function
     *
     * @param \App\Http\Requests\API\CreateKeyAPIRequest $r
     *
     * @return void
     */
    public function keyLogin(Request $r)
    {
        //check if key belongs to app
        try {
            $app = App::where('access_token', '=', $r->access_token)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return $this->sendError('invalid Key');
        }

        //check if key exists
        try {
            $key = Key::where('key', '=', $r->key)->firstOrFail();
            $keyVisible = ['key', 'expires', 'hwid', 'email'];
        } catch (ModelNotFoundException $e) {
            return $this->sendError('invalid Key');
        }

        if (! empty($key->expires)) {
            //check if the key expiered
            $date = Carbon::parse($key->expires);
            if ($date->isPast()) {
                return $this->sendError('Key Expired! Please Purchasing New Key.');
            }
        }

        //check for first use
        if (empty($key->last_use)) {
            //set HWID
            $key->hwid = $r->hwid;

            //last login
            $key->last_use = Carbon::now();

            //set expire date according to key plan
            if (! config('main.new_key_expires')) {
                $plan = Plan::find($key->plan_id);
                $key->expires = Carbon::now()->add($plan->interval_unit, $plan->interval_value);
            }

            $key->update();

            return $this->sendResponse($key->customMV($keyVisible)->toArray(), 'Thanks for purchasing, Enjoy!');
        }

        //check for HWID
        if ($key->hwid != $r->hwid) {
            return $this->sendError('Error! This key was purchased only for one pc!');
        }

        //register Last Login
        $key->last_use = Carbon::now();
        $key->update();

        return $this->sendResponse($key->customMV($keyVisible)->toArray(), 'Wellcome Back!');
    }

    /**
     * Display a listing of the Key.
     * GET|HEAD /keys.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Key::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $keys = $query->get();

        return $this->sendResponse($keys->toArray(), 'Keys retrieved successfully');
    }


    /**
     * Undocumented function
     *
     * @param \App\Http\Requests\API\CreateKeyAPIRequest $request
     *
     * @return void
     */
    public function store(CreateKeyAPIRequest $request)
    {
        $input = $request->all();

        /** @var Key $key */
        $key = Key::create($input);

        return $this->sendResponse($key->toArray(), 'Key saved successfully');
    }


    /**
     * Undocumented function
     *
     * @param [type] $id
     *
     * @return void
     */
    public function show($id)
    {
        /** @var Key $key */
        $key = Key::find($id);

        if (empty($key)) {
            return $this->sendError('Key not found');
        }

        return $this->sendResponse($key->toArray(), 'Key retrieved successfully');
    }

    public function update($id, UpdateKeyAPIRequest $request)
    {
        /** @var Key $key */
        $key = Key::find($id);

        if (empty($key)) {
            return $this->sendError('Key not found');
        }

        $key->fill($request->all());
        $key->save();

        return $this->sendResponse($key->toArray(), 'Key updated successfully');
    }

    /**
     * Remove the specified Key from storage.
     * DELETE /keys/{id}.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Key $key */
        $key = Key::find($id);

        if (empty($key)) {
            return $this->sendError('Key not found');
        }

        $key->delete();

        return $this->sendResponse($id, 'Key deleted successfully');
    }
}

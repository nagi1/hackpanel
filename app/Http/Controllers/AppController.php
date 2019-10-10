<?php

namespace App\Http\Controllers;

use Response;
use Flash;
use App\Http\Requests\UpdateAppRequest;
use App\Http\Requests\CreateAppRequest;
use App\DataTables\AppDataTable;
use App\App;

class AppController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the App.
     *
     * @param AppDataTable $appDataTable
     * @return Response
     */
    public function index(AppDataTable $appDataTable)
    {
        return $appDataTable->render('apps.index');
    }

    /**
     * Show the form for creating a new App.
     *
     * @return Response
     */
    public function create()
    {
        return view('apps.create');
    }

    /**
     * Store a newly created App in storage.
     *
     * @param CreateAppRequest $request
     *
     * @return Response
     */
    public function store(CreateAppRequest $request)
    {
        $input = $request->all();

        //dd($input);
        /** @var App $app */
        $app = App::create($input);

        $this->handleMeta($input, $app);

        Flash::success('App saved successfully.');

        return redirect(route('apps.index'));
    }

    private function handleMeta($input, App $app)
    {
        if (isset($input['meta_key'])) {
            foreach ($input['meta_key'] as $id => $meta_key) {
                //check if key is empty to ignore
                if (!empty($meta_key)) {
                    $value = $input['meta_value'][$id];

                    if (empty($value)) {
                        $app->deleteMeta($meta_key);
                    } else {
                        $app->addOrUpdateMeta($meta_key, $value);
                    }
                }
            }
        }
    }

    /**
     * Display the specified App.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var App $app */
        $app = App::find($id);

        if (empty($app)) {
            Flash::error('App not found');

            return redirect(route('apps.index'));
        }

        return view('apps.show')->with('app', $app);
    }

    /**
     * Show the form for editing the specified App.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var App $app */
        $app = App::find($id);

        if (empty($app)) {
            Flash::error('App not found');

            return redirect(route('apps.index'));
        }

        return view('apps.edit')->with('app', $app);
    }

    /**
     * Update the specified App in storage.
     *
     * @param  int              $id
     * @param UpdateAppRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAppRequest $request)
    {
        /** @var App $app */
        $app = App::find($id);

        if (empty($app)) {
            Flash::error('App not found');

            return redirect(route('apps.index'));
        }

        $app->fill($request->all());
        $app->save();
        $this->handleMeta($request, $app);

        Flash::success('App updated successfully.');

        return redirect(route('apps.index'));
    }

    /**
     * Remove the specified App from storage.
     *
     * @param  int $id
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
            Flash::error('App not found');

            return redirect(route('apps.index'));
        }

        $app->delete();

        Flash::success('App deleted successfully.');

        return redirect(route('apps.index'));
    }
}

<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Flash;
use App\Plan;
use App\Key;
use App\Http\Requests\UpdateKeyRequest;
use App\Http\Requests\CreateKeyRequest;
use App\DataTables\KeyDataTable;

class KeyController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Key.
     *
     * @param KeyDataTable $keyDataTable
     *
     * @return Response
     */
    public function index(KeyDataTable $keyDataTable)
    {
        return $keyDataTable->render('keys.index');
    }

    /**
     * Show the form for creating a new Key.
     *
     * @return Response
     */
    public function create()
    {
        $ar = [
            'sad'  => 'fdsf',
            'dsfs' => 'sdf',
        ];

        return
        view('keys.create');
    }

    /**
     * Store a newly created Key in storage.
     *
     * @param CreateKeyRequest $request
     *
     * @return Response
     */
    public function store(CreateKeyRequest $request)
    {
        $input = $request->all();

        if ($input['key_count'] > config('main.max_gen_key')) {
            Flash::error('you can generate upto ' . config('main.max_gen_key') . ' keys only at a time');

            return redirect(route('keys.index'));
        }

        $input['user_id'] = Auth::id();
        $keys             = [];

        for ($i = 0; $i < $input['key_count']; ++$i) {
            $input['key']     = $input['key_prefix'] . strtoupper(str_random($input['key_len']));
            $input['user_id'] = Auth::id();

            $plan = Plan::find($input['plan_id']);

            if (config('main.new_key_expires') || isset($input['new_key_expires'])) {
                $input['expires'] = Carbon::now()->add($plan->interval_unit, $plan->interval_value);
            }

            $key    = Key::create($input);
            $keys[] = $key->key;
        }

        /** @var Key $key */
        $key = Key::create($input);

        Flash::success('Key saved successfully. Generated keys: <br>' . implode('<br>', $keys));

        return redirect(route('keys.index'));
    }

    /**
     * Display the specified Key.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Key $key */
        $key = Key::find($id);

        if (empty($key)) {
            Flash::error('Key not found');

            return redirect(route('keys.index'));
        }

        return view('keys.show')->with('key', $key);
    }

    /**
     * Show the form for editing the specified Key.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Key $key */
        $key = Key::find($id);

        if (empty($key)) {
            Flash::error('Key not found');

            return redirect(route('keys.index'));
        }

        return view('keys.edit')
            ->with('key', $key);
    }

    /**
     * Update the specified Key in storage.
     *
     * @param int              $id
     * @param UpdateKeyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKeyRequest $request)
    {
        /** @var Key $key */
        $key = Key::find($id);

        if (empty($key)) {
            Flash::error('Key not found');

            return redirect(route('keys.index'));
        }

        $key->fill($request->all());
        $key->save();

        Flash::success('Key updated successfully.');

        return redirect(route('keys.index'));
    }

    /**
     * Remove the specified Key from storage.
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
            Flash::error('Key not found');

            return redirect(route('keys.index'));
        }

        $key->delete();

        Flash::success('Key deleted successfully.');

        return redirect(route('keys.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\DataTables\PlanDataTable;
use App\Http\Requests\CreatePlanRequest;
use App\Http\Requests\UpdatePlanRequest;
use App\Plan;
use Flash;
use Response;

class PlanController extends AppBaseController
{
    /**
     * Display a listing of the Plan.
     *
     * @param PlanDataTable $planDataTable
     * @return Response
     */
    public function index(PlanDataTable $planDataTable)
    {
        return $planDataTable->render('plans.index');
    }

    /**
     * Show the form for creating a new Plan.
     *
     * @return Response
     */
    public function create()
    {
        return view('plans.create');
    }

    /**
     * Store a newly created Plan in storage.
     *
     * @param CreatePlanRequest $request
     *
     * @return Response
     */
    public function store(CreatePlanRequest $request)
    {
        $input = $request->all();

        /** @var Plan $plan */
        $plan = Plan::create($input);

        Flash::success('Plan saved successfully.');

        return redirect(route('plans.index'));
    }

    /**
     * Display the specified Plan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Plan $plan */
        $plan = Plan::find($id);

        if (empty($plan)) {
            Flash::error('Plan not found');

            return redirect(route('plans.index'));
        }

        return view('plans.show')->with('plan', $plan);
    }

    /**
     * Show the form for editing the specified Plan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Plan $plan */
        $plan = Plan::find($id);

        if (empty($plan)) {
            Flash::error('Plan not found');

            return redirect(route('plans.index'));
        }

        return view('plans.edit')->with('plan', $plan);
    }

    /**
     * Update the specified Plan in storage.
     *
     * @param  int              $id
     * @param UpdatePlanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlanRequest $request)
    {
        /** @var Plan $plan */
        $plan = Plan::find($id);

        if (empty($plan)) {
            Flash::error('Plan not found');

            return redirect(route('plans.index'));
        }

        $plan->fill($request->all());
        $plan->save();

        Flash::success('Plan updated successfully.');

        return redirect(route('plans.index'));
    }

    /**
     * Remove the specified Plan from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Plan $plan */
        $plan = Plan::find($id);

        if (empty($plan)) {
            Flash::error('Plan not found');

            return redirect(route('plans.index'));
        }

        $plan->delete();

        Flash::success('Plan deleted successfully.');

        return redirect(route('plans.index'));
    }
}

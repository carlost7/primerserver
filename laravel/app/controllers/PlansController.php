<?php

class PlansController extends \BaseController {

    /**
     * Display a listing of plans
     *
     * @return Response
     */
    public function index()
    {
        $plans = Plan::all();

        return View::make('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new plan
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.plans.create');
    }

    /**
     * Store a newly created plan in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make($data      = Input::all(), Plan::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        Plan::create($data);

        return Redirect::route('admin.plans.index');
    }

    /**
     * Display the specified plan.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $plan = Plan::findOrFail($id);

        return View::make('admin.plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified plan.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $plan = Plan::find($id);

        return View::make('admin.plans.edit', compact('plan'));
    }

    /**
     * Update the specified plan in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $plan = Plan::findOrFail($id);

        $validator = Validator::make($data      = Input::all(), Plan::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $plan->update($data);

        return Redirect::route('admin.plans.index');
    }

    /**
     * Remove the specified plan from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Plan::destroy($id);

        return Redirect::route('admin.plans.index');
    }

}

<?php

class HostingCostsController extends \BaseController {

      /**
       * Display a listing of hostingcosts
       *
       * @return Response
       */
      public function index()
      {
            $hostingCosts = HostingCost::all();

            return View::make('admin.hostingcosts.index', compact('hostingCosts'));
      }

      /**
       * Show the form for creating a new hostingcost
       *
       * @return Response
       */
      public function create()
      {
            $plans = Plan::lists('plan_name', 'id');
            return View::make('admin.hostingcosts.create',compact('plans'));
      }

      /**
       * Store a newly created hostingcost in storage.
       *
       * @return Response
       */
      public function store()
      {
            $validator = Validator::make($data      = Input::all(), HostingCost::$rules);

            if ($validator->fails())
            {
                  return Redirect::back()->withErrors($validator)->withInput();
            }

            HostingCost::create($data);

            return Redirect::route('admin.hostingcosts.index');
      }

      /**
       * Display the specified hostingcost.
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            $hostingcost = HostingCost::findOrFail($id);

            return View::make('admin.hostingcosts.show', compact('hostingcost'));
      }

      /**
       * Show the form for editing the specified hostingcost.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $plans = Plan::lists('plan_name', 'id');
            $hostingcost = HostingCost::find($id);

            return View::make('admin.hostingcosts.edit', compact('hostingcost','plans'));
      }

      /**
       * Update the specified hostingcost in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $hostingcost = HostingCost::findOrFail($id);
            
            $validator = Validator::make($data      = Input::all(), HostingCost::$rules);

            if ($validator->fails())
            {
                  return Redirect::back()->withErrors($validator)->withInput();
            }

            $hostingcost->update($data);

            return Redirect::route('admin.hosting_costs.index');
      }

      /**
       * Remove the specified hostingcost from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            HostingCost::destroy($id);

            return Redirect::route('admin.hosting_costs.index');
      }

}

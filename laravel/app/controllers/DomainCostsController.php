<?php

class DomainCostsController extends \BaseController {

      /**
       * Display a listing of domaincosts
       *
       * @return Response
       */
      public function index()
      {
            $domainCosts = DomainCost::all();

            return View::make('admin.domaincosts.index', compact('domainCosts'));
      }

      /**
       * Show the form for creating a new domaincost
       *
       * @return Response
       */
      public function create()
      {
            return View::make('admin.domaincosts.create');
      }

      /**
       * Store a newly created domaincost in storage.
       *
       * @return Response
       */
      public function store()
      {
            $domainCosts = new DomainCost;

            if ($domainCosts->save())
            {
                  Session::flash("message", "Costo creado con exito");
                  return Redirect::route('admin.domain_costs.index');
            }

            return Redirect::back()->withInput()->withErrors($domainCosts->errors());
      }

      /**
       * Display the specified domaincost.
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            $domainCost = DomainCost::findOrFail($id);

            return View::make('admin.domaincosts.show', compact('domainCost'));
      }

      /**
       * Show the form for editing the specified domaincost.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $domainCost = DomainCost::find($id);

            return View::make('admin.domaincosts.edit', compact('domainCost'));
      }

      /**
       * Update the specified domaincost in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $domainCost = DomainCost::findOrFail($id);
            
            if ($domainCost->updateUniques())
            {
                  Session::flash("message","Costo actualizado con exito");
                  return Redirect::route('admin.domain_costs.index');
            }

            return Redirect::back()->withErrors($domainCost->errors())->withInput();
      }

      /**
       * Remove the specified domaincost from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            DomainCost::destroy($id);

            return Redirect::route('admin.domain_costs.index');
      }

}

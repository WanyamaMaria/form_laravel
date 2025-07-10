<?php

namespace App\Http\Controllers;
use App\Http\Requests\rightsrequestFormRequest;
use App\Models\RightsRequest;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

/**
 * RightsRequestController handles the rights request form submission and management.
 */
class RightsRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    
        public function create()
        {
            //$posts = RightsRequest::all();
            return view('rights_request_form');
        }
    

    /**
     * Store a newly created resource in storage.
     */
   
    public function store(rightsrequestFormRequest $request)
    {
        $data = $request->validate([]);
        Auth::user()->rightsRequests()->create($data);

        //RightsRequest::create($data);

        return redirect()->route('rights-requests.showAll')->with('success', 'Request added successfully.');
    }




    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    $data = RightsRequest::findOrFail($id);

    return view('rights-requests.show', compact('data'));


    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit($id)
{
    $data = RightsRequest::findOrFail($id);
    return view('rights-requests.edit', compact('data'));
}

    

    /**
     * Update the specified resource in storage.
     */
   
    public function update(rightsrequestFormRequest $request, $id)
{
    $validatedData = $request->validate([
       
    ]);

    $data = RightsRequest::findOrFail($id);
    $data->update($validatedData);

    return redirect()->route('rights-requests.showAll')->with('success', 'Request updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = RightsRequest::findOrFail($id);
        $data->delete(); // Soft delete

        return redirect()->route('rights-requests.showAll')->with('success', 'Request deleted successfully.');
    }

    // Restore a soft deleted request
    public function restore($id)
    {
        $data = RightsRequest::withTrashed()->findOrFail($id);
        $data->restore();

        return redirect()->route('rights-requests.index')->with('success', 'Request restored successfully.');
    }

    // Show only trashed (soft deleted) requests
    public function trashed()
    {
        $trashed = RightsRequest::onlyTrashed()->get();
        return view('rights-requests.trashed', compact('trashed'));
    }

    public function showAll()
    {
        $requests = RightsRequest::all();
        return view('rights-requests.show', compact('requests'));
    }
}

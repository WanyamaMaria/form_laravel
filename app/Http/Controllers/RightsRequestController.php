<?php

namespace App\Http\Controllers;
use App\Http\Requests\rightsrequestFormRequest;
use App\Models\RightsRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    $requests = RightsRequest::with('user')->get();
    return view('admin.requests', compact('requests'));
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
    $data = $request->validated();
    $data['initiate_payments'] = in_array('initiate', $request->rights ?? []) ? true : false;
    $data['review_payments'] = in_array('review', $request->rights ?? []) ? true : false;
    $data['approve_payments'] = in_array('approve', $request->rights ?? []) ? true : false;
    unset($data['rights']); // Use validated data from FormRequest
    Auth::user()->rightsRequests()->create($data);

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
   
//     public function update(rightsrequestFormRequest $request, $id)
// {
//     $validatedData = $request->validate([
       
//     ]);

//     $data = RightsRequest::findOrFail($id);
    
//     $data->update($validatedData);

//     return redirect()->route('rights-requests.showAll')->with('success', 'Request updated successfully.');
// }

public function update(rightsrequestFormRequest $request, $id)
{
    $data = RightsRequest::findOrFail($id);

    $validated = $request->validated();

    // Update checkboxes safely
    $validated['initiate_payments'] = in_array('initiate', $request->rights ?? []) ? true : false;
    $validated['review_payments'] = in_array('review', $request->rights ?? []) ? true : false;
    $validated['approve_payments'] = in_array('approve', $request->rights ?? []) ? true : false;
    unset($validated['rights']);

    $data->update($validated);

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

    // public function showAll()
    // {
    //     $requests = RightsRequest::all();
    //     return view('rights-requests.show', compact('requests'));
    // }
    public function showAll()
{
    $requests = Auth::user()->rightsRequests()->get();
    return view('rights-requests.show', compact('requests'));
}

public function approveAsDepartmentHead($id)
{
    $request = RightsRequest::findOrFail($id);
    $request->hod_approved = true;
    $request->hod_approver_id = auth()->id();
    $request->save();

    return redirect()->back()->with('success', 'Approved as HOD');
}

public function approveAsFinanceHead($id)
{
    $request = RightsRequest::findOrFail($id);
    $request->finance_approved = true;
    $request->finance_approver_id = auth()->id();
    $request->save();

    return redirect()->back()->with('success', 'Approved as Finance Head');
}

}

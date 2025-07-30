<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RightsRequest;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
   public function department(Request $request)
{
    $query = RightsRequest::query();

    if ($request->status === 'pending') {
        $query->whereNull('hod_signature');
    } elseif ($request->status === 'approved') {
        $query->whereNotNull('hod_signature');
    }

    $requests = $query->orderByDesc('created_at')->get();

    return view('approvals.department', [
        'requests' => $requests,
        'status' => $request->status
    ]);
}

    public function finance(Request $request)
    {
        $query = RightsRequest::whereNotNull('hod_signature'); // Only those approved by HOD

        if ($request->status === 'pending') {
            $query->whereNull('finance_head_signature');
        } elseif ($request->status === 'approved') {
            $query->whereNotNull('finance_head_signature');
        }

        $requests = $query->orderByDesc('created_at')->get();

        return view('approvals.finance', [
            'requests' => $requests,
            'status' => $request->status
        ]);
    }

    public function approve(Request $request, $id)
    {
        $data = RightsRequest::findOrFail($id);

        // HEAD OF DEPARTMENT approval
        if (Auth::user()->isDepartmentHead()) {
            $request->validate([
                'hod_signature' => 'required|string|max:255',
            ]);

            $data->hod_signature = $request->input('hod_signature');
            $data->hod_name = Auth::user()->name;
            $data->hod_date = now();
            $data->status = 'Approved by HOD';
        }

        // FINANCE HEAD approval
        elseif (Auth::user()->isFinanceHead()) {
            $request->validate([
                'finance_head_signature' => 'required|string|max:255',
            ]);

            $data->finance_head_signature = $request->input('finance_head_signature');
            $data->finance_head_name = Auth::user()->name;
            $data->finance_head_date = now();
            $data->status = 'Approved by Finance Head';
        }

        $data->save();

        return redirect()->back()->with('success', 'Request approved successfully.');
    }

    public function deny(Request $request, $id)
    {
        $data = RightsRequest::findOrFail($id);

        // HOD rejection
        
            if (Auth::user()->isDepartmentHead()) {
            $request->validate([
                'hod_signature' => 'required|string|max:255',
            ]);

            $data->hod_signature = $request->input('hod_signature');
            $data->hod_name = Auth::user()->name;
            $data->hod_date = now();
            $data->status = 'Rejected by HOD';
        }

        // Finance Head rejection
        elseif (Auth::user()->isFinanceHead()) {
             $request->validate([
                'finance_head_signature' => 'required|string|max:255',
            ]);
            $data->hod_signature = $request->input('finance_head_signature');
            $data->finance_head_name = Auth::user()->name;
            $data->finance_head_date = now();
            $data->status = 'Rejected by Finance Head';
        }

        $data->save();

        return redirect()->back()->with('success', 'Request denied successfully.');
    }
}

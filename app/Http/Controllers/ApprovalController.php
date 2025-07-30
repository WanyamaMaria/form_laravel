<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RightsRequest;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function department()
    {
        // Show all requests pending HOD approval
        $requests = RightsRequest::whereNull('hod_signature')->get();
        return view('approvals.department', compact('requests'));
    }

    public function finance()
    {
        // Show all requests approved by HOD but pending Finance
        $requests = RightsRequest::whereNotNull('hod_signature')
            ->whereNull('finance_head_signature')
            ->get();
        return view('approvals.finance', compact('requests'));
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
            $data->hod_signature = 'denied';
            $data->hod_name = Auth::user()->name;
            $data->hod_date = now();
            $data->status = 'Rejected by HOD';
        }

        // Finance Head rejection
        elseif (Auth::user()->isFinanceHead()) {
            $data->finance_head_signature = 'denied';
            $data->finance_head_name = Auth::user()->name;
            $data->finance_head_date = now();
            $data->status = 'Rejected by Finance Head';
        }

        $data->save();

        return redirect()->back()->with('success', 'Request denied successfully.');
    }
}

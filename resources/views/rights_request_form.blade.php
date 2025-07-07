<!DOCTYPE html>
<html>
<head>
    <title>Rights Requisition Form</title>
    <style>
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>
    
    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif
    <!

    <h2>ONAFRIQ MOBILE MONEY PLATFORM RIGHTS REQUISITION FORM</h2>

    <form method="POST" action="{{ route('rights-requests.store') }}">
        @csrf

        <label>Date:</label>
        <input type="date" name="date" value="{{ old('date') }}"><br>
        @error('date') <div class="error">{{ $message }}</div> @enderror

        <label>Staff Name:</label>
        <input type="text" name="staff_name" value="{{ old('staff_name') }}"><br>
        @error('staff_name') <div class="error">{{ $message }}</div> @enderror

        <label>Department:</label>
        <input type="text" name="department" value="{{ old('department') }}"><br>
        @error('department') <div class="error">{{ $message }}</div> @enderror

        <label>Section:</label>
        <input type="text" name="section" value="{{ old('section') }}"><br>
        @error('section') <div class="error">{{ $message }}</div> @enderror

        <label>Job Title:</label>
        <input type="text" name="job_title" value="{{ old('job_title') }}"><br>
        @error('job_title') <div class="error">{{ $message }}</div> @enderror

        <label>Rights Requested:</label><br>
<input type="hidden" name="rights[]" value=""> {{-- Ensures 'rights' is always submitted --}}

<input type="checkbox" name="rights[]" value="initiate" {{ is_array(old('rights')) && in_array('initiate', old('rights')) ? 'checked' : '' }}> Initiate Payments<br>
<input type="checkbox" name="rights[]" value="review" {{ is_array(old('rights')) && in_array('review', old('rights')) ? 'checked' : '' }}> Review/Verify Payments<br>
<input type="checkbox" name="rights[]" value="approve" {{ is_array(old('rights')) && in_array('approve', old('rights')) ? 'checked' : '' }}> Approve Payments<br>
@error('rights') <div class="error">{{ $message }}</div> @enderror


        <label>Urgency:</label><br>
        <input type="radio" name="urgency" value="high" {{ old('urgency') == 'high' ? 'checked' : '' }}> High (&lt;1 day)<br>
        <input type="radio" name="urgency" value="medium" {{ old('urgency') == 'medium' ? 'checked' : '' }}> Medium (&lt;3 days)<br>
        <input type="radio" name="urgency" value="low" {{ old('urgency') == 'low' ? 'checked' : '' }}> Low (&lt;1 week)<br>
        @error('urgency') <div class="error">{{ $message }}</div> @enderror

        <h4>Section Manager Approval</h4>
        <label>Name:</label> 
        <input type="text" name="section_manager_name" value="{{ old('section_manager_name') }}"><br>
        @error('section_manager_name') <div class="error">{{ $message }}</div> @enderror

        <label>Job Title:</label>
        <input type="text" name="section_manager_job_title" value="{{ old('section_manager_job_title') }}"><br>
        @error('section_manager_job_title') <div class="error">{{ $message }}</div> @enderror

        <label>Signature:</label> 
        <input type="text" name="section_manager_signature" value="{{ old('section_manager_signature') }}"><br>
        @error('section_manager_signature') <div class="error">{{ $message }}</div> @enderror

        <label>Date:</label> 
        <input type="date" name="section_manager_date" value="{{ old('section_manager_date') }}"><br>
        @error('section_manager_date') <div class="error">{{ $message }}</div> @enderror

        <h4>Head Of Department Approval (if user is not in the finance department)</h4>
        <label>Name:</label> 
        <input type="text" name="hod_name" value="{{ old('hod_name') }}"><br>
        @error('hod_name') <div class="error">{{ $message }}</div> @enderror

        <label>Job Title:</label> 
        <input type="text" name="hod_job_title" value="{{ old('hod_job_title') }}"><br>
        @error('hod_job_title') <div class="error">{{ $message }}</div> @enderror

        <label>Signature:</label>
        <input type="text" name="hod_signature" value="{{ old('hod_signature') }}"><br>
        @error('hod_signature') <div class="error">{{ $message }}</div> @enderror

        <label>Date:</label> 
        <input type="date" name="hod_date" value="{{ old('hod_date') }}"><br>
        @error('hod_date') <div class="error">{{ $message }}</div> @enderror

        <h4>Head Of Finance Approval</h4>
        <label>Name:</label> 
        <input type="text" name="finance_head_name" value="{{ old('finance_head_name') }}"><br>
        @error('finance_head_name') <div class="error">{{ $message }}</div> @enderror

        <label>Job Title:</label>
        <input type="text" name="finance_head_job_title" value="{{ old('finance_head_job_title') }}"><br>
        @error('finance_head_job_title') <div class="error">{{ $message }}</div> @enderror

        <label>Signature:</label> 
        <input type="text" name="finance_head_signature" value="{{ old('finance_head_signature') }}"><br>
        @error('finance_head_signature') <div class="error">{{ $message }}</div> @enderror

        <label>Date:</label> 
        <input type="date" name="finance_head_date" value="{{ old('finance_head_date') }}"><br>
        @error('finance_head_date') <div class="error">{{ $message }}</div> @enderror

        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>

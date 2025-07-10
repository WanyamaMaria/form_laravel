<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rights Requisition Form</title>
    <link rel="stylesheet" href="{{ asset('css/messages.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<div class="container">
    @if(session('success'))
        <div id= "success-message" class="success-message">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <h2>ONAFRIQ MOBILE MONEY PLATFORM RIGHTS REQUISITION FORM.</h2>

    <form method="POST" action="{{ route('rights-requests.store') }}">
        @csrf

        <div class="form-section">
            <label><i class="fas fa-calendar-alt"></i> Date:</label>
            <input type="date" name="date" value="{{ old('date') }}">
            @error('date') <div class="error">{{ $message }}</div> @enderror

            <label><i class="fas fa-user"></i> Staff Name:</label>
            <input type="text" name="staff_name" value="{{ old('staff_name') }}">
            @error('staff_name') <div class="error">{{ $message }}</div> @enderror

            <label><i class="fas fa-building"></i> Department:</label>
            <input type="text" name="department" value="{{ old('department') }}">
            @error('department') <div class="error">{{ $message }}</div> @enderror

            <label><i class="fas fa-sitemap"></i> Section:</label>
            <input type="text" name="section" value="{{ old('section') }}">
            @error('section') <div class="error">{{ $message }}</div> @enderror

            <label><i class="fas fa-briefcase"></i> Job Title:</label>
            <input type="text" name="job_title" value="{{ old('job_title') }}">
            @error('job_title') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-section">
            <label><i class="fas fa-shield-alt"></i> Rights Requested:</label>
            
            <div class="checkbox-group">
                <label><input type="checkbox" name="rights[]" value="initiate" {{ in_array('initiate', old('rights', [])) ? 'checked' : '' }}> Initiate Payments</label>
                <label><input type="checkbox" name="rights[]" value="review" {{ in_array('review', old('rights', [])) ? 'checked' : '' }}> Review/Verify Payments</label>
                <label><input type="checkbox" name="rights[]" value="approve" {{ in_array('approve', old('rights', [])) ? 'checked' : '' }}> Approve Payments</label>
            </div>
            @error('rights') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-section">
            <label><i class="fas fa-bolt"></i> Urgency:</label>
            <div class="radio-group">
                <label><input type="radio" name="urgency" value="high" {{ old('urgency') == 'high' ? 'checked' : '' }}> High (&lt;1 day)</label>
                <label><input type="radio" name="urgency" value="medium" {{ old('urgency') == 'medium' ? 'checked' : '' }}> Medium (&lt;3 days)</label>
                <label><input type="radio" name="urgency" value="low" {{ old('urgency') == 'low' ? 'checked' : '' }}> Low (&lt;1 week)</label>
            </div>
            @error('urgency') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-section">
            <h3><i class="fas fa-user-check"></i> Section Manager Approval</h3>
            <label>Name:</label>
            <input type="text" name="section_manager_name" value="{{ old('section_manager_name') }}">
            @error('section_manager_name') <div class="error">{{ $message }}</div> @enderror

            <label>Job Title:</label>
            <input type="text" name="section_manager_job_title" value="{{ old('section_manager_job_title') }}">
            @error('section_manager_job_title') <div class="error">{{ $message }}</div> @enderror

            <label>Signature:</label>
            <input type="text" name="section_manager_signature" value="{{ old('section_manager_signature') }}">
            @error('section_manager_signature') <div class="error">{{ $message }}</div> @enderror

            <label>Date:</label>
            <input type="date" name="section_manager_date" value="{{ old('section_manager_date') }}">
            @error('section_manager_date') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-section">
            <h3><i class="fas fa-user-tie"></i> Head Of Department Approval(if user is not in the finance department)</h3>
            <label>Name:</label>
            <input type="text" name="hod_name" value="{{ old('hod_name') }}">
            @error('hod_name') <div class="error">{{ $message }}</div> @enderror

            <label>Job Title:</label>
            <input type="text" name="hod_job_title" value="{{ old('hod_job_title') }}">
            @error('hod_job_title') <div class="error">{{ $message }}</div> @enderror

            <label>Signature:</label>
            <input type="text" name="hod_signature" value="{{ old('hod_signature') }}">
            @error('hod_signature') <div class="error">{{ $message }}</div> @enderror

            <label>Date:</label>
            <input type="date" name="hod_date" value="{{ old('hod_date') }}">
            @error('hod_date') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-section">
            <h3><i class="fas fa-money-check-alt"></i> Head Of Finance Approval</h3>
            <label>Name:</label>
            <input type="text" name="finance_head_name" value="{{ old('finance_head_name') }}">
            @error('finance_head_name') <div class="error">{{ $message }}</div> @enderror

            <label>Job Title:</label>
            <input type="text" name="finance_head_job_title" value="{{ old('finance_head_job_title') }}">
            @error('finance_head_job_title') <div class="error">{{ $message }}</div> @enderror

            <label>Signature:</label>
            <input type="text" name="finance_head_signature" value="{{ old('finance_head_signature') }}">
            @error('finance_head_signature') <div class="error">{{ $message }}</div> @enderror

            <label>Date:</label>
            <input type="date" name="finance_head_date" value="{{ old('finance_head_date') }}">
            @error('finance_head_date') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="submit-btn">
             Submit Form
        </button>
    </form>
</div>
</body>
</html>

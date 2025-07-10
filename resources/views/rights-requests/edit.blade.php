<head>
    <meta charset="UTF-8">
    <title>Edit Rights Requisition</title>
    <link rel="stylesheet" href="{{ asset('css/messages.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
<div class="container">
    @if(session('success'))
        <div id="success-message" class="success-message">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <h2>EDIT RIGHTS REQUISITION FORM</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('rights-requests.update', $data->id) }}">
        @csrf
        @method('PUT')

        <div class="form-section">
            <label><i class="fas fa-calendar-alt"></i> Date:</label>
            <input type="date" name="date" value="{{ old('date', \Carbon\Carbon::parse($data->date)->format('Y-m-d')) }}">

            <label><i class="fas fa-user"></i> Staff Name:</label>
            <input type="text" name="staff_name" value="{{ old('staff_name', $data->staff_name) }}">

            <label><i class="fas fa-building"></i> Department:</label>
            <input type="text" name="department" value="{{ old('department', $data->department) }}">

            <label><i class="fas fa-sitemap"></i> Section:</label>
            <input type="text" name="section" value="{{ old('section', $data->section) }}">

            <label><i class="fas fa-briefcase"></i> Job Title:</label>
            <input type="text" name="job_title" value="{{ old('job_title', $data->job_title) }}">
        </div>
@php
    $oldRights = old('rights');
    $currentRights = $oldRights !== null ? $oldRights : (is_array($data->rights) ? $data->rights : json_decode($data->rights, true));
@endphp

<div class="form-section">
    <label><i class="fas fa-shield-alt"></i> Rights Requested:</label>
    <div class="checkbox-group">
        <label><input type="checkbox" name="rights[]" value="initiate" {{ in_array('initiate', $currentRights ?? []) ? 'checked' : '' }}> Initiate Payments</label>
        <label><input type="checkbox" name="rights[]" value="review" {{ in_array('review', $currentRights ?? []) ? 'checked' : '' }}> Review/Verify Payments</label>
        <label><input type="checkbox" name="rights[]" value="approve" {{ in_array('approve', $currentRights ?? []) ? 'checked' : '' }}> Approve Payments</label>
    </div>
</div>

        <!-- <div class="form-section">
            <label><i class="fas fa-shield-alt"></i> Rights Requested:</label>

            @php
                $rights = is_array($data->rights) ? $data->rights : json_decode($data->rights, true);
            @endphp
            <div class="checkbox-group">
                <label><input type="checkbox" name="rights[]" value="initiate" {{ in_array('initiate', old('rights', $rights ?? [])) ? 'checked' : '' }}> Initiate Payments</label>
                <label><input type="checkbox" name="rights[]" value="review" {{ in_array('review', old('rights', $rights ?? [])) ? 'checked' : '' }}> Review/Verify Payments</label>
                <label><input type="checkbox" name="rights[]" value="approve" {{ in_array('approve', old('rights', $rights ?? [])) ? 'checked' : '' }}> Approve Payments</label>
            </div>
        </div> -->

        <div class="form-section">
            <label><i class="fas fa-bolt"></i> Urgency:</label>
            <div class="radio-group">
                <label><input type="radio" name="urgency" value="high" {{ old('urgency', $data->urgency) == 'high' ? 'checked' : '' }}> High (&lt;1 day)</label>
                <label><input type="radio" name="urgency" value="medium" {{ old('urgency', $data->urgency) == 'medium' ? 'checked' : '' }}> Medium (&lt;3 days)</label>
                <label><input type="radio" name="urgency" value="low" {{ old('urgency', $data->urgency) == 'low' ? 'checked' : '' }}> Low (&lt;1 week)</label>
            </div>
        </div>

        <div class="form-section">
            <h3><i class="fas fa-user-check"></i> Section Manager Approval</h3>
            <label>Name:</label>
            <input type="text" name="section_manager_name" value="{{ old('section_manager_name', $data->section_manager_name) }}">

            <label>Job Title:</label>
            <input type="text" name="section_manager_job_title" value="{{ old('section_manager_job_title', $data->section_manager_job_title) }}">

            <label>Signature:</label>
            <input type="text" name="section_manager_signature" value="{{ old('section_manager_signature', $data->section_manager_signature) }}">

            <label>Date:</label>
            <input type="date" name="section_manager_date" value="{{ old('section_manager_date', \Carbon\Carbon::parse($data->section_manager_date)->format('Y-m-d')) }}">
        </div>

        <div class="form-section">
            <h3><i class="fas fa-user-tie"></i> Head Of Department Approval (if user is not in the finance department)</h3>
            <label>Name:</label>
            <input type="text" name="hod_name" value="{{ old('hod_name', $data->hod_name) }}">

            <label>Job Title:</label>
            <input type="text" name="hod_job_title" value="{{ old('hod_job_title', $data->hod_job_title) }}">

            <label>Signature:</label>
            <input type="text" name="hod_signature" value="{{ old('hod_signature', $data->hod_signature) }}">

            <label>Date:</label>
            <input type="date" name="hod_date" value="{{ old('hod_date', \Carbon\Carbon::parse($data->hod_date)->format('Y-m-d')) }}">
        </div>

        <div class="form-section">
            <h3><i class="fas fa-money-check-alt"></i> Head Of Finance Approval</h3>
            <label>Name:</label>
            <input type="text" name="finance_head_name" value="{{ old('finance_head_name', $data->finance_head_name) }}">

            <label>Job Title:</label>
            <input type="text" name="finance_head_job_title" value="{{ old('finance_head_job_title', $data->finance_head_job_title) }}">

            <label>Signature:</label>
            <input type="text" name="finance_head_signature" value="{{ old('finance_head_signature', $data->finance_head_signature) }}">

            <label>Date:</label>
            <input type="date" name="finance_head_date" value="{{ old('finance_head_date', \Carbon\Carbon::parse($data->finance_head_date)->format('Y-m-d')) }}">
        </div>

        <button type="submit" class="submit-btn">
            Update Form
        </button>
    </form>
</div>
</body>

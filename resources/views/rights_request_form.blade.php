<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rights Requisition Form</title>
    <link rel="stylesheet" href="{{ asset('css/messages.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="logout-btn2">
        <i class="fas fa-sign-out-alt"></i> Logout
    </button>
</form>

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
            <input type="text" name="staff_name" value="{{ Auth::user()->name }}" >

            <!-- <input type="text" name="staff_name" value="{{ old('staff_name') }}"> -->
            @error('staff_name') <div class="error">{{ $message }}</div> @enderror

            <label><i class="fas fa-building"></i> Department:</label>
            <select name="department" required>
                <option value="">-- Select Department --</option>
                <option value="Finance" {{ old('department') == 'Finance' ? 'selected' : '' }}>Finance</option>
                <option value="IT" {{ old('department') == 'IT' ? 'selected' : '' }}>IT</option>
                <option value="HR" {{ old('department') == 'HR' ? 'selected' : '' }}>HR</option>
                <option value="Operations" {{ old('department') == 'Operations' ? 'selected' : '' }}>Operations</option>
            </select>
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
                <label><input type="checkbox" name="rights[]" value="initiate" > Initiate Payments</label>
                <label><input type="checkbox" name="rights[]" value="review" > Review/Verify Payments</label>
                <label><input type="checkbox" name="rights[]" value="approve"> Approve Payments</label>
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
            <select name="hod_name" required>
                <option value="">-- Select HOD --</option>
                <option value="John Doe" {{ old('hod_name') == 'John Doe' ? 'selected' : '' }}>John Doe</option>
                <option value="Jane Smith" {{ old('hod_name') == 'Jane Smith' ? 'selected' : '' }}>Jane Smith</option>
            </select>
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
            <select name="finance_head_name" required>
                <option value="">-- Select Head of Finance --</option>
                <option value="Mary Finance" {{ old('finance_head_name') == 'Mary Finance' ? 'selected' : '' }}>Mary Finance</option>
                <option value="Peter Accountant" {{ old('finance_head_name') == 'Peter Accountant' ? 'selected' : '' }}>Peter Accountant</option>
            </select>
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
<script>
    // Wait 4 seconds, then fade out the message
    setTimeout(() => {
        const flash = document.getElementById('success-message');
        if (flash) {
            flash.style.transition = 'opacity 0.5s ease';
            flash.style.opacity = '0';
            setTimeout(() => flash.remove(), 500); // Remove from DOM after fade
        }
    }, 4000); // 4 seconds
</script>

</body>
</html>

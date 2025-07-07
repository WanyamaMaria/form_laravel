<form action="{{ route('rights-requests.update', $data->id) }}" method="POST">
    @csrf
    @method('PUT')
   
</form>


<div class="container">
    <h2>Edit Rights Request</h2>

   
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif

    <form action="{{ route('rights-requests.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Date:</label>
        <input type="date" name="date" value="{{ old('date', $data->date) }}"><br>

        <label>Staff Name:</label>
        <input type="text" name="staff_name" value="{{ old('staff_name', $data->staff_name) }}"><br>

        <label>Department:</label>
        <input type="text" name="department" value="{{ old('department', $data->department) }}"><br>

        <label>Section:</label>
        <input type="text" name="section" value="{{ old('section', $data->section) }}"><br>

        <label>Job Title:</label>
        <input type="text" name="job_title" value="{{ old('job_title', $data->job_title) }}"><br>

        <label>Rights:</label><br>
        @php
            $rights = is_array($data->rights) ? $data->rights : json_decode($data->rights, true);
        @endphp
        <input type="checkbox" name="rights[]" value="initiate" {{ in_array('initiate', old('rights', $rights ?? [])) ? 'checked' : '' }}> Initiate
        <input type="checkbox" name="rights[]" value="review" {{ in_array('review', old('rights', $rights ?? [])) ? 'checked' : '' }}> Review
        <input type="checkbox" name="rights[]" value="approve" {{ in_array('approve', old('rights', $rights ?? [])) ? 'checked' : '' }}> Approve<br>

        <label>Urgency:</label>
        <select name="urgency">
            <option value="low" {{ old('urgency', $data->urgency) === 'low' ? 'selected' : '' }}>Low</option>
            <option value="medium" {{ old('urgency', $data->urgency) === 'medium' ? 'selected' : '' }}>Medium</option>
            <option value="high" {{ old('urgency', $data->urgency) === 'high' ? 'selected' : '' }}>High</option>
        </select><br>

        <h4>Section Manager Approval</h4>
        <label>Name:</label>
        <input type="text" name="section_manager_name" value="{{ old('section_manager_name', $data->section_manager_name) }}"><br>
        <label>Job Title:</label>
        <input type="text" name="section_manager_job_title" value="{{ old('section_manager_job_title', $data->section_manager_job_title) }}"><br>
        <label>Signature:</label>
        <input type="text" name="section_manager_signature" value="{{ old('section_manager_signature', $data->section_manager_signature) }}"><br>
        <label>Date:</label>
        <input type="date" name="section_manager_date" value="{{ old('section_manager_date', $data->section_manager_date) }}"><br>

        <h4>Head Of Department Approval (if user is not in the finance department)</h4>
        <label>Name:</label>
        <input type="text" name="hod_name" value="{{ old('hod_name', $data->hod_name) }}"><br>
        <label>Job Title:</label>
        <input type="text" name="hod_job_title" value="{{ old('hod_job_title', $data->hod_job_title) }}"><br>
        <label>Signature:</label>
        <input type="text" name="hod_signature" value="{{ old('hod_signature', $data->hod_signature) }}"><br>
        <label>Date:</label>
        <input type="date" name="hod_date" value="{{ old('hod_date', $data->hod_date) }}"><br>

        <h4>Finance Head Approval</h4>
        <label>Name:</label>
        <input type="text" name="finance_head_name" value="{{ old('finance_head_name', $data->finance_head_name) }}"><br>
        <label>Job Title:</label>
        <input type="text" name="finance_head_job_title" value="{{ old('finance_head_job_title', $data->finance_head_job_title) }}"><br>
        <label>Signature:</label>
        <input type="text" name="finance_head_signature" value="{{ old('finance_head_signature', $data->finance_head_signature) }}"><br>
        <label>Date:</label>
        <input type="date" name="finance_head_date" value="{{ old('finance_head_date', $data->finance_head_date) }}"><br>

        <button type="submit">Update</button>
    </form>
</div>


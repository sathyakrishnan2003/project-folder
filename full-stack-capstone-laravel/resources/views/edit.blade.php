<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Job</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 12px;
            margin-top: 7px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            min-height: 150px;
        }

        button {
            background: #2563eb;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>Edit Job</h1>

    <form method="POST"
          action="{{ route('jobs.update', $job) }}">

        @csrf

        @method('PUT')

        <label>Job Title</label>

        <input type="text"
               name="title"
               value="{{ $job->title }}"
               required>


        <label>Company</label>

        <input type="text"
               name="company"
               value="{{ $job->company }}"
               required>


        <label>Location</label>

        <input type="text"
               name="location"
               value="{{ $job->location }}"
               required>


        <label>Job Type</label>

        <select name="job_type">

            <option value="Full Time"
                {{ $job->job_type == 'Full Time' ? 'selected' : '' }}>
                Full Time
            </option>

            <option value="Part Time"
                {{ $job->job_type == 'Part Time' ? 'selected' : '' }}>
                Part Time
            </option>

            <option value="Internship"
                {{ $job->job_type == 'Internship' ? 'selected' : '' }}>
                Internship
            </option>

            <option value="Remote"
                {{ $job->job_type == 'Remote' ? 'selected' : '' }}>
                Remote
            </option>

        </select>


        <label>Salary</label>

        <input type="number"
               name="salary"
               value="{{ $job->salary }}">


        <label>Skills</label>

        <input type="text"
               name="skills"
               value="{{ $job->skills }}">


        <label>Description</label>

        <textarea name="description"
                  required>{{ $job->description }}</textarea>


        <button type="submit">
            Update Job
        </button>

    </form>

    <br>

    <a href="{{ route('jobs.index') }}">
        ← Back to Jobs
    </a>

</div>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Job</title>

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

        .error {
            color: red;
            margin-bottom: 15px;
        }

        a {
            text-decoration: none;
        }

    </style>
</head>

<body>

<div class="container">

    <h1>Create Job</h1>

    @if($errors->any())

        <div class="error">

            <ul>

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form method="POST"
          action="{{ route('jobs.store') }}">

        @csrf

        <label>Job Title</label>

        <input type="text"
               name="title"
               value="{{ old('title') }}"
               required>


        <label>Company</label>

        <input type="text"
               name="company"
               value="{{ old('company') }}"
               required>


        <label>Location</label>

        <input type="text"
               name="location"
               value="{{ old('location') }}"
               required>


        <label>Job Type</label>

        <select name="job_type">

            <option value="Full Time">
                Full Time
            </option>

            <option value="Part Time">
                Part Time
            </option>

            <option value="Internship">
                Internship
            </option>

            <option value="Remote">
                Remote
            </option>

        </select>


        <label>Salary</label>

        <input type="number"
               name="salary"
               value="{{ old('salary') }}">


        <label>Skills</label>

        <input type="text"
               name="skills"
               placeholder="PHP, Laravel, MySQL"
               value="{{ old('skills') }}">


        <label>Description</label>

        <textarea name="description"
                  required>{{ old('description') }}</textarea>


        <button type="submit">
            Create Job
        </button>

    </form>

    <br>

    <a href="{{ route('jobs.index') }}">
        ← Back to Jobs
    </a>

</div>

</body>

</html>
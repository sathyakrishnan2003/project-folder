<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>{{ $job->title }}</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        .company {
            color: #2563eb;
            font-size: 20px;
            font-weight: bold;
        }

        .description {
            line-height: 1.7;
        }

        .btn {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 10px 18px;
            border-radius: 5px;
            text-decoration: none;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>
        {{ $job->title }}
    </h1>

    <p class="company">
        {{ $job->company }}
    </p>

    <p>
        📍 {{ $job->location }}
    </p>

    <p>
        💼 {{ $job->job_type }}
    </p>

    @if($job->salary)

        <p>
            💰 ₹{{ number_format($job->salary, 2) }}
        </p>

    @endif

    @if($job->skills)

        <p>
            <strong>Skills:</strong>
            {{ $job->skills }}
        </p>

    @endif

    <h3>Description</h3>

    <p class="description">
        {{ $job->description }}
    </p>

    <br>

    <a class="btn"
       href="{{ route('jobs.edit', $job) }}">
        Edit Job
    </a>

    <a href="{{ route('jobs.index') }}">
        Back to Jobs
    </a>

</div>

</body>

</html>
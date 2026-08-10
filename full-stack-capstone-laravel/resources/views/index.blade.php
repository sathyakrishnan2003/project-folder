<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Job Board</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #222;
        }

        .navbar {
            background: #1f2937;
            color: white;
            padding: 18px 6%;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
        }

        .btn {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        .btn-danger {
            background: #dc2626;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        .success {
            background: #d1fae5;
            color: #065f46;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 25px;
        }

        .job-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .job-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .job-card h2 {
            margin-top: 0;
            color: #111827;
        }

        .company {
            color: #2563eb;
            font-weight: bold;
        }

        .job-info {
            color: #555;
            margin: 8px 0;
        }

        .description {
            line-height: 1.6;
            color: #444;
        }

        .actions {
            margin-top: 20px;
        }

        .actions a {
            margin-right: 8px;
        }

        .empty {
            background: white;
            padding: 40px;
            text-align: center;
            border-radius: 10px;
        }

        @media (max-width: 900px) {

            .job-grid {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 600px) {

            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .job-grid {
                grid-template-columns: 1fr;
            }

        }

    </style>
</head>

<body>

    <nav class="navbar">

        <div class="logo">
            Job Board
        </div>

        <div>

            <a href="{{ route('jobs.index') }}">
                Jobs
            </a>

            <a href="{{ route('jobs.create') }}">
                Post Job
            </a>

        </div>

    </nav>


    <main class="container">

        <div class="header">

            <h1>
                Available Jobs
            </h1>

            <a class="btn"
               href="{{ route('jobs.create') }}">
                + Post a Job
            </a>

        </div>


        @if(session('success'))

            <div class="success">
                {{ session('success') }}
            </div>

        @endif


        @if($jobs->count() > 0)

            <div class="job-grid">

                @foreach($jobs as $job)

                    <div class="job-card">

                        <h2>
                            {{ $job->title }}
                        </h2>

                        <p class="company">
                            {{ $job->company }}
                        </p>

                        <p class="job-info">
                            📍 {{ $job->location }}
                        </p>

                        <p class="job-info">
                            💼 {{ $job->job_type }}
                        </p>

                        @if($job->salary)

                            <p class="job-info">
                                💰 ₹{{ number_format($job->salary, 2) }}
                            </p>

                        @endif

                        <p class="description">
                            {{ \Illuminate\Support\Str::limit($job->description, 150) }}
                        </p>

                        @if($job->skills)

                            <p class="job-info">
                                <strong>Skills:</strong>
                                {{ $job->skills }}
                            </p>

                        @endif

                        <div class="actions">

                            <a class="btn"
                               href="{{ route('jobs.show', $job) }}">
                                View
                            </a>

                            <a class="btn"
                               href="{{ route('jobs.edit', $job) }}">
                                Edit
                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="empty">

                <h2>
                    No Jobs Available
                </h2>

                <p>
                    There are currently no jobs posted.
                </p>

                <a class="btn"
                   href="{{ route('jobs.create') }}">
                    Post the First Job
                </a>

            </div>

        @endif

    </main>

</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            padding: 18px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 40px auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .btn {
            background: #2563eb;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
        }

        .job-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .job-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .job-card h2 {
            margin-top: 0;
        }

        .company {
            color: #2563eb;
            font-weight: bold;
        }

        .success {
            background: #d1fae5;
            color: #065f46;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        @media (max-width: 900px) {
            .job-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .job-grid {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">
    <strong>Job Board</strong>

    <div>
        <a href="{{ route('jobs.index') }}">Jobs</a>

        @auth
            <a href="{{ route('jobs.create') }}">Post Job</a>
        @endauth
    </div>
</nav>

<div class="container">

    <div class="header">
        <h1>Available Jobs</h1>

        @auth
            <a class="btn" href="{{ route('jobs.create') }}">
                + Post a Job
            </a>
        @endauth
    </div>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="job-grid">

        @forelse($jobs as $job)

            <div class="job-card">

                <h2>{{ $job->title }}</h2>

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

                <p>
                    {{ Str::limit($job->description, 120) }}
                </p>

                <a
                    class="btn"
                    href="{{ route('jobs.show', $job) }}"
                >
                    View Job
                </a>

            </div>

        @empty

            <p>No jobs available yet.</p>

        @endforelse

    </div>

</div>

</body>
</html>
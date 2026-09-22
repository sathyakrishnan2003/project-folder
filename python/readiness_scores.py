placement = {
    "project_completion": 40,
    "assessment_scores": 30,
    "cia_usage": 10,
    "documentation": 20
}

interview = {
    "viva_scores": 40,
    "code_review": 30,
    "demo_clarity": 20,
    "git_quality": 10
}

placement_score = sum(placement.values())
interview_score = sum(interview.values())

print("Placement Readiness:", placement_score)
print("Interview Readiness:", interview_score)
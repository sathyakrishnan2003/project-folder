import json

resume = {
    "keywords": ["PHP", "Laravel", "JavaScript", "SQL", "Git"],
    "skills": ["Full Stack Development", "Laravel", "JavaScript"],
    "experience": "Internship experience",
    "formatting": "Structured sections"
}

result = {
    "keyword_score": 80,
    "formatting_score": 85,
    "experience_score": 75,
    "skills_score": 90,
    "total_score": 83,
    "keyword_gaps": ["React", "Docker"],
    "rewrite_suggestions": [
        "Add measurable project achievements",
        "Mention relevant technologies clearly"
    ]
}

print(json.dumps(result, indent=2))
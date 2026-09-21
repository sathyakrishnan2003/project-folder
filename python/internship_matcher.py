import json

roles = [
    {"role": "Full Stack Developer", "skills": ["PHP", "Laravel", "JavaScript"]},
    {"role": "Backend Developer", "skills": ["PHP", "Laravel", "SQL"]},
    {"role": "AI Developer", "skills": ["Python", "AI", "APIs"]},
    {"role": "Frontend Developer", "skills": ["JavaScript", "HTML", "CSS"]},
    {"role": "Software Engineer", "skills": ["Programming", "SQL", "Git"]}
]

candidate_skills = {"PHP", "Laravel", "JavaScript"}

results = []

for role in roles:
    matched = len(candidate_skills.intersection(role["skills"]))
    score = round((matched / len(role["skills"])) * 100)
    results.append({
        "role": role["role"],
        "match": score
    })

print(json.dumps(sorted(results, key=lambda x: x["match"], reverse=True), indent=2))
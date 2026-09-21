import json

def recommend_careers(skill_gaps):
    return {
        "recommendations": [
            {
                "career": "Full Stack Developer",
                "reason": "Matches web development and Laravel skills"
            },
            {
                "career": "Backend Developer",
                "reason": "Suitable for API and database development"
            },
            {
                "career": "AI Application Developer",
                "reason": "Builds on AI integration and programming skills"
            }
        ]
    }

if __name__ == "__main__":
    print(json.dumps(recommend_careers(["PHP", "Laravel", "API Development"])))
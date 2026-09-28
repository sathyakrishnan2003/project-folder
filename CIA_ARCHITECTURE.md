\# CIA Career Intelligence Architecture



\## Career Routes

1\. /candidate/cia/career

2\. /candidate/cia/career/skill-gap

3\. /candidate/cia/career/recommendations

4\. /candidate/cia/career/internships

5\. /candidate/cia/career/learning-path

6\. /candidate/cia/career/profile

7\. /candidate/cia/career/history



\## API Contract



POST /candidate/cia/career/skill-gap

Request: candidate skills, completed lessons, quiz scores

Response: gaps, score, priority\_learning

Auth: Candidate login required



POST /candidate/cia/career/recommendations

Request: skill gaps

Response: career paths

Auth: Candidate login required



POST /candidate/cia/career/internships

Request: candidate skill profile

Response: matching internship roles

Auth: Candidate login required



\## ChromaDB Collection



Collection: cynaris\_intern\_profiles



Fields:

\- candidate\_id

\- skills

\- scores

\- history


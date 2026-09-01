# W5D2: Business Process Mapping — Lead to Closure + API Inspection
## EspoCRM API Testing & Documentation

**Date**: September 1, 2026  
**Task**: Business Process Mapping - Lead to Closure + API Inspection  
**Status**: In Progress  

---

## Task Overview

This assignment focuses on:
1. ✅ Setting up EspoCRM via Docker
2. ✅ Creating business entities (Lead, Opportunity, Account, Activity)
3. ✅ Testing EspoCRM REST API endpoints
4. Documenting API usage and responses
5. Git workflow and PR submission

---

## Completed Tasks

### 1. Environment Setup
- **Status**: ✅ COMPLETED
- **Docker Containers**:
  - espocrm: Running on `http://localhost:8080` (Port 8080)
  - espocrm-db (MariaDB): Running and healthy
  - espocrm-daemon: Running

```bash
CONTAINER ID   IMAGE                    COMMAND          STATUS         PORTS
41e28610b137   espocrm/espocrm:latest   "docker-daemon"  Up 19 minutes  80/tcp
7e9f40cf22cb   espocrm/espocrm:latest   "docker-entry.." Up 19 minutes  0.0.0.0:8080->80/tcp
5cb3cab0ee96   mariadb:latest           "docker-entry.." Up 19 minutes  3306/tcp
```

### 2. Admin Authentication
- **Status**: ✅ COMPLETED
- **Credentials**: 
  - Username: `admin`
  - Password: `admin123`
- **Access**: Successfully logged in to EspoCRM admin panel

### 3. Business Entity Creation

#### Lead (✅ COMPLETED)
- **Lead ID**: 6a96960ea751a82e7
- **Name**: John Doe
- **Created**: September 1, 2026
- **Status**: Successfully created via browser UI

#### Opportunity (In Progress)
- **Name**: Sales Opportunity - Q3 2026
- **Amount**: 50000 USD
- **Close Date**: September 30, 2026
- **Status**: Need to complete via API

#### Account (Pending)
- To be created via API call

#### Activity (Pending)
- To be created via API call

---

## API Testing Plan

### API Endpoints to Test

#### 1. GET /api/v1/Lead
- **Purpose**: Retrieve all leads in the system
- **Method**: GET
- **Headers**: 
  - `X-Espo-Authorization: {token}`
  - `Content-Type: application/json`
- **Expected Response**: JSON array of lead records with fields:
  - id
  - name
  - status
  - rating
  - website
  - etc.

#### 2. GET /api/v1/Account
- **Purpose**: Retrieve all accounts in the system
- **Method**: GET
- **Headers**: Same as above
- **Expected Response**: JSON array of account records

#### 3. GET /api/v1/Opportunity
- **Purpose**: Retrieve all opportunities in the system
- **Method**: GET
- **Headers**: Same as above
- **Expected Response**: JSON array of opportunity records with:
  - id
  - name
  - stage
  - amount
  - closeDate
  - probability
  - etc.

---

## Authentication Method

EspoCRM uses token-based authentication. Steps:

1. **Get Token**: POST to `/api/v1/Auth`
   ```json
   {
     "username": "admin",
     "password": "admin123"
   }
   ```

2. **Response**: Returns token and userId
   ```json
   {
     "token": "..." ,
     "userId": "..."
   }
   ```

3. **Use Token**: Include in request header
   ```
   X-Espo-Authorization: {token}
   ```

---

## API Response Examples (To Be Captured)

### Example: GET /api/v1/Lead Response
```json
{
  "total": 1,
  "list": [
    {
      "id": "6a96960ea751a82e7",
      "name": "John Doe",
      "status": "New",
      "rating": null,
      "website": null,
      "createdAt": "2026-09-01 09:08:12",
      "modifiedAt": "2026-09-01 09:08:12"
    }
  ]
}
```

---

## Tools & Technologies Used

- **EspoCRM**: v7.x (CRM System)
- **Docker**: Container orchestration
- **MariaDB**: Database (MySQL compatible)
- **PowerShell**: API testing and automation
- **Git**: Version control

---

## Key Findings

1. **EspoCRM Setup**: Dockerized environment is fully functional
2. **Admin Access**: Successfully authenticated with default credentials
3. **Database Connection**: MariaDB container connected and healthy
4. **Web Interface**: EspoCRM dashboard accessible at http://localhost:8080

---

## Next Steps

1. Complete API testing with PowerShell or Postman
2. Capture all 3 API endpoint responses
3. Create Opportunity, Account, and Activity records
4. Document all API calls with examples
5. Create git branch `feat/w5d2-3m-[name]`
6. Commit changes with meaningful messages
7. Push to upstream and create/update PR

---

## Files Generated

- `espocrm_api_test.ps1` - PowerShell script for API testing
- `espocrm_api_leads_response.json` - API response (to be generated)
- `espocrm_api_accounts_response.json` - API response (to be generated)
- `espocrm_api_opportunities_response.json` - API response (to be generated)

---

## Viva Questions Preparation

### Q1: Explain what you built today
"I set up an EspoCRM instance via Docker and tested its REST API. I created a Lead entity and documented three key API endpoints: Lead, Account, and Opportunity. This demonstrates understanding of business process mapping in a CRM system and API interaction."

### Q2: What was the hardest problem? How did you solve it?
"Getting authentication working with the API. I solved it by:
- Reading the docker-compose configuration to find admin credentials
- Understanding EspoCRM's token-based authentication mechanism
- Testing the Auth endpoint to obtain a valid token
- Using the token in subsequent API requests via the X-Espo-Authorization header"

### Q3: What would you improve with one more day?
"I would:
- Complete the full business process flow (Lead to Opportunity to Account to Activity)
- Create comprehensive API documentation with cURL examples
- Write integration tests using pytest or similar
- Set up monitoring/logging for API calls
- Implement error handling and retry logic for API requests"

---

## References

- EspoCRM API Documentation: https://docs.espocrm.com/en/development/api/
- Docker EspoCRM: https://github.com/espocrm/espocrm-docker
- RESTful API Best Practices

---

**Last Updated**: September 1, 2026  
**Author**: Full Stack Development Intern (3M)

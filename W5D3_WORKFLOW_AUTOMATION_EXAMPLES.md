# W5D3: Practical Workflow & Automation Implementation

## Complete Workflow & Automation Examples for EspoCRM

---

## EXAMPLE 1: Lead Auto-Qualification Workflow

### Business Process
When a lead is created from "Web" source with complete contact information (email, phone, company), automatically:
1. Qualify the lead
2. Create an associated opportunity
3. Create a follow-up task
4. Send notification to assigned user

### Workflow JSON Configuration

```json
{
  "id": "lead-auto-qualification",
  "name": "Auto-Qualify Web Leads",
  "entity": "Lead",
  "isActive": true,
  "trigger": "afterRecord",
  "targetEvent": "create",
  "conditions": [
    {
      "field": "source",
      "operator": "equals",
      "value": "Web"
    },
    {
      "field": "accountName",
      "operator": "isNotEmpty",
      "value": true
    },
    {
      "field": "emailAddress",
      "operator": "isNotEmpty",
      "value": true
    },
    {
      "field": "phone",
      "operator": "isNotEmpty",
      "value": true
    }
  ],
  "actions": [
    {
      "type": "updateField",
      "field": "status",
      "value": "Qualified",
      "description": "Set status to Qualified"
    },
    {
      "type": "updateField",
      "field": "leadScore",
      "value": 50,
      "description": "Set initial lead score"
    },
    {
      "type": "createRelatedRecord",
      "entity": "Opportunity",
      "fields": {
        "name": "formula: concatenate(entity.name, ' - Web Lead')",
        "leadId": "formula: entity.id",
        "accountId": "formula: entity.createdAccount.id",
        "stage": "Prospecting",
        "probability": 10,
        "amount": 10000,
        "currencyCode": "USD",
        "closeDate": "formula: addDays(now(), 30)"
      },
      "description": "Create opportunity linked to this lead"
    },
    {
      "type": "createRelatedRecord",
      "entity": "Task",
      "fields": {
        "name": "Follow up on web lead - {Lead.name}",
        "leadId": "formula: entity.id",
        "opportunityId": "formula: createdRecord.Opportunity.id",
        "status": "Not Started",
        "priority": "Normal",
        "dueDate": "formula: addDays(now(), 3)",
        "assignedUserId": "formula: entity.assignedUser.id"
      },
      "description": "Create follow-up task"
    },
    {
      "type": "sendEmail",
      "to": "formula: entity.assignedUser.emailAddress",
      "template": "qualified-lead-notification",
      "data": {
        "leadName": "formula: entity.name",
        "opportunityName": "formula: createdRecord.Opportunity.name",
        "taskDueDate": "formula: addDays(now(), 3)"
      },
      "description": "Notify assigned user"
    }
  ],
  "audit": {
    "createdAt": "2026-09-01T10:30:00Z",
    "createdBy": "admin",
    "updatedAt": "2026-09-01T10:30:00Z"
  }
}
```

---

## EXAMPLE 2: Opportunity Conversion to Account Workflow

### Business Process
When an opportunity reaches "Closed Won" stage:
1. Check if account exists, otherwise create one
2. Link all contacts from opportunity to account
3. Create closing task for documentation
4. Send celebration notification to sales team

### Workflow Implementation

```json
{
  "id": "opportunity-to-account",
  "name": "Convert Won Opportunity to Account",
  "entity": "Opportunity",
  "trigger": "afterRecord",
  "conditions": [
    {
      "field": "stage",
      "operator": "equals",
      "value": "Closed Won"
    },
    {
      "field": "isClosed",
      "operator": "equals",
      "value": true
    }
  ],
  "actions": [
    {
      "type": "conditionalBranch",
      "condition": "entity.account.id == null",
      "trueBranch": [
        {
          "type": "createRelatedRecord",
          "entity": "Account",
          "fields": {
            "name": "formula: entity.name",
            "industry": "formula: entity.industry",
            "website": "formula: entity.website",
            "type": "Business",
            "description": "formula: concatenate('Created from Opportunity: ', entity.name)"
          }
        }
      ]
    },
    {
      "type": "updateField",
      "field": "closedAt",
      "value": "formula: now()"
    },
    {
      "type": "createRelatedRecord",
      "entity": "Task",
      "fields": {
        "name": "Close opportunity - Documentation & Follow-up",
        "description": "formula: concatenate('Opportunity ', entity.name, ' won with amount $', entity.amount)",
        "opportunity": "formula: entity.id",
        "status": "Not Started",
        "priority": "High",
        "dueDate": "formula: addDays(now(), 7)"
      }
    },
    {
      "type": "sendWebhook",
      "url": "https://api.slack.com/hooks/...",
      "method": "POST",
      "data": {
        "text": "formula: concatenate('🎉 Opportunity Won! ', entity.name, ' - $', entity.amount)",
        "attachments": [
          {
            "fields": [
              {
                "title": "Opportunity",
                "value": "formula: entity.name"
              },
              {
                "title": "Amount",
                "value": "formula: concatenate('$', entity.amount)"
              },
              {
                "title": "Owner",
                "value": "formula: entity.owner.name"
              }
            ]
          }
        ]
      }
    }
  ]
}
```

---

## EXAMPLE 3: Lead Scoring & Qualification Workflow

### Business Process
Automatically score leads based on multiple criteria and auto-qualify high-scoring leads

### Workflow Logic

```
Lead Scoring Formula:
├── Email exists: +10 points
├── Phone exists: +10 points
├── Company name exists: +15 points
├── Source = "Web": +20 points
├── Source = "Referral": +30 points
├── Last activity within 7 days: +15 points
├── Page visits (if tracked): +5 per visit
└── Form submissions (if tracked): +10 per submission

Auto-Qualification Threshold: Score >= 50
```

### Workflow JSON

```json
{
  "id": "lead-scoring",
  "name": "Calculate Lead Score & Auto-Qualify",
  "entity": "Lead",
  "trigger": "afterRecord",
  "targetEvent": ["create", "update"],
  "actions": [
    {
      "type": "updateField",
      "field": "leadScore",
      "value": "formula: (IF(emailAddress != null, 10, 0)) + (IF(phone != null, 10, 0)) + (IF(accountName != null, 15, 0)) + (IF(source = 'Web', 20, 0)) + (IF(source = 'Referral', 30, 0))",
      "description": "Calculate lead score based on multiple criteria"
    },
    {
      "type": "conditionalBranch",
      "condition": "formula: leadScore >= 50 AND status != 'Qualified'",
      "trueBranch": [
        {
          "type": "updateField",
          "field": "status",
          "value": "Qualified"
        },
        {
          "type": "createRelatedRecord",
          "entity": "Opportunity",
          "fields": {
            "name": "formula: concatenate(entity.name, ' - Auto-qualified lead')",
            "leadId": "formula: entity.id",
            "stage": "Prospecting",
            "amount": 15000
          }
        },
        {
          "type": "sendNotification",
          "to": "formula: entity.assignedUser.id",
          "title": "High-Scoring Lead Auto-Qualified",
          "message": "formula: concatenate(entity.name, ' has been auto-qualified with a score of ', leadScore)"
        }
      ],
      "falseBranch": [
        {
          "type": "createRelatedRecord",
          "entity": "Task",
          "fields": {
            "name": "Follow up on lead - Improve score",
            "description": "formula: concatenate('Current score: ', leadScore, '. Contact lead to gather more information.')",
            "leadId": "formula: entity.id",
            "dueDate": "formula: addDays(now(), 2)"
          }
        }
      ]
    }
  ]
}
```

---

## EXAMPLE 4: Advanced API Automation Script

### PowerShell: Comprehensive Lead Management & Automation

```powershell
# W5D3-Complete-Automation.ps1
# Purpose: Demonstrate end-to-end lead management with EspoCRM API

param(
    [string]$BaseUrl = "http://localhost:8080",
    [string]$Username = "admin",
    [string]$Password = "admin123"
)

# ============================================================================
# SECTION 1: Authentication
# ============================================================================

Write-Host "=== EspoCRM API Automation Demo ===" -ForegroundColor Cyan
Write-Host "`n[1/4] Authenticating with EspoCRM..." -ForegroundColor Yellow

$authBody = @{
    username = $Username
    password = $Password
} | ConvertTo-Json

try {
    $authResponse = Invoke-RestMethod -Uri "$BaseUrl/api/v1/Auth" `
        -Method Post `
        -Body $authBody `
        -ContentType "application/json"
    
    $token = $authResponse.token
    $userId = $authResponse.id
    
    Write-Host "✓ Authentication successful" -ForegroundColor Green
    Write-Host "  Token: $($token.Substring(0,20))..." -ForegroundColor Green
} catch {
    Write-Host "✗ Authentication failed: $_" -ForegroundColor Red
    exit 1
}

# Set up headers for subsequent requests
$headers = @{
    "X-Espo-Authorization" = $token
    "Content-Type" = "application/json"
}

# ============================================================================
# SECTION 2: Create Leads via API
# ============================================================================

Write-Host "`n[2/4] Creating sample leads..." -ForegroundColor Yellow

$leadsToCreate = @(
    @{
        name = "Tech Startup CEO"
        accountName = "TechCorp Solutions"
        emailAddress = "ceo@techcorp.com"
        phone = "+1-555-0101"
        source = "Web"
    },
    @{
        name = "Enterprise Manager"
        accountName = "Global Industries Ltd"
        emailAddress = "manager@globalind.com"
        phone = "+1-555-0102"
        source = "Referral"
    },
    @{
        name = "Startup Founder"
        accountName = "AI Innovations Inc"
        emailAddress = "founder@aiinnovations.com"
        phone = "+1-555-0103"
        source = "Event"
    }
)

$createdLeads = @()

foreach ($lead in $leadsToCreate) {
    try {
        $leadBody = $lead | ConvertTo-Json
        $response = Invoke-RestMethod -Uri "$BaseUrl/api/v1/Lead" `
            -Method Post `
            -Headers $headers `
            -Body $leadBody
        
        $createdLeads += $response
        Write-Host "  ✓ Created lead: $($response.name) (ID: $($response.id))" -ForegroundColor Green
    } catch {
        Write-Host "  ✗ Failed to create lead: $_" -ForegroundColor Red
    }
}

# ============================================================================
# SECTION 3: Retrieve and Score Leads
# ============================================================================

Write-Host "`n[3/4] Retrieving and scoring leads..." -ForegroundColor Yellow

$scoringResults = @()

foreach ($lead in $createdLeads) {
    $score = 0
    
    # Calculate score
    if ($lead.emailAddress) { $score += 10 }
    if ($lead.phone) { $score += 10 }
    if ($lead.accountName) { $score += 15 }
    if ($lead.source -eq "Web") { $score += 20 }
    if ($lead.source -eq "Referral") { $score += 30 }
    
    # Update lead with score
    $updateBody = @{ leadScore = $score } | ConvertTo-Json
    
    try {
        $updateResponse = Invoke-RestMethod -Uri "$BaseUrl/api/v1/Lead/$($lead.id)" `
            -Method Patch `
            -Headers $headers `
            -Body $updateBody
        
        $scoringResults += @{
            LeadId = $lead.id
            LeadName = $lead.name
            Score = $score
            Qualified = $score -ge 50
        }
        
        $status = if ($score -ge 50) { "QUALIFIED" } else { "PENDING" }
        Write-Host "  ✓ Scored: $($lead.name) - $score points [$status]" -ForegroundColor Green
    } catch {
        Write-Host "  ✗ Failed to update lead score: $_" -ForegroundColor Red
    }
}

# ============================================================================
# SECTION 4: Create Opportunities for Qualified Leads
# ============================================================================

Write-Host "`n[4/4] Creating opportunities for qualified leads..." -ForegroundColor Yellow

$qualifiedLeads = $scoringResults | Where-Object { $_.Qualified }

foreach ($qualLead in $qualifiedLeads) {
    $lead = $createdLeads | Where-Object { $_.id -eq $qualLead.LeadId }
    
    $oppBody = @{
        name = "Sales Opportunity - $($lead.name)"
        leadId = $lead.id
        stage = "Prospecting"
        probability = 10
        amount = 25000
        currencyCode = "USD"
        description = "Auto-created from qualified lead: $($lead.accountName)"
    } | ConvertTo-Json
    
    try {
        $oppResponse = Invoke-RestMethod -Uri "$BaseUrl/api/v1/Opportunity" `
            -Method Post `
            -Headers $headers `
            -Body $oppBody
        
        Write-Host "  ✓ Created opportunity: $($oppResponse.name)" -ForegroundColor Green
        Write-Host "    Amount: $($oppResponse.amount) $($oppResponse.currencyCode)" -ForegroundColor Green
    } catch {
        Write-Host "  ✗ Failed to create opportunity: $_" -ForegroundColor Red
    }
}

# ============================================================================
# SUMMARY REPORT
# ============================================================================

Write-Host "`n╔════════════════════════════════════════════════════════════╗" -ForegroundColor Cyan
Write-Host "║          W5D3 AUTOMATION EXECUTION SUMMARY                 ║" -ForegroundColor Cyan
Write-Host "╠════════════════════════════════════════════════════════════╣" -ForegroundColor Cyan

Write-Host "║ Leads Created:      $($createdLeads.Count)" -ForegroundColor Cyan
Write-Host "║ Leads Scored:       $($scoringResults.Count)" -ForegroundColor Cyan
Write-Host "║ Leads Qualified:    $($qualifiedLeads.Count)" -ForegroundColor Cyan
Write-Host "║ Opportunities:      $($qualifiedLeads.Count)" -ForegroundColor Cyan

Write-Host "╠════════════════════════════════════════════════════════════╣" -ForegroundColor Cyan

Write-Host "║ SCORING RESULTS:                                           ║" -ForegroundColor Cyan

foreach ($result in $scoringResults) {
    $qMarker = if ($result.Qualified) { "✓" } else { "○" }
    Write-Host "║ $qMarker $($result.LeadName.PadRight(45)) Score: $($result.Score.ToString().PadLeft(2))" -ForegroundColor Cyan
}

Write-Host "╚════════════════════════════════════════════════════════════╝" -ForegroundColor Cyan

Write-Host "`n✅ Automation workflow complete!" -ForegroundColor Green
Write-Host "`nNext Steps:" -ForegroundColor Yellow
Write-Host "  1. Verify leads in EspoCRM UI" -ForegroundColor Yellow
Write-Host "  2. Review opportunities and scores" -ForegroundColor Yellow
Write-Host "  3. Configure workflows for auto-assignment" -ForegroundColor Yellow
Write-Host "  4. Set up email notifications" -ForegroundColor Yellow

Write-Host "`nTimestamp: $(Get-Date -Format 'yyyy-MM-dd HH:mm:ss')" -ForegroundColor Gray
```

---

## EXAMPLE 5: Workflow Decision Tree (Visual)

### Complex Sales Process with Conditions

```
                    ┌─────────────────────┐
                    │  New Lead Created   │
                    └──────────┬──────────┘
                               │
                    ┌──────────▼──────────┐
                    │  Check Lead Source  │
                    └──────────┬──────────┘
                               │
            ┌──────────────┬───┴────┬──────────────┐
            │              │        │              │
            ▼              ▼        ▼              ▼
         ┌──Web──┐    ┌─Email─┐ ┌Phone┐  ┌──Other──┐
         │Score:│    │Score: │ │Score│  │Score: 10│
         │+20   │    │+15    │ │+25  │  └─────┬───┘
         └──┬───┘    └──┬────┘ └──┬──┘        │
            │           │         │           │
            └─────┬─────┴────┬────┘           │
                  │          │                │
                  ▼          ▼                ▼
         ┌─────────────────────────────────────────┐
         │ Check Contact Information               │
         │ (Email + Phone + Company = +25 points)  │
         └──────────────┬──────────────────────────┘
                        │
                 ┌──────┴──────┐
                 │             │
         Complete ▼             ▼ Incomplete
           (+25 pts)        (No bonus)
            │                │
       Score: 45-55      Score: 15-40
            │                │
    ┌───────┴────────┐  ┌────┴───────┐
    ▼                ▼  ▼            ▼
┌─Qualified──┐  ┌─Pending──┐  ┌─Schedule──┐
│- Auto      │  │- Send    │  │- Auto     │
│- Create    │  │  Follow  │  │- Assign   │
│  Opp       │  │  Up Task │  │  to Sales │
│- Create    │  │- Notify  │  │- Queue    │
│  Task      │  │  Manager │  │  for call │
│- Assign    │  └──────────┘  └───────────┘
│  to Sales  │
└────────────┘
```

---

## TESTING THE WORKFLOWS

### Step-by-Step Testing Guide

```
TEST 1: Web Lead with Complete Info
────────────────────────────────────
Input:  Create Lead
        - Source: "Web"
        - Name: "John Doe"
        - Email: "john@example.com"
        - Phone: "+1-555-1234"
        - Company: "Acme Corp"

Expected:
  ✓ Status auto-updated to "Qualified"
  ✓ Lead score = 50+ points
  ✓ Opportunity auto-created
  ✓ Task created for follow-up
  ✓ Email notification sent


TEST 2: Referral Lead with Partial Info
─────────────────────────────────────────
Input:  Create Lead
        - Source: "Referral"
        - Name: "Jane Smith"
        - Email: "jane@example.com"
        - Phone: (empty)
        - Company: "Tech Innovations"

Expected:
  ✓ Status remains "New"
  ✓ Lead score = 50+ points (because Referral source)
  ✓ Opportunity may or may not be created (depends on threshold)
  ✓ Assigned to sales rep for follow-up


TEST 3: Opportunity Won - Account Creation
────────────────────────────────────────────
Input:  Update Opportunity
        - Stage: "Closed Won"
        - Amount: $50,000
        - Link to Existing Account

Expected:
  ✓ Opportunity marked as closed
  ✓ Account linked (or created if not exists)
  ✓ Closing task created
  ✓ Slack notification sent to team
  ✓ All related contacts linked to account
```

---

## DEPLOYMENT CHECKLIST

Before deploying workflows to production:

- [ ] Test each workflow in development/staging environment
- [ ] Verify email templates and notifications configured
- [ ] Set up log monitoring for workflow execution
- [ ] Configure webhook URLs for external integrations
- [ ] Train team on new automated processes
- [ ] Set up backup/rollback procedures
- [ ] Document all workflows in wiki
- [ ] Schedule gradual rollout (pilot → full deployment)
- [ ] Monitor workflow execution for 1 week
- [ ] Collect feedback and optimize

---

**Document Status**: Complete  
**Ready for**: Viva Questions & Evaluation  
**Last Updated**: September 1, 2026, 10:30 AM

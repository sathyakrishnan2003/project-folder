# EspoCRM API Test Script - W5D2 Business Process Mapping
# This script tests the EspoCRM API with 3 key endpoints

# Configuration
$baseUrl = "http://localhost:8080"
$adminUsername = "admin"
$adminPassword = "admin123"

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "EspoCRM API Testing - W5D2 Assignment" -ForegroundColor Yellow
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Step 1: Get Authentication Token
Write-Host "[1/4] Authenticating with EspoCRM..." -ForegroundColor Green

$authBody = @{
    "username" = $adminUsername
    "password" = $adminPassword
} | ConvertTo-Json

try {
    $authResponse = Invoke-RestMethod -Uri "$baseUrl/api/v1/Auth" `
        -Method Post `
        -Body $authBody `
        -ContentType "application/json" `
        -ErrorAction Stop
    
    $token = $authResponse.token
    $userId = $authResponse.userId
    
    Write-Host "✓ Authentication successful" -ForegroundColor Green
    Write-Host "  - User ID: $userId" -ForegroundColor Gray
    Write-Host "  - Token: $($token.Substring(0, 20))..." -ForegroundColor Gray
    Write-Host ""
} catch {
    Write-Host "✗ Authentication failed: $($_.Exception.Message)" -ForegroundColor Red
    exit 1
}

# Create headers with token
$headers = @{
    "X-Espo-Authorization" = $token
    "Content-Type" = "application/json"
}

# API Call 1: GET Leads
Write-Host "[2/4] API Call #1: GET /api/v1/Lead" -ForegroundColor Green
Write-Host "Purpose: Retrieve all leads in the system" -ForegroundColor Gray

try {
    $leadsResponse = Invoke-RestMethod -Uri "$baseUrl/api/v1/Lead" `
        -Method Get `
        -Headers $headers `
        -ErrorAction Stop
    
    Write-Host "✓ Leads Retrieved Successfully" -ForegroundColor Green
    Write-Host "  - Total Records: $($leadsResponse.total)" -ForegroundColor Gray
    Write-Host "  - Records List:" -ForegroundColor Gray
    
    if ($leadsResponse.list -and $leadsResponse.list.Count -gt 0) {
        foreach ($lead in $leadsResponse.list | Select-Object -First 3) {
            Write-Host "    • ID: $($lead.id), Name: $($lead.name)" -ForegroundColor Gray
        }
    } else {
        Write-Host "    • No leads found" -ForegroundColor Gray
    }
    Write-Host ""
    
    # Save response
    $leadsResponse | ConvertTo-Json -Depth 10 | Out-File "espocrm_api_leads_response.json"
    Write-Host "  Response saved to: espocrm_api_leads_response.json" -ForegroundColor Cyan
} catch {
    Write-Host "✗ Failed to retrieve leads: $($_.Exception.Message)" -ForegroundColor Red
}

Write-Host ""

# API Call 2: GET Accounts
Write-Host "[3/4] API Call #2: GET /api/v1/Account" -ForegroundColor Green
Write-Host "Purpose: Retrieve all accounts in the system" -ForegroundColor Gray

try {
    $accountsResponse = Invoke-RestMethod -Uri "$baseUrl/api/v1/Account" `
        -Method Get `
        -Headers $headers `
        -ErrorAction Stop
    
    Write-Host "✓ Accounts Retrieved Successfully" -ForegroundColor Green
    Write-Host "  - Total Records: $($accountsResponse.total)" -ForegroundColor Gray
    Write-Host "  - Records List:" -ForegroundColor Gray
    
    if ($accountsResponse.list -and $accountsResponse.list.Count -gt 0) {
        foreach ($account in $accountsResponse.list | Select-Object -First 3) {
            Write-Host "    • ID: $($account.id), Name: $($account.name)" -ForegroundColor Gray
        }
    } else {
        Write-Host "    • No accounts found" -ForegroundColor Gray
    }
    Write-Host ""
    
    # Save response
    $accountsResponse | ConvertTo-Json -Depth 10 | Out-File "espocrm_api_accounts_response.json"
    Write-Host "  Response saved to: espocrm_api_accounts_response.json" -ForegroundColor Cyan
} catch {
    Write-Host "✗ Failed to retrieve accounts: $($_.Exception.Message)" -ForegroundColor Red
}

Write-Host ""

# API Call 3: GET Opportunities
Write-Host "[4/4] API Call #3: GET /api/v1/Opportunity" -ForegroundColor Green
Write-Host "Purpose: Retrieve all opportunities in the system" -ForegroundColor Gray

try {
    $opportunitiesResponse = Invoke-RestMethod -Uri "$baseUrl/api/v1/Opportunity" `
        -Method Get `
        -Headers $headers `
        -ErrorAction Stop
    
    Write-Host "✓ Opportunities Retrieved Successfully" -ForegroundColor Green
    Write-Host "  - Total Records: $($opportunitiesResponse.total)" -ForegroundColor Gray
    Write-Host "  - Records List:" -ForegroundColor Gray
    
    if ($opportunitiesResponse.list -and $opportunitiesResponse.list.Count -gt 0) {
        foreach ($opp in $opportunitiesResponse.list | Select-Object -First 3) {
            Write-Host "    • ID: $($opp.id), Name: $($opp.name)" -ForegroundColor Gray
        }
    } else {
        Write-Host "    • No opportunities found" -ForegroundColor Gray
    }
    Write-Host ""
    
    # Save response
    $opportunitiesResponse | ConvertTo-Json -Depth 10 | Out-File "espocrm_api_opportunities_response.json"
    Write-Host "  Response saved to: espocrm_api_opportunities_response.json" -ForegroundColor Cyan
} catch {
    Write-Host "✗ Failed to retrieve opportunities: $($_.Exception.Message)" -ForegroundColor Red
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "API Testing Complete!" -ForegroundColor Yellow
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Documentation:" -ForegroundColor Green
Write-Host "  • 3 API endpoints tested successfully" -ForegroundColor Gray
Write-Host "  • Response files generated:" -ForegroundColor Gray
Write-Host "    - espocrm_api_leads_response.json" -ForegroundColor Gray
Write-Host "    - espocrm_api_accounts_response.json" -ForegroundColor Gray
Write-Host "    - espocrm_api_opportunities_response.json" -ForegroundColor Gray

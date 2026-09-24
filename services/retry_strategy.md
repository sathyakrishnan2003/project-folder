\# Retry Strategy



Temporary 429 and 5xx errors should use limited retries with backoff.

Timeouts should trigger the configured fallback provider.

API keys must remain in environment variables.


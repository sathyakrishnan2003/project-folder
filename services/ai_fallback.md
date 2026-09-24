\# AI Error Handling and Fallback



1\. Send request to Groq.

2\. Apply timeout handling.

3\. Retry temporary failures.

4\. If Groq fails, switch to OpenRouter.

5\. Return a controlled error if both providers fail.



This prevents a single AI provider failure from stopping CIA features.


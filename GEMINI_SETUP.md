# Setting Up Gemini AI for Event Report Generation

This document provides step-by-step instructions for setting up the Gemini AI integration for the event report generation feature.

## Getting a Gemini API Key

1. Go to [Google AI Studio](https://makersuite.google.com/)
2. Sign in with your Google account
3. Navigate to the API keys section
4. Generate a new API key

## Adding the API Key to Your Project

1. Open your project's `.env` file
2. Add the following line at the end of the file:
   ```
   GEMINI_API_KEY=your-api-key-here
   ```
3. Replace `your-api-key-here` with the actual API key you obtained from Google AI Studio
4. Save the file

## Testing the Integration

1. Log in as an organizer or admin
2. Navigate to the Reports section
3. Select an event to generate a report
4. Fill in the report details
5. Click "Generate Report"
6. Review the AI-generated content
7. Edit as needed and generate the final PDF

## Fallback Mechanism

If no API key is provided, the system will automatically use a template-based approach for generating reports. This ensures the feature works even without API access, but will not provide AI-generated content. 
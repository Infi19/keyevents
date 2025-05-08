<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected $client;
    protected $apiKey;
    protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent';
    
    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('GEMINI_API_KEY', '');
    }
    
    /**
     * Generate event report content using Gemini AI
     */
    public function generateEventReport($event, $data)
    {
        try {
            if (empty($this->apiKey)) {
                Log::warning('No Gemini API key found. Using placeholder report content.');
                return $this->getPlaceholderReport($event, $data);
            }
            
            $prompt = $this->buildPrompt($event, $data);
            
            $response = $this->client->post($this->baseUrl . '?key=' . $this->apiKey, [
                'json' => [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.4,
                        'topK' => 32,
                        'topP' => 1,
                        'maxOutputTokens' => 2048,
                    ]
                ]
            ]);
            
            $result = json_decode($response->getBody()->getContents(), true);
            
            if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
                return $result['candidates'][0]['content']['parts'][0]['text'];
            } else {
                Log::error('Unable to parse Gemini response', ['response' => $result]);
                return $this->getPlaceholderReport($event, $data);
            }
        } catch (\Exception $e) {
            Log::error('Error calling Gemini API: ' . $e->getMessage());
            return $this->getPlaceholderReport($event, $data);
        }
    }
    
    /**
     * Build the prompt for Gemini AI
     */
    private function buildPrompt($event, $data)
    {
        $prompt = "You are an expert at creating educational event reports. ";
        $prompt .= "Create a detailed event report in markdown format for an academic event with the following details:\n\n";
        
        $prompt .= "Event Title: " . $event->title . "\n";
        $prompt .= "Event Date: " . date('l jS F Y', strtotime($event->event_date)) . "\n";
        
        $fromTime = $event->time_from_hour . ":" . $event->time_from_minute . " " . $event->time_from_period;
        $toTime = $event->time_to_hour . ":" . $event->time_to_minute . " " . $event->time_to_period;
        $prompt .= "Event Time: " . $fromTime . " to " . $toTime . "\n";
        
        $prompt .= "Venue: " . ($data['venue'] ?? "Keystone School of Engineering") . "\n";
        $prompt .= "Resource Person: " . ($data['resource_person'] ?? "Guest Speaker") . "\n";
        $prompt .= "Resource Person Details: " . ($data['resource_person_details'] ?? "") . "\n";
        $prompt .= "Attendees: Around " . ($data['attendees_count'] ?? "100") . " students\n";
        
        $prompt .= "Event Description: " . ($data['report_description'] ?? $event->about ?? "") . "\n\n";
        
        $prompt .= "Coordinator: " . ($data['coordinator_name'] ?? "") . "\n";
        $prompt .= "Head of Department: " . ($data['head_of_department'] ?? "") . "\n";
        $prompt .= "Principal: " . ($data['principal_name'] ?? "") . "\n\n";
        
        $prompt .= "The report should be structured with the following sections:\n";
        $prompt .= "1. Name of the Event/Activity\n";
        $prompt .= "2. Day & Date of the Event\n";
        $prompt .= "3. Time of the Event\n";
        $prompt .= "4. Venue of the Event\n";
        $prompt .= "5. Resource Person\n";
        $prompt .= "6. Company Details\n";
        $prompt .= "7. Description - Give a detailed description of the event\n";
        $prompt .= "8. Significance - Bullet points of why this event was important\n";
        $prompt .= "9. Conclusion\n";
        $prompt .= "10. Faculties and Student participation\n\n";
        
        $prompt .= "Make the report professional, detailed, and in the third person perspective. Format in Markdown. ";
        $prompt .= "Include specific details from the event description I provided. ";
        $prompt .= "Don't include information I didn't provide, and reference Keystone School of Engineering, Department of Computer Engineering, and Savitribai Phule Pune University.";
        
        return $prompt;
    }
    
    /**
     * Fallback report template when API is unavailable
     */
    private function getPlaceholderReport($event, $data)
    {
        $template = "# EVENT REPORT\n\n";
        $template .= "## Name of the Event/Activity\n";
        $template .= "\"{$event->title}\"\n\n";
        
        $template .= "## Day & Date of the Event\n";
        $template .= date('l jS F Y', strtotime($event->event_date)) . "\n\n";
        
        $template .= "## Time of the Event\n";
        $fromTime = $event->time_from_hour . ":" . $event->time_from_minute . " " . $event->time_from_period;
        $toTime = $event->time_to_hour . ":" . $event->time_to_minute . " " . $event->time_to_period;
        $template .= $fromTime . " to " . $toTime . "\n\n";
        
        $template .= "## Venue of the Event\n";
        $template .= ($data['venue'] ?? "Keystone School of Engineering") . "\n\n";
        
        $template .= "## Resource Person\n";
        $template .= ($data['resource_person'] ?? "Guest Speaker") . "\n\n";
        
        $template .= "## Company Details\n";
        $template .= ($data['resource_person_details'] ?? "Guest speaker details") . "\n\n";
        
        $template .= "## Description\n";
        $template .= ($data['report_description'] ?? $event->about ?? "Keystone School of Engineering conducted this informative and insightful event for the benefit of students, researchers, and faculty members.") . "\n\n";
        
        $template .= "## Significance\n";
        $template .= "* The event provided valuable insights to students\n";
        $template .= "* It helped disseminate novel ideas and methods\n";
        $template .= "* It was an important professional development opportunity\n";
        $template .= "* It inspired future research and applications\n\n";
        
        $template .= "## Conclusion\n";
        $template .= "The Event was conducted by Computer Engineering Department for all the students under Savitribai Phule Pune University.\n\n";
        
        $template .= "## Faculties and Student participation\n";
        $template .= "Around " . ($data['attendees_count'] ?? "100") . " students attended the session.\n\n";
        
        return $template;
    }
} 
-- Add status column to events table if it doesn't exist
ALTER TABLE events ADD COLUMN IF NOT EXISTS status VARCHAR(255) DEFAULT 'pending' AFTER time_to_period;

-- Add rejection_reason column to events table if it doesn't exist
ALTER TABLE events ADD COLUMN IF NOT EXISTS rejection_reason TEXT NULL AFTER user_id; 
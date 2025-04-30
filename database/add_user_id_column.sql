-- Add user_id column to events table if it doesn't exist
ALTER TABLE events ADD COLUMN IF NOT EXISTS user_id BIGINT UNSIGNED NULL AFTER time_to_period;

-- Add foreign key constraint
ALTER TABLE events ADD CONSTRAINT fk_events_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL; 
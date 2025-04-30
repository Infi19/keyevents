-- Create events table if it doesn't exist
CREATE TABLE IF NOT EXISTS events (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    about TEXT NOT NULL,
    image_path VARCHAR(255) NULL,
    type VARCHAR(255) NOT NULL,
    category VARCHAR(255) NOT NULL,
    event_date DATE NOT NULL,
    time_from_hour INT NOT NULL,
    time_from_minute INT NOT NULL,
    time_from_period VARCHAR(2) NOT NULL,
    time_to_hour INT NOT NULL,
    time_to_minute INT NOT NULL,
    time_to_period VARCHAR(2) NOT NULL,
    status VARCHAR(255) DEFAULT 'pending',
    user_id BIGINT UNSIGNED NULL,
    rejection_reason TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Create subscribers table if it doesn't exist
CREATE TABLE IF NOT EXISTS subscribers (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    event_id BIGINT UNSIGNED NOT NULL,
    status VARCHAR(255) DEFAULT 'registered',
    attendance BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE
); 
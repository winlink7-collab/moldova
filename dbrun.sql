CREATE TABLE IF NOT EXISTS translations_cache (
    id INT AUTO_INCREMENT PRIMARY KEY,
    source_text VARCHAR(1000) NOT NULL,
    source_hash CHAR(40) NOT NULL,
    lang VARCHAR(5) NOT NULL,
    translation TEXT NOT NULL,
    is_manual TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_src_lang (source_hash, lang),
    INDEX idx_lang (lang),
    INDEX idx_updated (updated_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci

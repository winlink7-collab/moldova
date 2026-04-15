<?php
/**
 * TranslationService - Hebrew → Russian/English with DB-backed cache
 *
 * Flow: cache hit → return instantly. Cache miss → MyMemory API → save to cache → return.
 * Manual admin edits set is_manual=1 and are never overwritten by API calls.
 */
class TranslationService {
    private $db;
    private static $memCache = []; // per-request memoization

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function translate(string $text, string $lang): string {
        $text = trim($text);
        if ($text === '' || $lang === 'he') return $text;
        if (!in_array($lang, ['ru', 'en'], true)) return $text;
        if (!preg_match('/[\x{0590}-\x{05FF}]/u', $text)) return $text; // no Hebrew → no translation

        $hash = sha1($text);
        $memKey = $hash . '|' . $lang;
        if (isset(self::$memCache[$memKey])) return self::$memCache[$memKey];

        $row = $this->db->fetchOne(
            "SELECT translation FROM translations_cache WHERE source_hash = ? AND lang = ? LIMIT 1",
            [$hash, $lang]
        );
        if ($row && !empty($row['translation'])) {
            self::$memCache[$memKey] = $row['translation'];
            return $row['translation'];
        }

        $translation = $this->callMyMemory($text, $lang);
        if ($translation === '' || $translation === $text) {
            return $text;
        }

        try {
            $this->db->execute(
                "INSERT INTO translations_cache (source_text, source_hash, lang, translation, is_manual)
                 VALUES (?, ?, ?, ?, 0)
                 ON DUPLICATE KEY UPDATE translation = IF(is_manual = 1, translation, VALUES(translation))",
                [mb_substr($text, 0, 1000), $hash, $lang, $translation]
            );
        } catch (Throwable $e) { /* ignore write failures */ }

        self::$memCache[$memKey] = $translation;
        return $translation;
    }

    public function translateMany(array $texts, string $lang): array {
        $out = [];
        foreach ($texts as $t) { $out[$t] = $this->translate((string)$t, $lang); }
        return $out;
    }

    /**
     * MyMemory free translation API - 10000 reqs/day anonymous.
     * Docs: https://mymemory.translated.net/doc/spec.php
     */
    private function callMyMemory(string $text, string $lang): string {
        $url = 'https://api.mymemory.translated.net/get?' . http_build_query([
            'q' => $text,
            'langpair' => 'he|' . $lang,
            'de' => 'noreply@royaldate.co.il',
        ]);
        $ctx = stream_context_create(['http' => ['timeout' => 4, 'ignore_errors' => true, 'header' => "User-Agent: RoyalDate/1.0\r\n"]]);
        $raw = @file_get_contents($url, false, $ctx);
        if ($raw === false) return '';
        $json = json_decode($raw, true);
        if (!is_array($json)) return '';
        $translated = $json['responseData']['translatedText'] ?? '';
        if (!is_string($translated)) return '';
        if (stripos($translated, 'PLEASE SELECT') !== false) return '';
        if (stripos($translated, 'INVALID') !== false) return '';
        return trim($translated);
    }
}

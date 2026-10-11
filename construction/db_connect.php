<?php
$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "construction_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

/**
 * Returns the correct column name for the current language.
 * Falls back to English if no translation exists.
 * 
 * @param string $base_column The base column name (e.g., 'title', 'description')
 * @return string The column name to use in SQL (e.g., 'title_sw')
 */
function get_lang_column($base_column) {
    global $lang;
    
    // If language is English, use the base column
    if ($lang == 'en') {
        return $base_column;
    }
    
    // For other languages, try the translated column
    return $base_column . '_' . $lang;
}

/**
 * Safely fetches a localized field from a database row.
 * If the translated field is empty, it falls back to the English base field.
 * 
 * @param array $row The database row
 * @param string $base_column The base column name (e.g., 'title')
 * @return string The localized value or the English fallback
 */
function get_localized_field($row, $base_column) {
    global $lang;
    
    // If English, return the base column
    if ($lang == 'en') {
        return isset($row[$base_column]) ? $row[$base_column] : '';
    }
    
    // Try the translated column first
    $translated_column = $base_column . '_' . $lang;
    if (isset($row[$translated_column]) && !empty($row[$translated_column])) {
        return $row[$translated_column];
    }
    
    // Fallback to English
    return isset($row[$base_column]) ? $row[$base_column] : '';
}
/**
 * Convert an internal .php URL into its clean equivalent.
 * Usage: echo clean_url('contact.php');
 *        echo clean_url('service-detail.php?id=8');
 */
function clean_url($url) {
    if (empty($url)) return $url;
    if (preg_match('/^(https?:)?\/\//i', $url)) return $url;
    if (preg_match('/^(mailto:|tel:|#|javascript:)/i', $url)) return $url;

    if ($url === 'index.php' || $url === './index.php') {
        return './';
    }

    if (preg_match('/^(service-detail|post)\.php\?id=([^&]+)(.*)$/', $url, $m)) {
        $rest = !empty($m[3]) ? '?' . ltrim($m[3], '?&') : '';
        return $m[1] . '/' . $m[2] . $rest;
    }

    return preg_replace('/\.php(\?|$)/', '$1', $url);
}
?>
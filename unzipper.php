<?php
// Simple PHP Web Unzipper for Production Server
$zipFile = 'production.zip';
$extractTo = '.';

if (!file_exists($zipFile)) {
    // try bodabora_project_production.zip
    $zipFile = 'bodabora_project_production.zip';
}

echo "<h2>BodaBora Server Unzipper</h2>";

if (!file_exists($zipFile)) {
    echo "<p style='color:red;'>Error: Zip file ($zipFile) not found in directory!</p>";
    exit;
}

$zip = new ZipArchive;
if ($zip->open($zipFile) === TRUE) {
    $zip->extractTo($extractTo);
    $zip->close();
    echo "<p style='color:green; font-weight:bold;'>SUCCESS: Archive extracted successfully to " . realpath($extractTo) . "</p>";
    echo "<p>Please delete unzipper.php and production.zip for security reasons.</p>";
} else {
    echo "<p style='color:red;'>Error: Failed to open zip archive. The file may be corrupted or incompletely uploaded.</p>";
}

<?php
// Simple Unzipper (Compatible with all PHP versions)
$zipFile = 'production.zip';
if (!file_exists($zipFile)) {
    $zipFile = 'bodabora_project_production.zip';
}

echo "<h1>BodaBora Unzipper</h1>";

if (!file_exists($zipFile)) {
    die("<p style='color:red;'>Error: $zipFile not found in " . __DIR__ . "</p>");
}

echo "<p>Found zip file: <strong>$zipFile</strong> (Size: " . number_format(filesize($zipFile)) . " bytes)</p>";

$zip = new ZipArchive;
$res = $zip->open($zipFile);

if ($res === TRUE) {
    $zip->extractTo('.');
    $zip->close();
    echo "<p style='color:green; font-weight:bold;'>SUCCESS! All files extracted successfully.</p>";
    echo "<p>You can now delete go.php and $zipFile.</p>";
} else {
    echo "<p style='color:red; font-weight:bold;'>Error: Could not extract $zipFile. (Error code: $res)</p>";
    echo "<p><strong>Why this happens:</strong> The zip file was either corrupted during upload, uploaded in ASCII mode instead of Binary mode, or is still uploading.</p>";
    echo "<p><strong>Solution:</strong> Please re-upload <code>production.zip</code> using cPanel File Manager in Binary mode and refresh this page.</p>";
}

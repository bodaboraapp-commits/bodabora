<?php
/**
 * BodaBora Production Server Unzipper Script
 * Place this file in your cPanel public_html or domain root folder alongside 'production.zip'
 * and navigate to https://yourdomain.com/unzip.php in your browser.
 */

$zipFileName = 'production.zip';
if (!file_exists($zipFileName)) {
    $zipFileName = 'bodabora_project_production.zip';
}
$extractPath = '.';

echo '<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 40px auto; padding: 30px; border-radius: 12px; background: #f8fafc; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">';
echo '<h2 style="color: #065f46; margin-top: 0;">⚡ BodaBora Server Unzipper</h2>';

if (!file_exists($zipFileName)) {
    echo '<p style="color: #dc2626; font-weight: bold;">Error: Could not find <code>' . $zipFileName . '</code> in this directory (' . __DIR__ . '). Please ensure the zip file is uploaded to the same folder as unzip.php.</p>';
    echo '</div>';
    exit;
}

$zip = new ZipArchive;
$res = $zip->open($zipFileName);

if ($res === TRUE) {
    $extractedFilesCount = $zip->numFiles;
    $zip->extractTo($extractPath);
    $zip->close();

    echo '<p style="color: #16a34a; font-weight: bold; font-size: 1.1em;">SUCCESS: <code>' . $zipFileName . '</code> was successfully extracted!</p>';
    echo '<p style="color: #475569;">Total files extracted: <strong>' . $extractedFilesCount . '</strong></p>';
    echo '<hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 20px 0;">';
    echo '<p style="color: #dc2626; font-size: 0.9em;"><strong>Security Notice:</strong> Please delete <code>unzip.php</code> and <code>' . $zipFileName . '</code> from your server now that extraction is complete.</p>';

    // Optional self-delete action if requested via GET
    if (isset($_GET['delete']) && $_GET['delete'] == 'yes') {
        if (file_exists(__FILE__)) {
            unlink(__FILE__);
            echo '<p style="color: #16a34a; font-weight: bold;">unzip.php has been automatically deleted.</p>';
        }
    } else {
        echo '<p><a href="unzip.php?delete=yes" style="display: inline-block; background: #dc2626; color: #fff; padding: 10px 16px; border-radius: 8px; text-decoration: none; font-weight: bold;">Delete This Unzipper Script Now</a></p>';
    }
} else {
    $errorMsg = match($res) {
        ZipArchive::ER_NOPENT => 'Could not open file.',
        ZipArchive::ER_NOENT => 'No such file.',
        ZipArchive::ER_READ => 'Read error.',
        ZipArchive::ER_EOF => 'Premature EOF.',
        default => 'Unknown error code: ' . $res
    };
    echo '<p style="color: #dc2626; font-weight: bold;">Error: Failed to extract <code>' . $zipFileName . '</code> (' . $errorMsg . ').</p>';
    echo '<p style="color: #475569; font-size: 0.9em;">Tip: This usually indicates the zip file was corrupted during upload or uploaded in ASCII mode. Please re-upload <code>production.zip</code> in <strong>Binary</strong> mode via FTP or FileZilla.</p>';
}

echo '</div>';

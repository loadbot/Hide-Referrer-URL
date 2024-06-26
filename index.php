<?php
// Check if a URL is provided via query string
if (!empty($_SERVER['QUERY_STRING'])) {
    $query_string = $_SERVER['QUERY_STRING'];

    // Extract the URL from the query string
    $url = urldecode($query_string);

    // Validate the URL
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        // Check if it's a GET request
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Output the HTML for GET method redirection
            echo '<!DOCTYPE html>
            <html>
            <head>
                <title>Redirecting...</title>
                <meta http-equiv="Refresh" content="0; url=' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '">
                <meta name="referrer" content="no-referrer">
                <script type="text/javascript">
                    window.location.href = "' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '";
                </script>
            </head>
            <body style="display: none;">
            </body>
            </html>';
            exit();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Redirect immediately for POST method
            header("Location: " . $url);
            exit();
        } else {
            echo "Unsupported request method.";
        }
    } else {
        echo "Invalid URL.";
    }
} else {
    echo "No URL provided.";
}
?>

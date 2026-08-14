<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: sans-serif; color: #0f172a;">
    <h2>New contact form message</h2>
    <p><strong>From:</strong> {{ $senderName }} ({{ $senderEmail }})</p>
    <p><strong>Topic:</strong> {{ $topic }}</p>
    <p style="white-space: pre-line;">{{ $body }}</p>
    <p><a href="mailto:{{ $senderEmail }}">Reply to {{ $senderName }}</a></p>
    <p>Thanks,<br>{{ config('app.name') }}</p>
</body>
</html>

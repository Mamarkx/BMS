<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Your {{ $document->type }} is Ready</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #e0f2fe, #f8fafc);
      font-family: 'Inter', 'Segoe UI', sans-serif;
      color: #1e293b;
    }

    .email-wrapper {
      max-width: 680px;
      margin: 48px auto;
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(12px);
      border-radius: 20px;
      box-shadow: 0 12px 32px rgba(30, 64, 175, 0.15);
      overflow: hidden;
      border: 1px solid #e2e8f0;
    }

    .header {
      background: linear-gradient(to right, #1e3a8a, #3b82f6);
      color: white;
      padding: 40px 32px;
      text-align: center;
    }

    .header h1 {
      margin: 0;
      font-size: 28px;
      font-weight: 700;
      letter-spacing: 0.5px;
    }

    .content {
      padding: 32px;
    }

    .content p {
      font-size: 16px;
      line-height: 1.7;
      margin: 16px 0;
    }

    .highlight {
      background-color: #eff6ff;
      border-left: 4px solid #3b82f6;
      padding: 16px 20px;
      border-radius: 12px;
      margin: 24px 0;
    }

    .highlight p {
      margin: 8px 0;
    }

    .hours {
      background-color: #f1f5f9;
      padding: 16px;
      border-radius: 12px;
      margin-top: 16px;
    }

    .hours ul {
      padding-left: 20px;
      margin: 8px 0;
    }

    .footer {
      background-color: #f8fafc;
      text-align: center;
      padding: 24px;
      font-size: 14px;
      color: #64748b;
      border-top: 1px solid #e2e8f0;
    }

    .footer strong {
      color: #1e3a8a;
    }
  </style>
</head>
<body>
  <div class="email-wrapper">
    <div class="header">
      <h1>{{ $greeting }}</h1>
    </div>
    <div class="content">
      <p>We’re pleased to inform you that your <strong>{{ $document->type }}</strong> has been successfully processed and is now available for release.</p>

      <div class="highlight">
        <p><strong>Reference Number:</strong> {{ $document->reference_number }}</p>
        <p><strong>Release Date:</strong> {{ $document->release_date->format('F j, Y') }}</p>
        <p><strong>Document Fee:</strong> ₱{{ number_format($document->amount, 2) }}</p>
      </div>

      <p>You may claim your document at <strong>Barangay San Agustin</strong> during the following hours:</p>

      <div class="hours">
        <ul>
          <li><strong>Monday to Friday:</strong> 8:00 AM – 5:00 PM</li>
          <li><strong>Saturday:</strong> 8:00 AM – 12:00 NN</li>
        </ul>
      </div>

      <p>Please bring a valid ID for verification and the exact payment upon claiming.</p>
      <p>If you have any questions, feel free to contact us. We’re here to assist you.</p>
    </div>
    <div class="footer">
      Thank you,<br>
      <strong>The Barangay San Agustin Team</strong>
    </div>
  </div>
</body>
</html>

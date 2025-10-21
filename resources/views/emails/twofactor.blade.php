<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Two-Factor Authentication</title>
  <style>
    /* General Reset */
    body, html {
      margin: 0;
      padding: 0;
      background-color: #f3f4f6;
      font-family: 'Helvetica', 'Arial', sans-serif;
      color: #374151;
    }
    a {
      color: #0ea5e9;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }

    /* Preheader hidden */
    .preheader {
      display: none !important;
      visibility: hidden;
      opacity: 0;
      color: transparent;
      height: 0;
      width: 0;
      overflow: hidden;
      mso-hide: all;
    }

    /* Container */
    .email-wrapper {
      width: 100%;
      min-height: 100vh;
      padding: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      box-sizing: border-box;
    }
    .email-content {
      width: 100%;
      max-width: 600px;
      background: #ffffff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    /* Header */
    .email-header {
      background: linear-gradient(90deg, #2563eb, #1d4ed8);
      padding: 40px 20px;
      text-align: center;
      color: #ffffff;
    }
    .email-header .icon {
      width: 64px;
      height: 64px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: rgba(255,255,255,0.2);
      border-radius: 12px;
      margin-bottom: 20px;
      font-size: 32px;
    }
    .email-header h1 {
      margin: 0 0 10px;
      font-size: 24px;
      font-weight: bold;
    }
    .email-header p {
      margin: 0;
      font-size: 14px;
      color: #dbeafe;
    }

    /* Body */
    .email-body {
      padding: 30px 20px;
    }
    .email-body p {
      margin: 0 0 15px;
      line-height: 1.5;
      font-size: 14px;
    }
    .email-body .otp-card {
      background: #f9fafb;
      border: 1px dashed #d1d5db;
      border-radius: 12px;
      padding: 20px;
      margin: 20px 0;
      text-align: center;
    }
    .otp-card p {
      margin: 10px 0;
    }
    .otp-card .otp-code {
      font-size: 24px;
      font-weight: bold;
      letter-spacing: 4px;
      color: #111827;
    }
    .otp-card .verify-btn {
      display: inline-block;
      margin-top: 15px;
      padding: 10px 20px;
      background: #0ea5e9;
      color: #ffffff;
      border-radius: 8px;
      font-size: 14px;
      font-weight: bold;
      text-decoration: none;
    }
    .otp-card .verify-btn:hover {
      background: #0284c7;
    }

    /* Footer */
    .email-footer {
      background: #f3f4f6;
      text-align: center;
      padding: 20px;
      font-size: 12px;
      color: #6b7280;
    }
  </style>
</head>
<body>

  <!-- Preheader -->
  <div class="preheader">
    Enter your 2FA code to securely access your account. Expires in 10 minutes.
  </div>

  <div class="email-wrapper">
    <div class="email-content">

      <!-- Header -->
      <div class="email-header">
        <h1>Two-Factor Authentication</h1>
        <p>Please enter the verification code to authenticate your account</p>
      </div>

      <!-- Body -->
      <div class="email-body">
        <p>Hello <strong>{{ $user->name }}</strong>,</p>
        <p>Use the code below to securely access your account:</p>

        <div class="otp-card">
          <p class="otp-code">{{ $code }}</p>
        </div>

        <p>This code will expire in <strong>10 minutes</strong>. If you did not request this, please ignore this email or contact our support team.</p>

        <p><strong>Need help?</strong> Visit our <a href="#">support center</a> or reply to this email.</p>
        <p>For your security, never share your code. We will never ask for it via phone or other channels.</p>
      </div>

      <!-- Footer -->
      <div class="email-footer">
        <p>© <span id="year"></span>Brgy San Agustin. All rights reserved.</p>
        <p>If you no longer wish to receive these emails, you may <a href="#">unsubscribe</a>.</p>
      </div>

    </div>
  </div>

  <script>
    document.getElementById('year').textContent = new Date().getFullYear();
  </script>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
  <title>Payment Success</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f9f3;
    }
    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 50px;
      background-color: #ffffff;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    h1 {
      color: #24b47e;
      font-size: 24px;
      margin-bottom: 20px;
    }
    p {
      color: #333333;
      font-size: 16px;
      line-height: 1.5;
      margin-bottom: 20px;
    }
    button {
      background-color: #24b47e;
      color: #ffffff;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #1a8b61;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Payment Successful!</h1>
    <p>Thank you for your payment.</p>
    <p>Your transaction has been successfully completed.</p>
    <button onclick="goToHome()">Back to Home</button>
  </div>

  <script>
    function goToHome() {
      // Replace 'https://www.example.com' with your actual home page URL
      window.location.href = 'http://locahost:8080/';
    }
  </script>
</body>
</html>

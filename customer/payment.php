<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ชำระเงิน</title>
    <style>
        body {
            background-color: #ffc0cb; /* พื้นหลังสีชมพู */  ใส่โค้ดรูปแบบนี้IMG_0340 .jpeg แทนโค้ดรูปแบบที่มีอยู่หน่อยค่ะ
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .payment-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .payment-container h2 {
            color: #333;
        }
        .qr-code img {
            width: 200px;
            height: 200px;
        }
        .details {
            margin-top: 15px;
            text-align: left;
        }
        .details p {
            margin: 5px 0;
        }
        .button-container {
            margin-top: 20px;
        }
        .pay-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .pay-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h2>ชำระเงินด้วย PromptPay</h2>
        <div class="qr-code"><img src="IMG_0340 .jpeg" alt="QR Code"></div>
        <div class="details">
            <p><strong>รหัสการชำระเงิน:</strong> 1101000110101</p>
            <p><strong>ร้านค้า:</strong> cosmeticnew</p>
            <p><strong>หมายเลขอ้างอิง:</strong> ORDER_ID</p>
        </div>
        <div class="button-container">
            <button class="pay-button">ตรวจสอบการชำระเงิน</button>
        </div>
    </div>
</body>
</html>
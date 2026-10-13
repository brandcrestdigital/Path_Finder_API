<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Confirmation</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background: #f4f4f4; 
            padding: 20px; 
            margin: 0;
        }
        .container { 
            max-width: 600px; 
            margin: 0 auto; 
            background: white; 
            padding: 30px; 
            border-radius: 8px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 { color: #2c3e50; }
        .info-row { margin: 12px 0; }
        .label { 
            font-weight: bold; 
            display: inline-block; 
            width: 160px; 
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thank You, {{ $application->full_name }}!</h1>
        
        <p>Your application has been successfully received.</p>
        
        <h2>Application Details:</h2>
        
        <div class="info-row">
            <span class="label">Webinar:</span> 
            <strong>{{ $application->webinar->title ?? 'N/A' }}</strong>
        </div>
        <div class="info-row">
            <span class="label">Full Name:</span> {{ $application->full_name }}
        </div>
        <div class="info-row">
            <span class="label">Email:</span> {{ $application->email }}
        </div>
        <div class="info-row">
            <span class="label">Phone:</span> {{ $application->phone }}
        </div>
        <div class="info-row">
            <span class="label">Registering As:</span> {{ ucfirst($application->registering_as) }}
        </div>
        <div class="info-row">
            <span class="label">Status:</span> <strong>{{ ucfirst($application->status) }}</strong>
        </div>

        <p style="margin-top: 25px;">We will review your application and notify you soon.</p>

        <p style="color: #666; font-size: 0.9em; margin-top: 40px;">
            Best regards,<br>
            <strong>Webinar Team</strong>
        </p>
    </div>
</body>
</html>
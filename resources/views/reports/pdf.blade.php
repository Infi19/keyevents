<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        @page {
            margin: 2cm;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            font-size: 12pt;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
        }
        .header-logo {
            width: 80px;
            height: 80px;
            display: block;
            margin: 0 auto 10px;
        }
        .school-name {
            font-size: 18pt;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }
        .department {
            font-size: 14pt;
            margin: 5px 0;
        }
        .report-title {
            font-size: 16pt;
            text-align: center;
            margin: 20px 0;
            font-weight: bold;
        }
        .content {
            margin-bottom: 30px;
        }
        h1 {
            font-size: 14pt;
            margin-top: 20px;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        h2 {
            font-size: 13pt;
            margin-top: 15px;
            margin-bottom: 10px;
        }
        p {
            margin: 0 0 10px;
        }
        ul, ol {
            margin: 10px 0;
            padding-left: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .photos {
            margin: 20px 0;
            page-break-inside: avoid;
        }
        .photo {
            margin-bottom: 20px;
            text-align: center;
            page-break-inside: avoid;
        }
        .photo img {
            max-width: 90%;
            max-height: 400px;
            margin: 0 auto;
            display: block;
        }
        .photo-caption {
            margin-top: 5px;
            font-style: italic;
            text-align: center;
        }
        .footer {
            margin-top: 30px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
            display: flex;
            justify-content: space-between;
            page-break-inside: avoid;
        }
        .signature {
            text-align: center;
            width: 30%;
        }
        .signature-line {
            margin-top: 50px;
            border-top: 1px solid #000;
            margin-bottom: 5px;
        }
        .date {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="School Logo" class="header-logo" onerror="this.style.display='none'">
        <p class="school-name">SHALAKA FOUNDATION'S</p>
        <p class="school-name">KEYSTONE SCHOOL OF ENGINEERING</p>
        <p class="department">DEPARTMENT OF COMPUTER ENGINEERING</p>
    </div>
    
    <div class="report-title">EVENT REPORT</div>
    
    <div class="content">
        {!! \Parsedown::instance()->text($content) !!}
    </div>
    
    @if(isset($photos) && count($photos) > 0)
        <div class="photos">
            <h1>Photos of Event Conduction</h1>
            @foreach($photos as $photo)
                <div class="photo">
                    <img src="{{ public_path('storage/' . $photo->file_path) }}" alt="{{ $photo->title ?? 'Event photo' }}">
                    @if($photo->title)
                        <p class="photo-caption">{{ $photo->title }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
    
    <div class="date">
        <p>Date: {{ date('d.m.Y') }}</p>
    </div>
    
    <div class="footer">
        <div class="signature">
            <div class="signature-line"></div>
            <p>{{ $coordinator ?? 'Program Coordinator' }}</p>
        </div>
        
        <div class="signature">
            <div class="signature-line"></div>
            <p>{{ $hod ?? 'Head of Department' }}</p>
        </div>
        
        <div class="signature">
            <div class="signature-line"></div>
            <p>{{ $principal ?? 'Principal' }}</p>
        </div>
    </div>
</body>
</html> 
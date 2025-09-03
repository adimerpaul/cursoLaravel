<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>QR</title>
  <style>
    body{font-family: system-ui, Arial; margin:24px;}
    .wrap{display:flex; gap:24px; align-items:center;}
    .card{border:1px solid #e5e7eb; border-radius:12px; padding:16px; width:max-content;}
    .label{font-size:14px; color:#6b7280; margin-top:8px;}
    @media print { .no-print{display:none} }
  </style>
</head>
<body>
  <div class="wrap">
    <div class="card">
      {!! QrCode::size(240)->margin(0)->errorCorrection('H')
          // ->style('round')         // opcional
          // ->eye('circle')          // opcional
          // ->backgroundColor(255,255,255)
          // ->color(45,45,45)
          // ->merge(public_path('logo.png'), .2, true) // logo opcional
          ->generate($payload)
      !!}
      <div class="label">{{ $payload }}</div>
    </div>

    <div>
    </div>
  </div>
</body>
</html>
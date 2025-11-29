<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Property Reports</title>

  <style>
    @page {
      margin: 120px 40px 120px 40px;
    }

    body {
      font-family: 'DejaVu Sans', Arial, sans-serif;
      font-size: 12px;
      margin: 0;
      padding: 0;
      background-color: #fff;
      color: #222;
    }

    /* ===== HEADER ===== */
    header {
      position: fixed;
      top: -100px;
      left: 0;
      right: 0;
      height: 90px;
      text-align: center;
      padding-bottom: 10px;
      border-bottom: 2px solid #0A6FA6;
    }

    header h1 {
      margin: 0;
      font-size: 14px;
      color: #0A6FA6;
      font-weight: 800;
      letter-spacing: 1px;
    }

    header .sub {
      font-size: 12px;
      margin-top: 2px;
      color: #444;
    }

    /* ===== FOOTER ===== */
    footer {
      position: fixed;
      bottom: -95px;
      left: 0;
      right: 0;
      height: 80px;
      text-align: center;
      padding-top: 10px;
      border-top: 2px solid #0A6FA6;
      font-size: 11px;
      color: #555;
    }

    footer .brand {
      font-weight: bold;
      color: #0A6FA6;
      font-size: 12px;
    }

    footer .line {
      width: 50%;
      margin: 6px auto;
      border-top: 1px solid #ccc;
    }

    /* ===== TABLE STYLE ===== */
    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 6px;
      margin-top: 20px;
    }

    th {
      background-color: #0A6FA6;
      color: #fff;
      padding: 10px;
      font-size: 12px;
      text-transform: uppercase;
    }

    td {
      background: #f8f9fb;
      padding: 8px;
      border-top: 1px solid #e2e2e2;
      border-bottom: 1px solid #e2e2e2;
      vertical-align: middle;
    }

    /* ONLY VALUE COLUMN */
    td.value-cell,
    th.value-cell {
      font-size: 11px;
      white-space: nowrap;
      max-width: 140px;
      text-align: right;
      word-break: break-word;
    }

    tr.total-row td {
      background: #e6f3ff;
      font-weight: bold;
      border-top: 2px solid #0A6FA6;
      border-bottom: 2px solid #0A6FA6;
    }

    .text-center {
      text-align: center;
    }
  </style>
</head>

<body>

  @php
    function formatMoneyShort($number) {
      if ($number >= 1_000_000_000_000) {
        return number_format($number / 1_000_000_000_000, 2) . 'T';
      } elseif ($number >= 1_000_000_000) {
        return number_format($number / 1_000_000_000, 2) . 'B';
      } elseif ($number >= 1_000_000) {
        return number_format($number / 1_000_000, 2) . 'M';
      } elseif ($number >= 1_000) {
        return number_format($number / 1_000, 2) . 'K';
      } else {
        return number_format($number, 2);
      }
    }
  @endphp

  <!-- HEADER -->
  <header>
    <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
      <img src="{{ public_path('assets/img/favicon/logo.png') }}" alt="Logo" style="height: 55px;" />
      <div>
        <h1>MAOMIS SYSTEM REPORTS</h1>
        <div class="sub">Generated on {{ now()->setTimezone('Asia/Manila')->format('M. d, Y') }}</div>
      </div>
    </div>
  </header>

  <!-- MAIN CONTENT -->
  <main>
    <table>
      <thead>
        <tr>
          <th>Date</th>
          <th>Owner</th>
          <th>Lot Number</th>
          <th>Property Classification</th>
          <th class="value-cell">Value</th>
        </tr>
      </thead>

      <tbody>
        @foreach($Reports as $item)
        <tr>
          <td>{{ $item->created_at->format('F j, Y') }}</td>
          <td>{{ $item->owner }}</td>
          <td>{{ $item->lot_number }}</td>
          <td>{{ $item->classification }}</td>
          <td class="value-cell">₱ {{ formatMoneyShort($item->value) }}</td>
        </tr>
        @endforeach

        <tr class="total-row">
          <td colspan="4" class="text-center">TOTAL VALUE</td>
          <td class="value-cell">₱ {{ formatMoneyShort($TotalValue) }}</td>
        </tr>
      </tbody>
    </table>
  </main>

  <!-- FOOTER -->
  <footer>
    <div class="brand">MAOMIS SYSTEM</div>
    <div>Generated automatically — {{ now()->setTimezone('Asia/Manila')->format('M. d, Y h:i A') }}</div>
  </footer>
</body>
</html>

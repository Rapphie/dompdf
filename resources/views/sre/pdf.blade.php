<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Statement of Receipts and Expenditures</title>
    <style>
        @page {
            margin: 30px 25px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #000;
            font-size: 8px;
            line-height: 1.2;
            margin: 0;
            padding: 0;
        }

        /* ---- Header ---- */
        .header-block {
            margin-bottom: 5px;
        }

        .header-block p {
            margin: 0;
            font-size: 8px;
            font-weight: bold;
        }

        .report-title {
            text-align: center;
            font-size: 10px;
            font-weight: bold;
            margin: 10px 0 10px 0;
        }

        /* ---- Meta (LGU / Period) ---- */
        .meta-table {
            margin-bottom: 6px;
        }

        .meta-table td {
            border: none;
            padding: 1px 4px;
            font-size: 8px;
        }

        /* ---- Data table ---- */
        .sre-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 7px;
        }

        .sre-table th,
        .sre-table td {
            border: 1px solid #000;
            padding: 2px 4px;
            vertical-align: middle;
            word-wrap: break-word;
        }

        .sre-table th {
            text-align: center;
            font-weight: bold;
        }

        .col-particulars {
            width: 30%;
            text-align: left;
        }

        .col-amount {
            width: 14%;
            text-align: right;
        }

        .col-percent {
            width: 14%;
            text-align: right;
        }

        /* Sub-items get an indent */
        .indent td:first-child {
            padding-left: 18px;
        }

        /* ---- Signature section ---- */
        .sig-section {
            margin-top: 20px;
        }

        .sig-table {
            width: 100%;
            border-collapse: collapse;
        }

        .sig-table td {
            border: none;
            vertical-align: top;
            width: 50%;
            padding: 4px 30px;
            text-align: center;
        }

        .sig-label {
            font-size: 8px;
            text-align: left;
            margin-bottom: 15px;
        }

        .sig-name {
            font-weight: bold;
            font-size: 9px;
            margin-bottom: 1px;
        }

        .sig-title {
            font-weight: bold;
            font-size: 8px;
            margin-bottom: 0;
        }

        .sig-line {
            border-top: 1px solid #000;
            margin-top: 2px;
            padding-top: 3px;
            font-size: 8px;
        }

        .sig-gap {
            height: 15px;
        }
    </style>
</head>

<body>

    {{-- ===== HEADER ===== --}}
    <div class="header-block">
        <p>BUREAU OF LOCAL GOVERNMENT FINANCE</p>
        <p>DEPARTMENT OF FINANCE</p>
        <p>http://blgf.gov.ph/</p>
    </div>

    <div class="report-title">STATEMENT OF RECEIPTS AND EXPENDITURES</div>

    {{-- ===== META ===== --}}
    <table class="meta-table">
        <tr>
            <td>LGU:</td>
            <td><strong>{{ $lgu ?? 'Manila City' }}</strong></td>
        </tr>
        <tr>
            <td>Period Covered:</td>
            <td><strong>{{ $period ?? 'Q1, 2025' }}</strong></td>
        </tr>
    </table>

    {{-- ===== DATA TABLE ===== --}}
    @php
        $categoryRows = ['LOCAL SOURCES', 'TAX REVENUE', 'NON-TAX REVENUE', 'EXTERNAL SOURCES'];
        $totalRows = [
            'TOTAL CURRENT OPERATING INCOME',
            'ADD: SUPPLEMENTAL BUDGET (UNAPPROPRIATED SURPLUS) FOR CURRENT OPERATING EXPENDITURES',
            'TOTAL AVAILABLE FOR CURRENT OPERATING EXPENDITURES',
            'LESS: CURRENT OPERATING EXPENDITURES (PS + MOOE + FE)',
        ];
    @endphp

    <table class="sre-table">
        <thead>
            <tr>
                <th class="col-particulars">Particulars</th>
                <th class="col-amount">Income/Target Budget<br>Appropriation</th>
                <th class="col-amount">General Fund</th>
                <th class="col-amount">SEF</th>
                <th class="col-amount">Total</th>
                <th class="col-percent">% of General + SEF to<br>Total Income(GF+SEF)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                @php
                    $p = $row['particulars'];
                    $isCategory = in_array($p, $categoryRows);
                    $isTotal = in_array($p, $totalRows);
                    $isSub = !$isCategory && !$isTotal;
                @endphp
                <tr @if ($isSub) class="indent" @endif>
                    <td style="{{ $isCategory || $isTotal ? 'font-weight:bold;' : '' }}">{{ $p }}</td>
                    <td class="col-amount" style="{{ $isCategory || $isTotal ? 'font-weight:bold;' : '' }}">
                        {{ $row['income_target_budget_appropriation'] ?? '' }}</td>
                    <td class="col-amount" style="{{ $isCategory || $isTotal ? 'font-weight:bold;' : '' }}">
                        {{ $row['general_fund'] ?? '' }}</td>
                    <td class="col-amount" style="{{ $isCategory || $isTotal ? 'font-weight:bold;' : '' }}">
                        {{ $row['sef'] ?? '' }}</td>
                    <td class="col-amount" style="{{ $isCategory || $isTotal ? 'font-weight:bold;' : '' }}">
                        {{ $row['total'] ?? '' }}</td>
                    <td class="col-percent" style="{{ $isCategory || $isTotal ? 'font-weight:bold;' : '' }}">
                        {{ $row['percent_to_total_income'] ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- ===== SIGNATURES ===== --}}
    <div class="sig-section">
        <table class="sig-table">
            {{-- Row 1: Prepared by / Certified by --}}
            <tr>
                <td>
                    <div class="sig-label">Prepared by:</div>
                    <p class="sig-name">{{ $signatures['prepared_by']['name'] }}</p>
                    <p class="sig-title">( {{ $signatures['prepared_by']['title'] }} )</p>
                    <div class="sig-line">{{ $signatures['prepared_by']['office'] }}</div>
                </td>
                <td>
                    <div class="sig-label" style="text-align: right;">Certified by:</div>
                    <p class="sig-name">{{ $signatures['certified_by']['name'] }}</p>
                    <p class="sig-title">( {{ $signatures['certified_by']['title'] }} )</p>
                    <div class="sig-line">{{ $signatures['certified_by']['office'] }}</div>
                </td>
            </tr>
            {{-- Row 2: Budget officers --}}
            <tr>
                <td>
                    <div class="sig-gap"></div>
                    <p class="sig-name">{{ $signatures['budget_officer']['name'] }}</p>
                    <p class="sig-title">( {{ $signatures['budget_officer']['title'] }} )</p>
                    <div class="sig-line">{{ $signatures['budget_officer']['office'] }}</div>
                </td>
                <td>
                    <div class="sig-gap"></div>
                    <p class="sig-name">{{ $signatures['budget_certifier']['name'] }}</p>
                    <p class="sig-title">&nbsp;</p>
                    <div class="sig-line">{{ $signatures['budget_certifier']['office'] }}</div>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AMD Q1 Financial Report</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        >
    </head>
    <body class="bg-body-tertiary">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-header py-3">
                            <h1 class="h4 mb-1">AMD Q1 Report Downloader</h1>
                            <p class="text-body-secondary mb-0">
                                Source file: <code>public/{{ $reportSourcePath }}</code>
                            </p>
                        </div>
                        <div class="card-body">
                            @if ($sourceError !== null)
                                <div class="alert alert-danger mb-0" role="alert">
                                    {{ $sourceError }}
                                </div>
                            @elseif ($reportMeta !== null)
                                <dl class="row mb-4">
                                    <dt class="col-sm-4">Company</dt>
                                    <dd class="col-sm-8">{{ $reportMeta['name'] }} ({{ $reportMeta['symbol'] }})</dd>

                                    <dt class="col-sm-4">Fiscal Period</dt>
                                    <dd class="col-sm-8">{{ $reportMeta['quarter'] }} {{ $reportMeta['year'] }}</dd>

                                    <dt class="col-sm-4">Start Date</dt>
                                    <dd class="col-sm-8">{{ $reportMeta['start_date'] }}</dd>

                                    <dt class="col-sm-4">End Date</dt>
                                    <dd class="col-sm-8">{{ $reportMeta['end_date'] }}</dd>
                                </dl>

                                <a href="{{ route('reports.download') }}" class="btn btn-primary">
                                    Download PDF
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

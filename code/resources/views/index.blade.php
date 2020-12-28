<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Clicks count</title>

        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8"
                src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

    </head>
    <body>
    <div class="">
        <div>
            <h3>Clicks</h3>
            <table id="clicks">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>User-agent</th>
                    <th>IP</th>
                    <th>Referer</th>
                    <th>Param 1</th>
                    <th>Param 2</th>
                    <th>Error</th>
                    <th>Bad domain</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

        <hr>
        <h3>Bad domains</h3>
        <div>
            <div>
                <label>Add bad domain</label>
                <input type="text" maxlength="255" id="new-domain" />
                <button id="add-new-domain">add</button>
            </div>
            <table id="badDomains">
                <thead>
                <tr>
                    <th>Bad domains</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            let tableBadDomains = $('#badDomains').DataTable({
                ajax: {
                    url: '/bad-domains',
                    dataSrc: ''
                },
                columns: [
                    { "data": "name"}
                ]
            });
            let tableClicks = $('#clicks').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/clicks',
                    dataSrc: 'data'
                },
                columns: [
                    { "data": "id"},
                    { "data": "ua"},
                    { "data": "ip"},
                    { "data": "ref"},
                    { "data": "param1"},
                    { "data": "param2"},
                    { "data": "error"},
                    { "data": "bad_domain"}
                ]
            });


            $('#add-new-domain').click(function() {
                let newDomain = $('#new-domain').val();
                if (newDomain) {
                    $.post( "/bad-domains", {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        domain: newDomain
                    })
                        .done(function (data) {
                            tableBadDomains.ajax.reload();
                        });
                }
            });

        });
    </script>
    </body>
</html>

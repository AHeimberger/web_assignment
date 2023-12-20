<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="generator" content="Hugo 0.84.0">
        <title>Simple Web Assignment</title>
        <link href="./css/bootstrap.min.css" rel="stylesheet">
        <link href="./css/bootstrap-icons.css" rel="stylesheet">
        <script type="text/javascript" src="js/ext/jquery.min.js"></script>
        <script type="text/javascript" src="js/ext/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/app.js"></script>
        </head>
    <body>

        <main role="main" class="container">

            <h1 class="mt-5">Routing Table</h1>

            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Gateway</th>
                    <th scope="col">Flags</th>
                    <th scope="col">Netif</th>
                    <th scope="col">Expire</th>
                    <th scope="col" colspan="2">Actions
                    </th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <div id="loading" style="display: none;">
                <div class="spinner-border spinner-border-sm" role="status">&nbsp;</div>
                <span class="sr-only">Loading...</span>
            </div>

            <p><button name="reset" class="btn btn-secondary">Reset Settings</button></p>
        </main>
    </body>
</html>
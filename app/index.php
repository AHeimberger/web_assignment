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
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
    </head>
<body>


<table class="table table-bordered">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Desination</th>
        <th scope="col">Gateway</th>
        <th scope="col">Flags</th>
        <th scope="col">Netif</th>
        <th scope="col">Expire</th>
        </tr>
    </thead>
    <tbody>
    <?php
        function call_service() {
            $output = shell_exec("./service");
            $index = 0;

            foreach(preg_split("/((\r?\n)|(\r\n?))/", $output) as $line){
                list($destination, $gateway, $flags, $netif, $expire) = explode (" ", $line);

                if ($index == 0) {
                    $index++;
                    continue;
                }

                echo "
                <tr>
                    <td scope=\"row\">1</td>
                    <td>" . $destination . "</td>
                    <td>" . $gateway . "</td>
                    <td>" . $flags . "</td>
                    <td>" . $netif . "</td>
                    <td>" . $expire . "</td>
                </tr>
                ";

                $index++;
            } 
        }

        call_service();
    ?>
    </tbody>
    </table>

    <script src="./js/bootstrap.min.js"></script>
</body>
<script>document.getElementById("cmd").focus();</script>
</html>
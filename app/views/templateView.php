<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>Test Page</title>        
    </head>
    <body>
        <?php include Solveo\Config::get()->dirs->views . $contentView; ?>
        <script>

            function equalArrays(a, b) {
                if (a.length != b.length)
                    return "false";
                for (var i = 0; i < a.length; i++)
                    if (a[i] !== b[i])
                        return "false";

                return "true";
            }
            console.log(equalArrays([2,3,5],[2,3,5]))


        </script>
    </body>
</html>
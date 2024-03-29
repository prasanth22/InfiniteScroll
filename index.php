<html>

<head>
    <title>Scroll Project</title>
    <style>
        .box {
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div id="content"></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
        var oset = 0;
        var iload = 1;
        var holdload = false;
        //console.dir(window);
        //console.dir(document);
        $(function () {
            loadArt(7);
        });
        $(window).scroll(function () {
            if ($(window).scrollTop() >= $(document).height() - $(window).height() - 100) {
                loadArt(1);
            }
        })

        function loadArt(a) {
            if (!holdload) {
                var holder = {
                    iload: a
                    , oset: oset
                };
                console.log(holder);
                holdload = true;
                $.ajax({
                    url: "api.php"
                    , type: "POST"
                    , data: holder
                    , dataType: "json"
                    , success: function (data) {
                        console.log(data);
                        for (var i = 0; i < data.content.length; i++) {
                            oset++;
                            var item = data.content[i];
                            var html = '<div class="box">' + item.id + ' ' + item.content + ' ' + item.date + ' </div>';
                            $('#content').append(html);
                        }
                        holdload = false;
                        if (data.content.length == 0) {
                            holdload = true;
                        }
                    }
                })
            }
        }
    </script>
</body>

</html>

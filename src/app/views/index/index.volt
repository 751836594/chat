<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>聊天室</title>
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
<div id="sse">
    <a href="javascript:WebSocketTest()">运行 WebSocket</a>
</div>
</body>
<script type="text/javascript">
    function WebSocketTest()
    {
        if ("WebSocket" in window)
        {
            alert("您的浏览器支持 WebSocket!");


            var ws = new WebSocket("ws://0.0.0.0:9501");

            ws.onopen = function()
            {

                ws.send("发送数据");
                alert("数据发送中...");
            };

            ws.onmessage = function (evt)
            {
                var received_msg = evt.data;
                console.log(received_msg);
            };

            ws.onclose = function()
            {

                alert("连接已关闭...");
            };
        }

        else
        {

            alert("您的浏览器不支持 WebSocket!");
        }
    }
</script>
</html>
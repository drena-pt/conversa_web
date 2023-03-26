<?php require('head.php');?>
    <style>
    .msg_container_base{
        max-height:80vh;
        height:80vh;
        overflow-x:hidden;
    }
    </style>
</head>
<body>

<div class="col-xl-6 offset-xl-3 bg-dark"><div class="p-4 bg-conversa bg-opacity-10 vh-100">


    <div class="panel panel-primary" style="border:0px">

        <div class="panel-heading top-bar">
            <div class="col-md-8 col-xs-8">
                <h3 class="panel-title"><span class="glyphicon glyphicon-comment" style="margin-right:6px;"></span>College Enquiry Chat</h3>
            </div>
        </div>

        <div class="msg_container_base">

            <div class="row msg_container base_sent">
                <div class="col-md-10 col-xs-10">
                    <div class="messages msg_sent">
                        <p>that mongodb thing looks good, huh?
                        tiny master db, and huge document store</p>
                    </div>
                </div>
            </div>

            <div class="row msg_container base_receive">
                <div class="col-md-10 col-xs-10">
                    <div class="messages msg_receive">
                        <p>that mongodb thing looks good, huh?
                        tiny master db, and huge document store</p>
                    </div>
                </div>
            </div>

            <chat_log> . </chat_log>

        </div>

        <!--CHAT USER BOX-->
        <div class="panel-footer">
            <div class="input-group" id="myForm">
                <input id="btn-input" type="text" class="form-control input-sm chat_input" placeholder="Write your message here...">
                <span class="input-group-btn">
                <button class="btn btn-primary btn-sm" id="submit" type="submit">Send</button>
                </span>
            </form>
            </div>
        </div>

    </div>

        
</div>


<script>
        
$("#submit").click(function() {
    $(".msg_container_base").stop().animate({ scrollTop: $(".msg_container_base")[0].scrollHeight}, 0);
});
    </script>
</body>
</html>
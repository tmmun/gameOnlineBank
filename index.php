<!DOCTYPE html>
<html ng-app='test'>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald&family=Yanone+Kaffeesatz&display=swap');
    </style>
    <title>Chat</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>
</body>

<div id="fon">

    <div id="logCont" class="logCont">
        <input id="inp" type="text" class="key" placeholder="key">
        <input id="inp" type="text" class="name" placeholder="name">
        <img id="log" src="ico/key.svg" alt="">

    </div>

    <div id="cardFon">
        <div id="card">
            <div id="prof" class="myNam">name</div>
            <div id="big_text" class="myBank">0000</div>
            <div id="line"></div>
        </div>
        <div id="card">
            <div id="prof" class="hisNam">name</div>
            <div id="big_text" class="hisBank">****</div>
            <div id="tranCont">
                <input id="inp" class="namBank" type="text" placeholder="имя">
                <input id="inp" class="sum" type="number" placeholder="сумм">
                <img id="update" src="ico/tran.svg" alt="">
            </div>
        </div>
    </div>
    <div id="infoCont">
        <pre id="hisCont"></pre>
        <pre id="usersCont"></pre>
    </div>
    <div id="reload">reload</div>
</div>

</body>
<script src="/script.js"></script>

</html>
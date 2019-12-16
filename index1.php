<?php
        header("Location: ./FileMgt/");
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Text editor</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <script
  src="https://code.jquery.com/jquery-3.4.0.min.js"
  integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
  crossorigin="anonymous"></script>
    <script>  var colorPalette = ['000000', 'FF9966', '6699FF', '99FF66', 'CC0000', '00CC00', '0000CC', '333333', '0066FF', 'FFFFFF'];
        var forePalette = $('.fore-palette');
        var backPalette = $('.back-palette');

        for (var i = 0; i < colorPalette.length; i++) {
            forePalette.append('<a href="#" data-command="forecolor" data-value="' + '#' + colorPalette[i] + '" style="background-color:' + '#' + colorPalette[i] + ';" class="palette-item"></a>');
            backPalette.append('<a href="#" data-command="backcolor" data-value="' + '#' + colorPalette[i] + '" style="background-color:' + '#' + colorPalette[i] + ';" class="palette-item"></a>');
        }

        $('.toolbar a').click(function (e) {
            var command = $(this).data('command');
            if (command == 'h1' || command == 'h2' || command == 'p') {
                document.execCommand('formatBlock', false, command);
            }
            if (command == 'forecolor' || command == 'backcolor') {
                document.execCommand($(this).data('command'), false, $(this).data('value'));
            }
            if (command == 'createlink' || command == 'insertimage') {
                url = prompt('Enter the link here: ', 'http:\/\/');
                document.execCommand($(this).data('command'), false, url);
            } else document.execCommand($(this).data('command'), false, null);
        });</script>

    <style>
        body {
            margin: 0 auto;
            width: 100%;
            font-family: 'Dosis';
        }

        a {
            cursor: pointer;
        }

        #editor {
            box-shadow: 0 0 2px #CCC;
            min-height: 150px;
            overflow: auto;
            padding: 1em;
            margin-top: 20px;
            resize: vertical;
            outline: none;
            margin-left: 15px;
            margin-right: 15px;
        }

        .toolbar {
            text-align: center;
        }

        .toolbar a,
        .fore-wrapper,
        .back-wrapper {
            border: 1px solid #AAA;
            background: #FFF;
            font-family: 'Candal';
            border-radius: 1px;
            color: black;
            padding: 5px;
            width: 1.5em;
            margin: -2px;
            margin-top: 10px;
            display: inline-block;
            text-decoration: none;
            box-shadow: 0px 1px 0px #CCC;
        }

        .toolbar a:hover,
        .fore-wrapper:hover,
        .back-wrapper:hover {
            background: #f2f2f2;
            border-color: #8c8c8c;
        }

        a[data-command='redo'],
        a[data-command='strikeThrough'],
        a[data-command='justifyFull'],
        a[data-command='insertOrderedList'],
        a[data-command='outdent'],
        a[data-command='p'],
        a[data-command='superscript'] {
            margin-right: 5px;
            border-radius: 0 3px 3px 0;
        }

        a[data-command='undo'],
        .fore-wrapper,
        a[data-command='justifyLeft'],
        a[data-command='insertUnorderedList'],
        a[data-command='indent'],
        a[data-command='h1'],
        a[data-command='subscript'] {
            border-radius: 3px 0 0 3px;
        }

        a.palette-item {
            height: 1em;
            border-radius: 3px;
            margin: 2px;
            width: 1em;
            border: 1px solid #CCC;
        }

        a.palette-item:hover {
            border: 1px solid #CCC;
            box-shadow: 0 0 3px #333;
        }

        .fore-palette,
        .back-palette {
            display: none;
        }

        .fore-wrapper,
        .back-wrapper {
            display: inline-block;
            cursor: pointer;
        }

        .fore-wrapper:hover .fore-palette,
        .back-wrapper:hover .back-palette {
            display: block;
            float: left;
            position: absolute;
            padding: 3px;
            width: 160px;
            background: #FFF;
            border: 1px solid #DDD;
            box-shadow: 0 0 5px #CCC;
            height: 70px;
        }

        .fore-palette a,
        .back-palette a {
            background: #FFF;
            margin-bottom: 2px;
        }
    </style>
    <script>
        function functionCall() {
            $("#loader").css("display","block");
                $("#ok").css("display","none");
            $.ajax({
                type:'POST',
                url:'./db.php',
                dataType:'json/text',
                data:{html:$("#editor").html()},
                success:function(res){
                    $("#loader").css("display","none");
                $("#ok").css("display","block");
                },
                error:function(err){
                    $("#loader").css("display","none");
                $("#ok").css("display","block");
                }
            })
        }

    </script>

</head>

<body>
<a href="http://notepade.move.pk/FileMgt">Files</a>
    <div class="toolbar">
        <a href="#" data-command='undo'><i class='fa fa-undo'></i></a>
        <a href="#" data-command='redo'><i class='fa fa-repeat'></i></a>
        <div class="fore-wrapper"><i class='fa fa-font' style='color:#C96;'></i>
            <div class="fore-palette">
            </div>
        </div>
        <div class="back-wrapper"><i class='fa fa-font' style='background:#C96;'></i>
            <div class="back-palette">
            </div>
        </div>
        <a href="#" data-command='bold'><i class='fa fa-bold'></i></a>
        <a href="#" data-command='italic'><i class='fa fa-italic'></i></a>
        <a href="#" data-command='underline'><i class='fa fa-underline'></i></a>
        <a href="#" data-command='strikeThrough'><i class='fa fa-strikethrough'></i></a>
        <a href="#" data-command='justifyLeft'><i class='fa fa-align-left'></i></a>
        <a href="#" data-command='justifyCenter'><i class='fa fa-align-center'></i></a>
        <a href="#" data-command='justifyRight'><i class='fa fa-align-right'></i></a>
        <a href="#" data-command='justifyFull'><i class='fa fa-align-justify'></i></a>
        <a href="#" data-command='indent'><i class='fa fa-indent'></i></a>
        <a href="#" data-command='outdent'><i class='fa fa-outdent'></i></a>
        <a href="#" data-command='insertUnorderedList'><i class='fa fa-list-ul'></i></a>
        <a href="#" data-command='insertOrderedList'><i class='fa fa-list-ol'></i></a>
        <a href="#" data-command='h1'>H1</a>
        <a href="#" data-command='h2'>H2</a>
        <a href="#" data-command='createlink'><i class='fa fa-link'></i></a>
        <a href="#" data-command='unlink'><i class='fa fa-unlink'></i></a>
        <a href="#" data-command='insertimage'><i class='fa fa-image'></i></a>
        <a href="#" data-command='p'>P</a>
        <a href="#" data-command='subscript'><i class='fa fa-subscript'></i></a>
        <a href="#" data-command='superscript'><i class='fa fa-superscript'></i></a>
    </div>
    <div id='editor' contenteditable onchange="myFunction()">

    </div>
    <style>
    #loader{
        height: 64px;
    width: 64px;
    position: absolute;
    top: -4px;
    left: 45px;
    display: none;
    }
    #ok{
        height: 45px;
    width: 45px;
    position: absolute;
    top: 4px;
    left: 45px;
    display: none;
    }
    </style>
    <img src="./loader.gif"  id="loader"/>
    <img src="./ok.gif"   id="ok"/>
    <script>
        $(document).ready(()=>{
            $("#loader").css("display","block");
            $("#ok").css("display","none");
            $.ajax({
                type:'POST',
                url:'./get.php',
                dataType:'json/text',
                data:{html:$("#editor").html()},
                success:function(res){
debugger
                $("#loader").css("display","none");
                $("#ok").css("display","block");
                },
                error:function(err){
                    $("#editor").html(err.responseText);
                    $("#loader").css("display","none");
            $("#ok").css("display","block");
                }
            })
        })
        document.getElementById("editor").addEventListener("input", function () {
            functionCall();
        }, false);
    </script>
</body>

</html>
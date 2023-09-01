<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        .content {
            max-width: 500px;
            margin: auto;
            background: #000;
            padding: 10px;
        }

        .at-copy-link-share-page-url {
            border-radius: 0 4px 4px 0;
            color: #333;
            display: block;
            font-family:'EB Garamond', serif;
            font-size: 18px;
            height: 50px;
            width: calc(100% - 0px);
        }

        .at-copy-link-share-button {
            text-align: center;
            width: 130px;
        }

        .at-expanded-menu-primary-action-btn {
            background-color: #ea4a7f;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
            display: block;
            font-family:'EB Garamond', serif;
            font-size: 16px;
            margin: 15px auto 0;
            padding: 15px 35px;
            transition: background-color .2s ease-in;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
</head>
<body>
    <?php
        if( isset($_GET['link']) )
        {
             $link = $_GET['link'];
        }
    ?>
    <div class="content">
        <div class="at-copy-link-share-page-url-container"><input id="at-copy-link-share-page-url" class="at-copy-link-share-page-url" type="text" value="<?php echo $link;?>" readonly></div>
        <div><div class="at-copy-link-share-button at-expanded-menu-primary-action-btn" id="copied" data-clipboard-action="copy" data-clipboard-target="#at-copy-link-share-page-url">COPY</div></div>
    </div>
    <script>    
        var clipboard = new ClipboardJS("#copied");

        clipboard.on('success', function(e) {
            e.clearSelection();
            e.trigger.textContent = 'COPIED';
            window.setTimeout(function() {
                e.trigger.textContent = 'COPY';
            }, 2000);
        });

        clipboard.on('error', function(e) {
            e.trigger.textContent = 'CTRL + C';
            window.setTimeout(function() {
                e.trigger.textContent = 'COPY';
            }, 2000);
        });
    </script>
</body>
</html>
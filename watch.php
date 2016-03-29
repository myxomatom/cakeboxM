<?php

require('inc/lang.inc.php');
require('inc/functions.inc.php');

// File infos
$filePath = $_GET['file'];
$pathInfo =  pathinfo($filePath);

// User OS
$detect_OS = detect_OS();

// Get the next and the previous video file if current file is a video too
if (isVideoFile($filePath)):
  $listof_dir = array(); // Global used by get_nextnprev
  $nextnprev = get_nextnprev($filePath);
  $prev = $nextnprev['prev'];
  $next = $nextnprev['next'];
else:
  $prev = NULL;
  $next = NULL;
endif;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="robots" content="noindex" />
    <title>CakeBox - <?php echo $lang[LOCAL_LANG]['watch_title']; ?></title>
    <meta charset="utf-8">
    <link rel="icon" type="image/ico" href="favicon.ico" />

    <!-- Style & ergo -->
    <link href='http://fonts.googleapis.com/css?family=Changa+One|Droid+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="ressources/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="ressources/reset.css" type="text/css" media="screen">
    <script lang="javascript">
        var lang_ok_unmark = '<?php echo $lang[LOCAL_LANG]['ok_unmark']; ?>';
        var lang_ok_mark = '<?php echo $lang[LOCAL_LANG]['ok_mark']; ?>';
    </script>
    <script src="ressources/oXHR.js"></script>
    <!-- / Style & ergo -->

    <?php if ($detect_OS == "Linux-Windows-others" && isVideoFile($filePath)): ?>

    <!-- VLC Controls -->
    <link rel="stylesheet" type="text/css" href="ressources/vlc-styles.css" />
    <script language="javascript" src="ressources/jquery.min.js"></script>
    <script language="javascript" src="ressources/jquery-vlc.js"></script>
    <script language="javascript">
        function play(instance, uri) {
            VLCobject.getInstance(instance).play(uri);
        }
        var player = null;
        $(document).ready(function() {
            player = VLCobject.embedPlayer('vlc1', 600, 400, true);
        });
    </script>
    <!-- / VLC Controls -->

    <?php endif; ?>
</head>

<body <?php if ($detect_OS == "Linux-Windows-others" && isVideoFile($filePath)): ?> onload="play('vlc1', '<?php echo DOWNLOAD_LINK.addslashes($filePath); ?>')" <?php endif; ?>>
    <header>
        <div id="logo">
            <a href="index.php">
                <span class="first">Cake</span>
                <span class="second">Box</span>
            </a>
        </div>
    </header>

    <section id="content">
        <h2><?php echo $pathInfo['filename'] ?></h2>

        <?php
        if (isVideoFile($filePath)):
            if (SEEN_MODE_ENABLE):
        ?>

        <div id="popcorn" class="littleh2">
            <?php
                // If file is not marked as "already seen"
                if (!file_exists("data/".$pathInfo['basename'])):
            ?>
            <?php echo $lang[LOCAL_LANG]['have_you_finished']; ?>
            <span class="mark" onclick="markfile('<?php echo addslashes($pathInfo['basename']); ?>');"><?php echo $lang[LOCAL_LANG]['click_remind']; ?></span>
                <a href="#" class="tooltip" style="text-decoration: underline;">
                    <?php echo $lang[LOCAL_LANG]['what_zat']; ?>
                    <span><?php echo $lang[LOCAL_LANG]['popcorn_details']; ?></span>
                </a>

            <?php else: ?>

                Hey, <span class="unmark"><?php echo $lang[LOCAL_LANG]['do_you_remember']; ?></span>
                <span class="update_info" style="text-decoration: underline;cursor:pointer;" onclick="unmarkfile('<?php echo addslashes($pathInfo['basename']); ?>')"><?php echo $lang[LOCAL_LANG]['cancel_please']; ?></span>

            <?php endif; ?>
        </div>
        <?php endif; //!SEEN_MODE_ENABLE ?>

        <hr class="clear" />

        <p style="text-align:center;margin-bottom:10px;">
            <a href="http://dist.divx.com/divx/DivXInstaller.exe" target="_blank" class="help"><?php echo $lang[LOCAL_LANG]['help_watching']; ?></a>
			<a href="http://www.ac3filter.net/downloads/releases/ac3filter/ac3filter_2_6_0b.exe" target="_blank" class="help"><?php echo $lang[LOCAL_LANG]['help_watching1']; ?></a>
        </p>

        <center>
        <?php if ($detect_OS == "OSX" || USE_DIVX): ?>

            <!-- Embed DivX Player (for OS X) -->
            <object classid="clsid:67DABFBF-D0AB-41fa-9C46-CC0F21721616" width="<?php echo DIVX_WIDTH ?>" height="<?php echo DIVX_HEIGTH ?>" codebase="http://go.divx.com/plugin/DivXBrowserPlugin.cab">
                <param name="custommode" value="none" />
                <param name="autoPlay" value="<?php echo DIVX_AUTOPLAY ?>" />
                <param name="src" value="<?php echo DOWNLOAD_LINK.$filePath; ?>" />
                <embed type="video/divx" src="<?php echo DOWNLOAD_LINK.$filePath; ?>" custommode="none" width="<?php echo DIVX_WIDTH ?>" height="<?php echo DIVX_HEIGTH ?>" autoPlay="<?php echo DIVX_AUTOPLAY ?>" pluginspage="http://go.divx.com/plugin/download/"></embed>
            </object>
            <!-- / DivX -->

        <?php else: ?>

            <!-- Embed VLC (for Windows & Linux) -->
            <div id="vlc1" style="margin-bottom:50px;">player 1</div>
            <!-- / VLC -->

        <?php endif; ?>

        <?php
        // Show the "previous" and "next" link under the player
        if ($prev != NULL)
        {
            echo '<div style="margin:40px 0px 10px 0px;">';
            echo '<a href="watch.php?file='.$prev.'" class="next_episode">';
            echo "← ".$lang[LOCAL_LANG]['watch_previous'];
            echo '</a></div>';
        }
        if ($next != NULL)
        {
            echo '<div style="margin:10px 0px 40px 0px;padding-left:30px;">';
            echo '<a href="watch.php?file='.$next.'" class="next_episode">';
            echo $lang[LOCAL_LANG]['watch_next']." →";
            echo '</a></div>';
        }
        ?>
        </center>
        <?php endif; //!Is video file ?>

        <div class="download_button">
            <a href="<?php echo DOWNLOAD_LINK.$filePath; ?>" download="<?php echo $pathInfo['basename']; ?>">
              <img src="ressources/<?php echo $lang[LOCAL_LANG]['file_img_download']; ?>" />
            </a><br/>
            <?php echo $lang[LOCAL_LANG]['right_click']; ?><br/>
            <strong><?php echo $lang[LOCAL_LANG]['size']; ?></strong> <?php echo getFileSize($filePath); ?>
        </div>
        <br />
        <br />
    </section>

    <footer>
        <div class="padding"></div>
    </footer>
</body>
</html>

<?php
echo chdir("/var/web/vhost/tongjo/");
echo "<br>";
echo system("git pull origin master");

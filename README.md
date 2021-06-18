How To Install:
1.  download / clone this repository.
2.  import the .sql into your database.
3.  change data on _config.php
4.  point your mass-sender script into add.php location to make sure the script works deleting your unused wallet id
5.  setup your telegram private channel & bots to have a private notification if there are something wrong. (optional, if you didn't want to use this feature, simple add // (double slash) on every $sendToLogs line on remover.php

create a cron jobs to the remover.php every 24 hours. u can setup this using your server / cpanel cronjobs. or use https://cron-job.org for easy and free cron services.
--------------------------------
any suggestion please get in touch with me on telegram @pramonoutomo


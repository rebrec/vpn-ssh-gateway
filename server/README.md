Server Part
--
Required components : 
openssh-server
putty-tools

Web components :
 apt-get install nginx php5-fpm php5-mongo



Configuration of nginx
--
Edit /etc/nginx/site-available/default
add this :
        location ~ \.php$ {
                try_files $uri =404;
                fastcgi_split_path_info ^(.+\.php)(/.+)$;
                # NOTE: You should have "cgi.fix_pathinfo = 0;" in php.ini

                # With php5-cgi alone:
                #fastcgi_pass 127.0.0.1:9000;
                # With php5-fpm:
                fastcgi_pass unix:/var/run/php5-fpm.sock;
                fastcgi_index index.php;
                include fastcgi_params;
        }

##################
New configuration if using Silex MicroFramework
         location = / {
 32                 try_files @site @site;
 33         }
 34
 35         location / {
 36                 #if (!-e $request_filename){ rewrite ^(.*)$ /silexsite/public/index.php break; }
 37                 # First attempt to serve request as file, then
 38                 # as directory, then fall back to displaying a 404.
 39                 try_files $uri $uri/ @site;
 40                 # Uncomment to enable naxsi on this location
 41                 # include /etc/nginx/naxsi.rules
 42         }
 43
 44         location @site {
 45                 fastcgi_pass unix:/var/run/php5-fpm.sock;
 46                 include fastcgi_params;
 47                 fastcgi_param SCRIPT_FILENAME $document_root/silexsite/public/index.php;
 48         }
 49



#################






add this line to php.ini
cgi.fix_pathinfo = 0

Reload configuration
/etc/init.d/php5-fpm reload

vim Test :
vi /usr/share/nginx/www/info.php

<?php
phpinfo();
?>

Linux configuration
--
To enable user creation by the php script, we have to made a few modifications :
modify /etc/sudoers like 
> www-data ALL=NOPASSWD: /home/administrtateur/projet/vpn-ssh-gateway/server/bash/adduser.sh,/home/administrtateur/projet/vpn-ssh-gateway/server/bash/kill_userprocesses.sh,/usr/sbin/deluser,/bin/rm,/bin/chmod,/bin/chown,/bin/mv



Might have to also comment  
> Defaults requiretty



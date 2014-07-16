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
> www-data ALL=(root) NOPASSWD: /usr/sbin/useradd

Might have to also comment  
> Defaults requiretty



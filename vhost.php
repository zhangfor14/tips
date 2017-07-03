#第一个站点localhost
<VirtualHost *:80>
    ServerName localhost
    DocumentRoot "H:/amp/Apache/htdocs"
    <Directory "H:/amp/Apache/htdocs">
        Options Indexes
        AllowOverride All
        Order Deny,Allow
        Allow from All
        DirectoryIndex index.php index.html main.php
    </Directory>
</VirtualHost>

#第二个站点www.dy.com
<VirtualHost *:80>
    ServerName www.dy.com
    ServerAlias www.Dy.com Dy.com dy.com
    DocumentRoot "H:/www"
    <Directory "H:/www">
        Options Indexes
        AllowOverride All
        Order Deny,Allow
        Allow from All
        DirectoryIndex index.php index.html main.php
    </Directory>
</VirtualHost>

#第三个站点(phpmyadmin站点)
<VirtualHost *:80>
    ServerName www.myadmin.com
    ServerAlias www.myadmin.com
    DocumentRoot "H:/amp/phpMyAdmin4.1.9"
    <Directory "H:/amp/phpMyAdmin4.1.9">
        Options Indexes
        AllowOverride All
        Order Deny,Allow
        Allow from All
        DirectoryIndex index.php index.html main.php
    </Directory>
</VirtualHost>

#第四个站点(php38站点)
<VirtualHost *:80>
    ServerName www.php38.com
    ServerAlias php38.com
    DocumentRoot "H:/php____"
    <Directory "H:/php____">
        Options Indexes
        AllowOverride All
        Order Deny,Allow
        Allow from All
        DirectoryIndex index.php index.html main.php
    </Directory>
</VirtualHost>

#第五个站点(project站点)
<VirtualHost *:80>
    ServerName www.pg.com
    ServerAlias pg.com www.PG.com PG.com
    DocumentRoot "H:/project"
    <Directory "H:/project">
        Options Indexes
        AllowOverride All
        Order Deny,Allow
        Allow from All
        DirectoryIndex index.php index.html main.php
    </Directory>
</VirtualHost>

#第六个站点(ecshop)
<VirtualHost *:80>
    ServerName www.ecshop.com
    ServerAlias ecshop.com
    DocumentRoot "H:/php____/22-big-project"
    <Directory "H:/php____/22-big-project">
        Options Indexes
        AllowOverride All
        Order Deny,Allow
        Allow from All
        DirectoryIndex index.php index.html main.php
    </Directory>
</VirtualHost>

#第七个站点(http://xnfh.tech/)
<VirtualHost *:80>
    ServerName xnfh.tech
    DocumentRoot "H:/www/ZZYPHP"
    <Directory "H:/www/ZZYPHP">
        Options Indexes
        AllowOverride All
        Order Deny,Allow
        Allow from All
        DirectoryIndex index.php index.html main.php
    </Directory>
</VirtualHost>
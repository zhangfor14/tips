@echo off
tasklist /nh|find /i "php.exe"
if ERRORLEVEL 1 (echo 小时数据网格化将要开始......) else ((echo 程序已在运行,程序将退出......)&pause&exit)

@echo 程序运行完毕后,该窗口将自动关闭......
@echo 请不要关闭该窗口.....然后耐心等待......
D:
cd D:\WWW\MeteoProduct
D:\phpStudy\php53\php.exe cli.php /Synchronism/Gridmeteodata/index
::pause
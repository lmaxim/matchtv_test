1) Задан низкий приоритет чтобы сохранить то что было действительно показано пользователю

vagrant@scotchbox:/var/www/matchtv/matchtv_test/matchtv_test$ php bin/console debug:event-dispatcher kernel.terminate

Registered Listeners for "kernel.terminate" Event
=================================================

 ------- ----------------------------------------------------------------------------------- ---------- 
  Order   Callable                                                                            Priority  
 ------- ----------------------------------------------------------------------------------- ---------- 
  #1      Symfony\Bundle\SwiftmailerBundle\EventListener\EmailSenderListener::onTerminate()   0         
  #2      Symfony\Component\HttpKernel\EventListener\ProfilerListener::onKernelTerminate()    -1024     
  #3      Matchtv\HttpBundle\EventListener\RequestLogListener::onKernelTerminate()            -100500   
 ------- ----------------------------------------------------------------------------------- ---------- 


2) создано хранилище в yandex.clickhouse

CREATE DATABASE IF NOT EXISTS matchtv;

CREATE TABLE IF NOT EXISTS matchtv.log
(
	hash String,
    url String,
    reqhead String,
    reqbody String,
    reshead String,
    resbody String,
    status UInt16,
    ip String,
    date Date,
    datetime DateTime
) ENGINE = MergeTree(date, (date, ip), 8192)

3) @TODO: пропатчил friendsofdoctrine/dbal-clickhouse до совместимого с генератором состояния, нужно переписать его

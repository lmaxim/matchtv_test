Задан низкий приоритет чтобы сохранить то что было действительно показано пользователю

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
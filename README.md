HttpCaptureBundle
=================
A Symfony2 bundle that logs HTTP request and response information for debugging proposes. It can be switched on and off at will to help track down errors.

This bundle was initially developed to help analyse REST web service interaction. The captured information is sent to the application logger (Monolog) over the channel "http_capture". With Symfony 2.0 all logging messages are directed all message handlers. Symfony 2.1 will resolve this issue and it will be simple for all messages on the http_capture channel to be directed to a dedicated logging handler (file, database, monitoring system, etc...)


TODO
----
* Write tests.
* Optional capture info (security info, time taken to service request, memory usage, etc).
* Test performance with large request/responses.
* Add composer definition and setup automated packagist deployment on from tags.
* Add to TravisCI.

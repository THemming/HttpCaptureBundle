HTTP Capture Bundle
===================
A Symfony2 bundle that logs HTTP request and response information for debugging proposes. It can be switched on and off at will to help track down errors.

This bundle was initially developed to help analyse REST web service interaction. The captured information is sent to the application logger (Monolog) over the channel "http_capture". With Symfony 2.0 all logging messages are directed all message handlers. Symfony 2.1 will resolve this issue and it will be simple for all messages on the http_capture channel to be directed to a dedicated logging handler (file, database, monitoring system, etc...)

Install & Configuration
-----------------------
These instruction are for Symfony 2.0.x.

1. Add this repo to you `deps` file:
```
[HttpCaptureBundle]
git=http://github.com/Pequin/HttpCaptureBundle.git
target=/bundles/Pequin/HttpCaptureBundle
```
1. Run `./bin/vendors install`.
1. Add to `AppKernel.php` in the `registerBundles()` function:
    new Pequin\HttpCaptureBundle\HttpCaptureBundle(),
1. Add to `autoload.php`:
```
'Pequin'           => __DIR__.'/../vendor/bundles',
```
1. Configure parameters for your application:
```yaml
http_capture:
    enabled:  1
    max_length: 1000
```

TODO
----
* Write tests and add to TravisCI.
* Additional capture info: security, time taken to service request, memory usage, form-encoded data, truncated multipart data.
* Add composer definition and setup automated packagist deployment on from tags.
* Test performance with large request/responses.


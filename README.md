HTTP Capture Bundle
===================
A Symfony2 bundle that logs HTTP request and response information for debugging proposes. It can be switched on and off at will to help track down errors.

This bundle was initially developed to help analyse REST web service interaction. The captured information is sent to the application logger (Monolog) over the channel "http_capture". With Symfony 2.0 all logging messages are directed to all message handlers. Symfony 2.1 will resolve this issue and it will be simple for all messages on the http_capture channel to be directed to a dedicated logging handler (file, database, monitoring system, etc...)

Install & Configuration
-----------------------
These instruction are for Symfony 2.0.x.

Add this repo to you `deps` file:
```
[HttpCaptureBundle]
  git=http://github.com/Pequin/HttpCaptureBundle.git
  target=/bundles/Pequin/HttpCaptureBundle
```

Run `./bin/vendors install`

Add to `AppKernel.php` in the `registerBundles()` function:
```php
new Pequin\HttpCaptureBundle\HttpCaptureBundle(),
```

Add to `autoload.php`:
```php
'Pequin'           => __DIR__.'/../vendor/bundles',
```

Configure parameters for your application, e.g. `config.yml`, `config_prod.yml`, etc:
```yaml
http_capture:
    enabled:  1
    max_length: 1000
```

Of course these values can be set as parameters for the `parameters.ini` file by setting them to something like:
```yaml
http_capture:
    enable: %http_capture_enable%
    max_length: %http_capture_max_length%
```

TODO
----
* Write tests and add to TravisCI.
* Additional capture info: security, time taken to service request, memory usage, form-encoded data, truncated multipart data.
* Symfony 2.1 branch. Add composer definition and setup automated packagist deployment.
* Test performance with large request/responses.


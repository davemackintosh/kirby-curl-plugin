kirby-curl-plugin
=================

Adds a nice wrapper for curling something or other.. In Kirby..

Requires
========

PHP 5.3+ // Contact your host about this.

Use
===

    kurl::Instance()
        ->url('http://davemackintosh.co.uk')
        ->returnData()
        ->verify(false)
        ->execute(function ($data, $errors) {
            // Do something with the errors or data
            // or something here.
            // ..
            // Or just dance. Cheer up.
        });
        
There are functions for not returning data but I suggest you read the file and doc blocks
Send a Tweet to move a Servo
============================

When anyone tweets `setservo 123` (where 123 is a number of degrees) then the servo will move to that many degrees.


Usage
-----

Run the sketch on an arduino (must be plugged in to USB), then run the PHP. The serial port may need changing.


How it works
------------

1. PHP getts Twitter's search results from a JSON feed, looks for the right command  and writes to the serial port.

2. The Arduino reads data over the serial port and if it's a valid number of degrees then it sends a signal to move a servo.

# Petcam #

--------------------------------------------------------------

Author: Mark Ross

Contact: <krazkidd@gmail.com>

Project hosted at:
  <https://github.com/krazkidd/petcam>

License: GNU Affero GPLv3 (see COPYING file)

Requirements:

* PHP >= 5.5

* a Web server and whatever necessary PHP module

* A manner in which to periodically update images on the
  server (The Motion software project makes it easy to
  capture images and run custom scripts to upload. See:
  <https://github.com/Motion-Project/motion>)

Installation:

1. Copy config/local-config.php-example to
   config/local-config.php and edit the settings in the
   latter to meet your needs.

2. Change about.php to link to your distributable copy
   of the software.

3. Grep the distribution files for references to the 'images'
   folder. You will need to provide those images to complete
   the intended user experience.
   
4. Drop all files into the web root of your server.

5. Consider adopting a pet from a local shelter.

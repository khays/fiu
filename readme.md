Fast Image Uploader
===================

Fast Image Uploader (FIU) is a tool that was created because of the lack of simple image hosting sites. This tool allows you to upload images to your site for easy sharing and no weird dependancies. I wanted a imgur clone, but there was nothing that was easy enough to install, so I built my own.

Runs on php, with no database, uses twig for templating.

Current supports:

* jpg
* gif
* png

No other file types tested.

Warning
-------

This was built quickly and I do not know a lot about building secure php websites, so this probably is not very secure. You cannot hid files on here, so once they are uploaded, anyone that goes to your site will see them.

Install
-------

Copy/clone these files to a directory that apache knows about and it should work. 

New project
-----------

This project is young, and does not have a lot of features. I plan to add some features in the future

* Drag and drop uploading
* nicer urls
* tags - any good ideas how to do this without a database?
* Improve the theme

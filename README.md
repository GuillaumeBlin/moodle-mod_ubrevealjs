Moodle 2.0+ plugin for reveals.js presentations
================

Synthesis
------------

This project provides the excellent Reveal.js project as a moodle activity. 
It is based on the mod_revealjs moodle activity plugin of {@matbury}. It provides a "simplier" way (for reveal.js confident user) to describe presentation content. It is also base on the use of a hidden peculiar "folder" activity named "revealjs-data" wich can be used to store all resources of the slides.
  
Installation
------------

To install the plugin using git, execute the following commands in the root of your Moodle install:

    git clone https://github.com/GuillaumeBlin/moodle-mod_ubrevealsjs.git your_moodle_root/mod/ubreveals
    
Or, extract the following zip in `your_moodle_root/mod/` as follows:

    cd your_moodle_root/mod/
    wget https://github.com/GuillaumeBlin/moodle-mod_ubrevealsjs/archive/master.zip
    unzip -j master.zip -d ubrevealjs

Authors and Contributors
------------

In 2016, Guillaume Blin (@GuillaumeBlin) based on Hakim El Hattab (@hakimel) Reveal.js and Matt Bury {{@matbury} mod_revealjs projects.

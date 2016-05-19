Moodle 2.0+ plugin for reveals.js presentations
================

Synthesis
------------

This project provides the excellent Reveal.js project as a moodle activity. 
It is based on the mod_revealjs moodle activity plugin of (@matbury). It provides a "simplier" way (for reveal.js confident user) to describe presentation content. It is also base on the use of a hidden peculiar "folder" activity named "revealjs-data" wich can be used to store all resources of the slides.
  
Installation
------------

To install the plugin using git, execute the following commands in the root of your Moodle install:

    git clone https://github.com/GuillaumeBlin/moodle-mod_ubrevealjs.git your_moodle_root/mod/ubrevealjs
    
Or, extract the following zip in `your_moodle_root/mod/` as follows:

    cd your_moodle_root/mod/
    wget https://github.com/GuillaumeBlin/moodle-mod_ubrevealjs/archive/master.zip
    unzip -j master.zip -d ubrevealjs

Use
------------

You will need in each course using the module a folder resource named "revealjs-data". The content will be referencable in your presentation using "\_ubrevealjs\_/" which will be replaced at running by the right path. The presentation is defined using two fields. The first one consist in the content of the slide div.

For example,

```
<section> 
content of first slide
</section>
<section> 
    ...
    <img class="stretch" data-src="_ubrevealjs_/sample.png" alt="sample">
    ...
</section>
```

The second field corresponds to the javascript content of the Reveal.initialize function.

For example,
```
{
    controls: true,
    progress: true,
    history: true,
    center: true,
    audio: {
        prefix: '_ubrevealjs_/audio/', 
        suffix: '.ogg',
        advance: 0, 
        autoplay: true,
        defaultDuration: 2,
        playerOpacity: 0.05,
        startAtFragment: true
    },
    menu: {
        side: 'left',
        numbers: false,
        hideMissingTitles: false,
        markers: true,
        custom: false,
        themes: false,
        transitions: false,
        openButton: true,
        openSlideNumber: false,
        keyboard: false
    },
    transition: 'convex', // none/fade/slide/convex/concave/zoom
    dependencies: [
        { src: 'plugin/menu/menu.js' },
        { src: 'lib/js/classList.js', condition: function() { return !document.body.classList; } },
        { src: 'plugin/audio-slideshow/audio-slideshow.js', condition: function( ) { return !!document.body.classList; } },
        { src: 'plugin/highlight-code-focus/highlight.min.js', async: true, callback: function() { hljs.initHighlightingOnLoad(); } },
        { src: 'plugin/reveal-code-focus/reveal-code-focus.js', async: true, callback: function() { RevealCodeFocus(); } },
        { src: 'plugin/zoom-js/zoom.js', async: true },
        { src: 'plugin/sampler/sampler.js' }
    ]
}
```

Several plugins are available:

* audio-slideshow  
* highlight-code-focus  
* math  
* multiplex  
* notes-server  
* reveal-code-focus  
* search
* highlight        
* markdown              
* menu  
* notes      
* print-pdf     
* sampler            
* zoom-js

Authors and Contributors
------------

In 2016, Guillaume Blin (@GuillaumeBlin) based on Hakim El Hattab (@hakimel) Reveal.js and Matt Bury (@matbury) mod_revealjs projects.

---
layout: post
id: 52098745639
link: http://chad.ill.ac/post/52098745639/handlebars-handlebarsjs-precompiled-templates
slug: handlebars-handlebarsjs-precompiled-templates
date: Mon Jun 03 2013 17:25:00 GMT-0700 (PDT)
publish: 2013-06-03
tags: handlebars, handlebarsjs, precompiled, templates, precompiletemplates, error, javascript, handlebars.js, quickfix, quick fix, precompiled templates
title: Handlebars (Handlebarsjs) + Precompiled Templates = Error has no method 'merge'
---
{% include JB/setup %}


Handlebars (Handlebarsjs) + Precompiled Templates = Error: has no method 'merge'
================================================================================

After a server move we started encountering errors after precompiling
our handlebars templates.  Googling didn’t help much but after playing
around with various versions of the compiler and runtime (both of ours
were old on the older server) it seems like using runtime 1.0.0 with the
older 1.0.11 version of the handlebars CLI compiler works.

Installing older version of compiler via NPM:

    $ npm install handlebars@1.0.11 -g

I hope you didn’t waste too much time and found this solution quicker
than I was able to.


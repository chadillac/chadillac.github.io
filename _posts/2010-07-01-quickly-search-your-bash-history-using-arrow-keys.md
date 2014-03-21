---
layout: post
id: 813690161
link: http://chad.ill.ac/post/813690161/quickly-search-your-bash-history-using-arrow-keys
slug: quickly-search-your-bash-history-using-arrow-keys
date: Wed Jul 14 2010 21:13:00 GMT-0700 (PDT)
publish: 2010-07-014
tags: 
title: Quickly search your bash history using arrow keys
---
{% include JB/setup %}


Quickly search your bash history using arrow keys
=================================================

Add these lines to your /etc/inputrc to enable the functionality.

    "\e[A": history-search-backward
    "\e[B": history-search-forward

Thanks Reddit and Archwiki!\

([http://wiki.archlinux.org/index.php/Bash](http://wiki.archlinux.org/index.php/Bash))

p.s. this functionality is included in your inputrc file by default on
Ubuntu 10.4 and can be used by uncommenting the lines (41 & 42), but
rather than arrows it uses Page Up and Page Down.


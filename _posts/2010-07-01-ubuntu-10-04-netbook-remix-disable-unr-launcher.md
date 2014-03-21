---
layout: post
id: 839778138
link: http://chad.ill.ac/post/839778138/ubuntu-10-04-netbook-remix-disable-unr-launcher
slug: ubuntu-10-04-netbook-remix-disable-unr-launcher
date: Wed Jul 21 2010 00:00:00 GMT-0700 (PDT)
publish: 2010-07-021
tags: 
title: Ubuntu 10.04 Netbook Remix - Disable UNR Launcher
---
{% include JB/setup %}


Ubuntu 10.04 Netbook Remix : Disable UNR Launcher
=================================================

I installed UNR in version 9.10 and immediately disabled the netbook
launcher for the classic desktop.  This was easy in 9.10 thanks to a
setting in the system preferences called “Desktop Mode Switcher”.  It
was great, it was easy… and now it’s gone.

For whatever reason in 10.04 they decided to get rid of this handy
little tool.  I had to purge some nautilus config files and all of a
sudden, I was back to UNR launcher.  I couldn’t find my trusty switcher
so I started looking around the web… people are going through 5-12 steps
to get around this thing, many without full success.  I’m writing this
in the hopes that \_YOU\_ the person reading this finds it before you go
through 12 steps of tweaking config files. 

Step 1: Remove the netbook-launcher

> sudo aptitude remove netbook-launcher

Step 2: Install regular ubuntu-desktop

> sudo aptitude install ubuntu-desktop

Step 3: Restart Gnome

> sudo service gdm restart

Step 4: Login using Gnome as your session

Done and done… hope this saves someone from a headache.


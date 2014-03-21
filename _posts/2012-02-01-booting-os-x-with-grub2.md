---
layout: post
id: 17627797744
link: http://chad.ill.ac/post/17627797744/booting-os-x-with-grub2
slug: booting-os-x-with-grub2
date: Tue Feb 14 2012 15:42:46 GMT-0800 (PST)
publish: 2012-02-014
tags: 
title: Booting OS X with Grub2
---
{% include JB/setup %}


Booting OS X with Grub2
=======================

I installed Ubuntu on a Mac Mini at work and needed to get back into OS
X for some testing.  The default configured Grub entries wouldn’t load
for OS X (hd0, part0).  After looking over the net and digging through
lines and lines of Grub conf I found a little blurb from another user
saying they’d tried this and it worked… so if you’re beating yourself up
over OS X and Grub2 give this a try and see if it works… it did for me.

open up your Grub2 conf file, which in Ubuntu is located at

    /boot/grub/grub.cfg

Then at the bottom of the menu entries I added:

    menuentry "Mac OS X (Custom/Bootable)" --class osx --class darwin --class os {
            set root=(hd0,0)
            exit
    }

This entry gets me booted into rEFIt at which point I can properly boot
into OS X Lion without issues.  From this point forward the machine will
default into rEFIt until you choose to boot into Linux again… which will
push you back into Grub2 for future boots.

**"If it’s stupid but it works, it isn’t stupid."**

Note: I’d already installed and had rEFIt running from the previous
Ubuntu install


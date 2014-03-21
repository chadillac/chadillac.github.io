---
layout: post
id: 55346511699
link: http://chad.ill.ac/post/55346511699/thinkpad-linux-scrolling-after-reboot
slug: thinkpad-linux-scrolling-after-reboot
date: Sat Jul 13 2013 08:50:00 GMT-0700 (PDT)
publish: 2013-07-013
tags: thinkpad, linux, gpointing-device-settings, persistent, fix, hack, arch, archlinux, ubuntu
title: ThinkPad - Linux - Scrolling after reboot
---
{% include JB/setup %}


ThinkPad : Linux : Scrolling after reboot
=========================================

After a reboot my gpointing-device-settings would never stick for middle
mouse button emulation and scrolling.  After looking around this seems
to be a bug with the gpointing-device-settings application, but buried
in the bug report comments a user has found a fix/hack.

This workaround seems to fix the issue on my X220 and makes the
scrolling persistent even after reboot.

In the file **/usr/share/X11/xorg.conf.d/20-thinkpad.conf **(if it
doesn’t exist, create it.) put the following contents:

    Section "InputClass"
        Identifier "Trackpoint Wheel Emulation"
        MatchProduct "TrackPoint"
        MatchDevicePath "/dev/input/event*"
        Driver "evdev"
        Option "EmulateWheel" "true"
        Option "EmulateWheelButton" "2"
        Option "Emulate3Buttons" "false"
        Option "XAxisMapping" "6 7"
        Option "YAxisMapping" "4 5"
    EndSection

reference: [](https://bugs.launchpad.net/ubuntu/+source/gpointing-device-settings/+bug/489830/comments/30)[https://bugs.launchpad.net/ubuntu/+source/gpointing-device-settings/+bug/489830/comments/30](https://bugs.launchpad.net/ubuntu/+source/gpointing-device-settings/+bug/489830/comments/30) (thanks
Tommi!!!)


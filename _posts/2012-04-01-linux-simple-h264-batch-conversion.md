---
layout: post
id: 21398684009
link: http://chad.ill.ac/post/21398684009/linux-simple-h264-batch-conversion
slug: linux-simple-h264-batch-conversion
date: Thu Apr 19 2012 14:42:00 GMT-0700 (PDT)
publish: 2012-04-019
tags: linux, handbrake, video conversion, batch, h264, easy conversion, easy
title: Linux simple h264 batch conversion
---
{% include JB/setup %}


Linux simple h264 batch conversion
==================================

You’ll need HandBrakeCLI
([http://handbrake.fr/downloads2.php](http://handbrake.fr/downloads2.php))
and a terminal.  To convert a video (the easiest way possible, thanks to
HandBrake mind you, ffmpeg was giving me a lot of issues) is really
simple, but depending on your machine, the quality, the size, etc. it
can take a good bit of resources and a good bit of time to complete one
of these encodings.  If you’re not keen to sitting around watching
progress counters and ETAs there will surely be down time between
encoding tasks as you’ll have to manually keep an eye on them.  Using
some common \*nix tools we can make this automated and easy to use.

**Basic HandBrakeCLI encoding:**

    HandBrakeCLI -Z Universal -i infile.avi -o outfile.mp4

The above will take a standard avi format video and convert it to an
h264 format video, simple.

**Batch Conversion:**

    ls *.avi | awk '{print "HandBrakeCLI -Z Universal -i \x22"$0"\x22 -o \x22"$0".mp4\x22"}' | sh

The above will (assuming you’re in a directory with several .avi files)
will go over each file, build the appropriate conversion command for
HandBrakeCLI and then pipe that into sh to execute the command.  I’ve
been doing mass conversions for web streaming purposes using this
technique, so far I’ve converted over 600 individual videos and still
going strong.


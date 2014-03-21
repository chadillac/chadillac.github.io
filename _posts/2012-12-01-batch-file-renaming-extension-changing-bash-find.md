---
layout: post
id: 37390347917
link: http://chad.ill.ac/post/37390347917/batch-file-renaming-extension-changing-bash-find
slug: batch-file-renaming-extension-changing-bash-find
date: Thu Dec 06 2012 22:29:00 GMT-0800 (PST)
publish: 2012-12-06
tags: 
title: Batch file renaming, extension changing (bash, find, &amp; awk)
---
{% include JB/setup %}


Batch file renaming, extension changing (bash, find, & awk)
===========================================================

I had a ton of files on a remote server I needed to change the extension
on.  Using find -exec didn’t seem like the right solution after a couple
minutes of Googling so I decided to use my favorite trick of bash pipes,
awk, and sh. Below I’ll show you the one-liner I used and then we’ll
break it down and explain what we’re doing.

**The Command:**

    find . -name '*.html' | awk '{printf "mv "$0; sub(/html/,"php"); print " "$0}' | sh

**The Breakdown:**

We’ll start by breaking up the command into it’s individual pieces

    find . -name '*.html'

First we find all of the files matching our search, in this example
we’re looking for all files in our current directory (including
sub-directories, find is recursive by default)

    awk '{printf "mv "$0; sub(/html/,"php"); print " "$0;}'

Here we take the input coming out of find via a pipe. We’ll essentially
use that output to write a shell command on the fly. Since this command
looks kind of messy we’ll break it down piece by piece

    1: awk '{
    2:      printf "mv "$0;
    3:      sub(/html/,"php");
    4:      print " "$0;
    5:     }'

**line 1:**\
Call awk and begin our program with

    '{

**line 2:**\
Output the first part of our “on the fly” shell command (note we use
printf to suppress the default newline included in print)

    mv 1.html

**line 3:**\
Modify the input

    1.html ==> 1.php

**line 4:**\
Output the now modified input of our “on the fly” shell command (and
here we use print, because that default newline is wanted)

     1.php

**line 5:**\
Close our awk program

    }'

**let’s look at some example input and output**

    $ ls
    10.html  1.html  2.html  3.html  4.html  5.html  6.html  7.html  8.html  9.html

    $ find . -name '*.html' | awk '{printf "mv "$0; sub(/html/,"php"); printf " "$0"\n"}'
    mv 10.html 10.php
    mv 1.html 1.php
    mv 2.html 2.php
    mv 3.html 3.php
    mv 4.html 4.php
    mv 5.html 5.php
    mv 6.html 6.php
    mv 7.html 7.php
    mv 8.html 8.php
    mv 9.html 9.php

    sh

Now that we have our commands being written by awk all we have to do is
redirect their output into sh for execution.

**and that’s it, you’re done.** \
 See that wasn’t so bad. It’s worth noting this technique can use a
standard ls if you’re doing a blanket rename. It’s also worth noting
this technique can be expanded even further to allow all types of
renaming/batching logic. I’ve used a technique much like this for doing
batch video conversion, log renaming, etc.


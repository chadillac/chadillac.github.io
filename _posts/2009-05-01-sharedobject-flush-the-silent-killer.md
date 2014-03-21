---
layout: post
id: 111118318
link: http://chad.ill.ac/post/111118318/sharedobject-flush-the-silent-killer
slug: sharedobject-flush-the-silent-killer
date: Thu May 21 2009 13:30:00 GMT-0700 (PDT)
publish: 2009-05-021
tags: 
title: SharedObject.flush() the silent killer.
---
{% include JB/setup %}


SharedObject.flush() the silent killer.
=======================================

We launched our Video Chat Application to mostly good reviews from the
user community.  One of our biggest complaints/bugs was “The app doesn’t
load… it just displays a blank white page after the “loading” screen
goes away”.  We’d tried old Flash player versions, older browsers,
multiple OS’s and STILL couldn’t reliably duplicate the error.  After a
couple weeks of the app being live someone started a thread on the
community forums titled “Think I know why people are having problems
getting into chat..”.  Sure enough the user pointed out a development
over sight.  It seems that if a user has set their “Local Storage”
settings in Flash to 0 the app would fail to load, the forum thread gave
a quick description on how to set this to a higher number.

We weren’t exactly sure as to why this happened on some systems nor why
your average user would have changed this (testing locally wouldn’t
duplicate the bug, but the fix was indeed working for people left and
right).  So we let people in customer service know about this fix… but
that still didn’t answer why it was breaking.  We knew it had to do with
local storage (obviously) and more than likely it was related to saving
Local Shared Objects to the clients system to keep their settings
preferences between app sessions.  What I found out just really pissed
me off more than anything.

So turns out if you’re using Local Shared Objects and a user has
disabled local storage your app will run fine.   You can freely write
and read to the Shared Object without any issues the problem arose when
you’d issues a SharedObject.flush().  But that wouldn’t fail UNLESS a
user has checked “never ask again”.  See if a user had set the number to
0 when you issued a flush() the app would ask them for permission but if
they had checked “never ask again” the SharedObject would throw a fatal
error (that doesn’t even register in the Debug Flash Player mind you).

In short… if using Local Shared Objects in your app your code should
look something like this.

    public var my_so:SharedObject = SharedObject.getLocal('your_so');public function save_so():Boolean{    var so_status:String;    try    {        so_status = my_so.flush();    }    catch(e)    {        Alert.show("you'll need to enable local storage to save settings.");        return false;    }    if(so_status == "pending")    {        // set to 0 ... prompted user for allow or deny... might have saved it.        return false;    }    else if(so_status == "flushed")    {        // successfully wrote SO to disk.    }    return true;}


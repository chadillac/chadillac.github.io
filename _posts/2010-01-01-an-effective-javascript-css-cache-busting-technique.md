---
layout: post
id: 353013824
link: http://chad.ill.ac/post/353013824/an-effective-javascript-css-cache-busting-technique
slug: an-effective-javascript-css-cache-busting-technique
date: Mon Jan 25 2010 12:09:59 GMT-0800 (PST)
publish: 2010-01-025
tags: CSS, JavaScript, JS, Cascading Style Sheets, Caching, Cache Busting
title: An effective JavaScript &amp; CSS cache busting technique
---
{% include JB/setup %}


An effective JavaScript & CSS cache busting technique
=====================================================

Client side cache is both a friend and an enemy.  As many web designers
and developers have learned in the past what it saves you in bandwidth
is worth more than it’s share of headaches.  With that said one of it’s
major headaches is old files on end users computers being used and
breaking functionality.  This can be felt in layout as well as code
(e.g. undefined function ‘do\_important\_stuff()’) if you’re newly
modified files never make it to your end users.

There is an old trick that’s been around for a good while and helped
this a bit, an old annoying and version tracking pain in the ass trick. 
You would change your file names with each major revision (core.v1.js or
member.v1.css) which would cause browsers on the client side to request
and store the file thinking it was new.  From a design aspect it wasn’t
to bad, from the version control aspect it wasn’t to bad, and from the
implementation aspect it wasn’t to bad… but it was annoying.

Trying to move away from this you’d more than likely discover the GET
variable hack.  Basically appending useless garble to the end of your
file name (file.css?garble=1351341) would ensure your end users browser
fetch the file from your server.  This was usually done with a variable
in your source or more often than not a Unix time stamp.  A concern with
this method arose in your bandwidth bill if you did it wrong.  Most
people would just append the time stamp, and since it changes everyone
second every single page load would cause yet another extra and
pointless call to the server for the same old unmodified file.  As if
that wasn’t already fugly and possibly expensive (depending on your
traffic) it didn’t work in some versions of IE.

During a discussion on better ways to handle JavaScript cache busting
with our head software engineer I came up with a fairly simple idea that
I hadn’t thought of before… let the file bust it’s own damn cache!
Basically using PHP and file system mtimes we should be able to not only
make this problem null and void but we can fix it once and never look
back.

Using a couple quick functions in PHP and a simple rewrite rule placed
on the server we were up and running in no time. Some code snippets and
explanations will follow.

PHP include function:

    function javascript_include($file_name = null){
        if (empty($file_name)){
            return false;
        }

        $file = WWW_WEB_DIR.'/js/'.$file_name;
        $timestamp = 0;

        if ($file_exists($file)) {
            $timestamp = filemtime($file);
        } else {
            return false;
        }

        $script_url = "/js/$timestamp/$file_name";

        return "<script type=\"text/javascript\" src=\"$script_url\"></script>\n”;
    }

Using PHP function:

    <?=javascript_include('site_core.js')?>

Resulting output:

    <script type="text/javascript" src="/js/135134134/site_core.js"></script>

Rewrite rule:

    RewriteRule (.*)/[0-9]+/(.*\.js)$ $1/$2 [PT]

Summary:

So there you have it, completely automated and effective cache busting. 
This works because browsers universally see the change in the directory
structure and automatically assume it’s a new file causing an initial
fetch of the file and caching it.  If you publish changes to that file
the mtime on the file system of the server will be updated, therefore
the next request to include said file will have a different directory
structure.

Hope this helps others dealing with caching headaches.


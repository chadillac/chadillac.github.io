---
layout: post
id: 378645754
link: http://chad.ill.ac/post/378645754/str-replace-fatal-error-only-variables-can-be-passed
slug: str-replace-fatal-error-only-variables-can-be-passed
date: Mon Feb 08 2010 13:23:00 GMT-0800 (PST)
publish: 2010-02-08
tags: 
title: str_replace &amp; Fatal error - Only variables can be passed by reference
---
{% include JB/setup %}


str_replace & Fatal error: Only variables can be passed by reference
====================================================================

**UPDATE 4/3/2012:**

A commenter pointed out that str\_replace wasn’t properly limiting
replacements via the count param.  After looking around it seems that
\$count no longer limits replacements (I’m honestly wondering if it ever
did…) and rather returns a number of replacements performed.  For any
users experiencing this I’d recommend using **preg\_replace** as it
effectively supports limiting replacements.

    preg_replace('/findit/i','replaceit',$haystack,1);

I could have sworn this func worked using the \$count as a limit in the
past…

* * * * *

If you’re using a simple str\_replace() call in PHP and getting a
strange Fatal error that doesn’t make a whole lot of sense to you I have
a hunch as to why.

**Fatal example:**

    $file_name = str_replace('findit', 'replaceit', $haystack, 1);

In PHP 5.0.5 some changes were made to how PHP handles variables,
functions, and references.  This broke a lot of older code but also
introduced some vague and questionable fatal errors.  They meant well by
doing this by essentially requiring parameters be passed via reference. 
I’m assuming this was to prevent PHP from copying large pieces of data
to work on them and thus helping memory performance overall. Luckily
there is a simple fix, just declare your variable to be passed inline.

**Working example:**

    $file_name = str_replace('findit', 'replaceit', $haystack, $count = 1);

*Note: if you’re working with a large data set in a loop I would highly
recommend setting the reference outside of the loop and avoid this
inline method.*


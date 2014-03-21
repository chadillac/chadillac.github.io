---
layout: post
id: 106488896
link: http://chad.ill.ac/post/106488896/as3-flex-3-arraycollection-copy-duplication
slug: as3-flex-3-arraycollection-copy-duplication
date: Mon May 11 2009 17:21:38 GMT-0700 (PDT)
publish: 2009-05-011
tags: 
title: AS3/Flex 3 ArrayCollection Copy/Duplication
---
{% include JB/setup %}


AS3/Flex 3 ArrayCollection Copy/Duplication
===========================================

In Flex recently I was trying to use the dataProvider of a List
component in another component.  It was for a Video Chat Application and
it would make whispering another user easier by facilitating
auto-completion on a name.  Long story short the dataProvider for said
list had various sorts and filters applied to it so saying
list.dataProvider wasn’t an option because we needed to see the entire
list not just a filtered subset.

ANNNNYWAY… I needed to duplicate and keep a copy for comparisions and
such in the other component.  After looking around and getting very
frustrated I started messing around with a mish-mash of semi-complete
ideas gathered from various sites.  This was my solution and I hope it
helps someone out there.

    function copy_ac(in_array:ArrayCollection):ArrayCollection
    {
        return new ArrayCollection( in_array.source.concat() );
    }


---
layout: post
id: 55193155663
link: http://chad.ill.ac/post/55193155663/easy-ejabberd-clustering-multi-master-fault-tolerant
slug: easy-ejabberd-clustering-multi-master-fault-tolerant
date: Thu Jul 11 2013 12:28:00 GMT-0700 (PDT)
publish: 2013-07-011
tags: ejabberd, multimaster, easy, clustering, fault tolerant, fail over, dual master, ejabberd clustering, erlang, mnesia, failover, multi master, master slave replication
title: easy ejabberd clustering (multi-master, fault tolerant, failover)
---
{% include JB/setup %}


easy ejabberd clustering (multi-master, fault tolerant, failover)
=================================================================

First and foremost, for general cluster configuration steps see this
post:

[](http://chad.ill.ac/post/35967173942/easy-ejabberd-clustering-guide-mnesia-mysql)[http://chad.ill.ac/post/35967173942/easy-ejabberd-clustering-guide-mnesia-mysql](http://chad.ill.ac/post/35967173942/easy-ejabberd-clustering-guide-mnesia-mysql)

Once you have a functioning cluster using those steps and you want to
add multi-master support for better failover and fault tolerance of your
ejabberd cluster come back here and read this post.

**Why?**

After getting our small cluster up and running we started testing
cluster failure handling.  We quickly discovered that no matter how many
slaves you had deployed as soon as your master node experienced issues
the entire cluster became inoperable.  To make things worse fixing the
master didn’t fix the cluster, you would have to completely cycle the
ejabberd instances of every slave to get them working properly again, or
input the mnesia commands to make master communicate with the slaves.
 This is messy, it’s stupid, but most importantly it pretty much kills
the benefit of having a cluster in the first place.  If you have a
single point of failure that is capable of crippling an entire cluster…
well, it’s going to bite you in the ass.

**What to do about it:**

After about a day of piecing together old mailing lists, stackoverflow
posts and articles on mnesia replication, several forums talking about
modifying ejabberdctl, and tinkering we were able to finally track down
a multimaster cluster that could handle any of the nodes dying without
bringing down the entire cluster.  The fix doesn’t so much involve
ejabberd as it involves just using proper erlang/mnesia replication and
removing dependencies on remote tables for underlying data stores used
for route and session management by ejabberd.

I’ve updated the plugin to support this functionality so deploying
failover masters is easier.  We’re only running a small cluster of 3
nodes so we’ve deployed all 3 nodes as masters, this allows us to
kill/cycle any of them without any special procedures needed to
leave/join a cluster after failure/reboot/etc.  That being said I cannot
comment on the performance issues one might experience running a masters
only cluster at a massive scale so using a handful of masters with
regular non-copy/remote slaves might be a better architecture if you’re
dealing with large clusters, but I don’t know, so I can’t advise one way
or the other at this point.  You could also run additional masters with
their own slaves as a failover cluster.

**Plugin:**

[](https://github.com/chadillac/ejabberd-easy_cluster/blob/master/easy_cluster.erl)[https://github.com/chadillac/ejabberd-easy\_cluster/blob/master/easy\_cluster.erl](https://github.com/chadillac/ejabberd-easy_cluster/blob/master/easy_cluster.erl)

**Usage:**

To use the plugin to create a second, third, Nth master node is super
simple.

*note: this requires doing a complete mnesia db copy over the network,
this might hang for a bit if your databases are large or network latency
is high (or both)*

    easy_cluster:join_as_master('ejabberd@any_master_node.domain.com').

That’s it, you’re done!

I hope this tool helps you out and saves you some time. 


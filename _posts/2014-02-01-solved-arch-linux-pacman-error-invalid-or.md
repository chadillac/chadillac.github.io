---
layout: post
id: 76364720764
link: http://chad.ill.ac/post/76364720764/solved-arch-linux-pacman-error-invalid-or
slug: solved-arch-linux-pacman-error-invalid-or
date: Tue Feb 11 2014 14:51:00 GMT-0800 (PST)
publish: 2014-02-011
tags: arch, archlinux, pacman, pgp, error, solved, solution, signature, invalid, corrupted, fixed, fix
title: "[SOLVED] Arch Linux - pacman - ERROR - invalid or corrupted package (PGP signature)"
---
{% include JB/setup %}


[SOLVED] Arch Linux : pacman : ERROR -> invalid or corrupted package (PGP signature)
====================================================================================

Ran into this and couldn’t upgrade.  After a bit of Googling around and
looking at thread after thread after thread of discussion about flags,
config files, sigLevels, etc.  I found a 1 line fix that didn’t required
any of the aforementioned “maybes”.

    # pacman-key --refresh-keys

**fixed.**

The issue is one of the authors of a package you have installed has
since updated their PGP signature they use to sign and verify their
packages.  Your local key for said package is unaware of this and pacman
thinks you’re being duped by an untrustworthy package.  This fix just
runs through your keychain and requests the most recent keys for all of
the packages you care about.

Once the key fetching is done running your upgrade should go off without
a hitch.  If it doesn’t… talk to my friend Google, he’ll know more than
I.


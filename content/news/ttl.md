---
title: "TTL — Through the Lens is out"
date: 2026-08-28T10:00:00+02:00
draft: false
description: "Our noir hidden-object game TTL — Through the Lens is live on Playgama. Raise the lens, find what the room is hiding, and take the photograph."
image: ../img/ttl-3.jpg
tags: ['JavaScript', 'ThreeJS', 'Game', 'WebGL']
---

**TTL — Through the Lens** is live. It is our first game published to a portal, and it is playable now on [Playgama](https://playgama.com/game/through-the-lens).

<!--more-->

![A rooftop at night under a low moon, the lens open over a water tower](../../img/ttl-3.jpg#small)

You are the camera on a case. Each scene is a lit diorama you can orbit — a greenhouse, a detective's study, a rooftop above a sleeping city — and something in it is wrong. Hold to raise the lens, drag it across the scene, and it shows you what the room was hiding. Rest it on the thing that doesn't belong and it tags. Find them all and you take the photograph.

The lens runs on a charge that drains while it's open and refills while it's closed, so you can't simply sweep the room and wait. You have to decide where to look.

Underneath it is the generator we [wrote about in June](/news/diff3d/): every scene is built from a single seed, with props recoloured, rotated, moved or removed under constraints that keep each one findable. The prototype was a side-by-side comparison game; the lens replaced it, and the game got considerably better for it.

Built in strict TypeScript on Three.js, and it runs in a browser tab — no install, no account.

[Play it on Playgama](https://playgama.com/game/through-the-lens), or read how it was built on the [project page](/projects/ttl/).

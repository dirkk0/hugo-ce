---
title: "TTL"
date: 2026-06-01
draft: false
image: ../img/ttl.jpg
tags: ['JavaScript', 'ThreeJS', 'WebGL', 'Game']
description: "TTL (Through The Lens) is a casual 3D spot-the-difference game whose levels are generated algorithmically from a seed — a theoretically infinite puzzle pool, built with Three.js."
---
**TTL — Through The Lens.** A spot-the-difference game in 3D: two scenes you rotate and zoom to compare, with an endless supply of levels generated from a seed.

<!--more-->

![A TTL puzzle scene: a toon-shaded greenhouse, seen through the lens](../../img/ttl.jpg#small)

Two scenes sit side by side — one canonical, one quietly mutated — sharing a single camera, so rotating or zooming moves both at once. Find a difference, press and hold on it, and it heals back into place.

The interesting part is that nobody builds the levels. Each puzzle is generated from a single seed: a base scene is mutated — a prop recoloured, rotated, moved or removed — under spatial and occlusion constraints that keep every difference findable from at least one angle. The generator is pure and renderer-agnostic, so the same seeds can either run live in the browser or be baked into pre-generated levels that ship without the generator.

![A detective's study, one of the hand-built environments the generator works from](../../img/ttl-2.jpg#small)

Around that sits the part that makes it a game: diorama-style walls that fade away as you orbit into them, soft shadows, a toon-shaded look, and a set of hand-crafted environments — a greenhouse, a train station, a detective's study, an ancient plaza, an attic — that the generator treats as raw material. Written in strict TypeScript on Three.js.

There is a [news post](/news/ttl/) with more on the generator.

It stands as a working prototype — one we may yet take further.

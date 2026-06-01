---
title: "diff3d: a spot-the-difference game with infinite levels"
date: 2026-06-01T11:00:00+02:00
draft: true
description: "diff3d is our prototype of a casual 3D spot-the-difference game where every level is generated algorithmically from a seed — a theoretically infinite puzzle pool, built with Three.js."
# image: ../img/diff3d.png   # TODO: add a screenshot or GIF, then uncomment this line and the image below
tags: ['JavaScript', 'ThreeJS', 'Game', 'WebGL']
---

We've been prototyping a casual 3D game we call **diff3d**: two side-by-side scenes you rotate and zoom to compare, then press and hold to "heal" each difference back into place until both scenes match.

<!--more-->

The interesting part is under the hood. Instead of hand-building levels, each puzzle is generated **algorithmically from a single seed** — a base scene is mutated (recolour, rotate, move, or remove a prop) under spatial and occlusion constraints. That makes the level pool theoretically infinite, while a pure, render-engine-agnostic generator lets us also bake levels offline for instant loading.

<!-- ![A diff3d puzzle: two 3D scenes side by side](../../img/diff3d.png#small) -->

There are diorama-style "see-through" walls that fade away as you orbit, soft shadows, and a toon-shaded look across five hand-crafted environments — a greenhouse, a train station, a detective's study, an ancient plaza, and an attic. It's an experiment in procedural content and WebGL game feel, headed for casual web portals first.

Interested in WebGL, Three.js, or procedural generation? [Get in touch](mailto:info@curious-electric.com?subject=Project%20inquiry).

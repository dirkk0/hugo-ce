---
title: "village: a procedural town generator with a day/night cycle"
date: 2026-03-20T11:00:00+02:00
draft: false
description: "village is our experiment in procedural town generation — grid-based layouts, a continuous road network, and a full day/night lighting cycle, all in the browser with Three.js."
image: ../img/village-day.png
tags: ['JavaScript', 'ThreeJS', 'WebGL', 'AI']
---

We've been playing with **village**, a procedural town generator that builds a whole little settlement in the browser — roads, houses, fields, forest and coastline — from a handful of parameters.

<!--more-->

![A generated village at midday](../../img/village-day.png#small)

Tweak the grid and the town reshapes itself: coastal or central-road layouts, an intersection-aware road network that trims and joins cleanly at junctions, and houses placed along cell edges with varied roofs, doors and windows. A day/night slider arcs the sun and moon across the sky, shifts the sky gradient from dawn to dusk, and switches on window and street lights after dark.

![The same village at night, windows and street lights lit](../../img/village-night.png#small)

Like the [Matrix 1000 editor](/projects/oberheim-matrix1000/), it was built largely with AI assistance — another of our experiments in AI-assisted engineering. See the [project page](/projects/village/) for more.
<!-- 
Interested in WebGL, Three.js, or procedural generation? [Get in touch](mailto:info@curious-electric.com?subject=Project%20inquiry). -->

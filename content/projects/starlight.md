---
title: "STARLIGHT"
date: 2024-03-13
draft: false
image: ../img/chart1.png
tags: ['JavaScript', 'ThreeJS', 'WebGL', 'AR']
description: "An interactive star map of our stellar neighbourhood as a web application, built on real astrometric data from ESA catalogues — funded by Film- und Medienstiftung NRW."
---
An interactive star map of our neighbourhood in the universe, as a web application — developed with funding from Film- und Medienstiftung NRW.

<!--more-->

![The solar neighbourhood, rendered from astrometric data — each label a real star](../../img/chart1.png#small)

STARLIGHT was funded by [Film- und Medienstiftung NRW](https://www.filmstiftung.de/news/die-film-und-medienstiftung-nrw-vergibt-340-000-euro-fuer-10-serious-games-projekte/) under its programme for digital games and interactive content, and completed in March 2024. It spans three parts: an interactive star map, the database beneath it, and a space-flight simulator on top — worked out as a concept and backed by running prototypes.

Underneath it all sits real astrometry. The stars come from ESA observation catalogues, chiefly Hipparcos, and a conversion pipeline turns that scientific data into something a real-time engine can carry: positions, distances and magnitudes at a level of detail a browser can render at frame rate. The conversion runs as re-runnable scripts, so the detail level and the clean-up rules can be tuned and the whole dataset regenerated — including the small translations science and games disagree on, such as the negative parallax values that are perfectly meaningful in a catalogue and need interpreting before a star can be placed in space.

![Distances: the sky as we see it, and the same stars as they actually stand](../../img/starlight.png#small)

Three prototypes carry the concept. **distances** separates the flat sky we see from the real depth behind it — the constellation that looks like a shape from here turns out to be stars scattered across hundreds of light years. **compass** anchors the map to where you are actually standing, so the view matches the sky above you. And a star renderer draws the map itself, in the browser, from the converted catalogue.

Augmented Reality in the browser proved to be well within reach with WebXR: point a phone at the sky and the map lines up with it.

The concept, the data pipeline and the prototypes all stand — a foundation we intend to come back to.

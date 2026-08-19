---
title: "Block Forge"
date: 2026-04-15
draft: false
image: ../img/block-forge.png
tags: ['JavaScript', 'ThreeJS', 'WebGL', 'AI']
description: "A pipeline that turns commercial 3D asset packs into clean, measured models — and then lets a machine arrange them into believable game levels."
---
Turning raw commercial asset packs into clean, measured 3D models — and then letting a machine build levels out of them.

<!--more-->

![Cleaned assets from a commercial pack, normalised and ready to place](../../img/block-forge.png#small)

Block Forge started as a visual builder: open an asset pack in the browser, drag pieces into a 3D viewport, export the result. That editor still exists — but the centre of gravity moved twice, and each move was more interesting than the last.

First, from builder to **batch converter**. The genuinely hard part was never the placement UI, it was the assets themselves: broken texture references, inconsistent scales, junk hierarchies. Once that clean-up logic was pulled out into a platform-free module, a whole pack could be converted headlessly — no human in the loop, no viewport open.

Then, from converter to **generator**. With a folder of clean, measured models, the question becomes a different one: can a machine arrange them into a level that reads as a real place? That needs to know what each asset actually *is* — its footprint, its category, whether it's a building you can enter or scenery you walk past — and asset file names tell you almost none of that reliably. So the project grew a two-layer knowledge model, measured data underneath and curated judgement on top, and a generator that lays out levels from it.

It is, in the end, a small study in machine spatial reasoning: giving software enough understanding of objects and space to make decisions a level designer would otherwise make by hand.

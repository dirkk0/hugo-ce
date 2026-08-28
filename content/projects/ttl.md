---
title: "TTL"
date: 2026-08-26
draft: false
image: ../img/ttl.jpg
tags: ['JavaScript', 'ThreeJS', 'WebGL', 'Game']
description: "TTL (Through the Lens) is a noir hidden-object game in 3D — raise a lens over a lit diorama to reveal what it hides — with every scene generated algorithmically from a seed. Built with Three.js and published on Playgama."
---
**TTL — Through the Lens.** A noir hidden-object game in 3D: you are the camera on a case, and the lens shows you what each room is hiding. Published on [Playgama](https://playgama.com/game/through-the-lens).

<!--more-->

![A TTL scene: a toon-shaded greenhouse, seen through the lens](../../img/ttl.jpg#small)

Each scene is a lit diorama you can orbit — a greenhouse, a train station, a detective's study, an ancient plaza, an attic, a rooftop above a sleeping city. Something in it is wrong. Holding down brings up a lens you drag across the scene, and where it passes, what the room was hiding comes up. Rest it on the object that doesn't belong and it tags. Clear the scene and the case moves on.

![A detective's study, one of the hand-built environments the generator works from](../../img/ttl-2.jpg#small)

The part nobody sees is that nobody builds the levels. Each scene is generated from a single seed: a base environment is mutated — a prop recoloured, rotated, moved or removed — under spatial and occlusion constraints that keep every change findable from at least one angle. The generator is pure and renderer-agnostic, so the same seeds either run live in the browser or get baked into pre-generated levels that ship without the generator at all.

It started as **diff3d**, a prototype we [wrote about in June](/news/diff3d/): two scenes side by side under a shared camera, the classic spot-the-difference layout, with the generator already underneath. Comparing two panels turned out to be work rather than play. Replacing them with a single scene and a lens kept everything interesting about the generator and gave the game a reason to be dark, quiet and slow — which is where the noir came from.

Built with Three.js, no framework, and it runs in a browser tab without an install or an account.

[Play it on Playgama](https://playgama.com/game/through-the-lens).

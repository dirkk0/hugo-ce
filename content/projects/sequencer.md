---
title: "Performance Sequencer"
date: 2025-08-10
draft: false
image: ../img/sequencer.jpg
tags: ['JavaScript', 'WebMIDI', 'Audio', 'Python']
description: "A browser-based step sequencer for live performance — ten instruments, pattern chaining, hardware controllers, and MIDI clock sync out to real synthesizers."
---
A step sequencer that runs in the browser and drives real hardware: ten instruments, chained patterns, and MIDI clock going out to the synths in the room.

<!--more-->

![The sequencer running: ten instruments, eight patterns, a sixteen-step grid](../../img/sequencer.jpg#small)

Ten instruments across eight patterns, grids of 8, 16 or 32 steps, chained into arrangements you can rearrange while the music is running. The sounds come from a small polyphonic Web Audio synth — plucks, strings and a drum kit — but the point was never to stay inside the browser.

Timing is the part that decides whether something like this is usable on stage. The playhead is never advanced step by step; its position is recalculated from a master start time on every frame, so it cannot accumulate drift over a set. The transport runs on an internal clock or follows an incoming MIDI clock, which lets the sequencer either lead a rig or fall in behind a DAW.

Outwards it speaks WebMIDI: a Launchpad as a hands-on control surface, and MIDI out to whatever hardware is patched up. A companion Node bridge takes that further and talks to a vintage [Oberheim Matrix 1000](/projects/oberheim-matrix1000/) directly — patch changes and volume over raw MIDI — while a Python audio host runs plugin effect chains live and captures takes, driven over a small HTTP API.

It is a working instrument rather than a product: built to be played, and to find out how far a browser can be pushed as the brain of a hardware setup.

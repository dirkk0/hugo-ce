---
title: "A browser-based editor for the Oberheim Matrix 1000"
date: 2026-02-20T11:00:00+02:00
draft: false
description: "A real-time, browser-based editor for the Oberheim Matrix 1000, built largely with AI (Claude) — Web MIDI speaking SysEx to a 1984 analog synth, no install."
image: ../img/oberheim-matrix1000.png
tags: ['JavaScript', 'WebMIDI', 'Audio', 'AI']
---

The Oberheim Matrix 1000 is a beloved analog synth from 1984 with a famously cryptic front panel — a handful of buttons for a hundred hidden parameters. So we gave it a proper editor that runs entirely in the browser.

<!--more-->

No installation, no backend, no Electron — just open a tab. Using the **Web MIDI API**, the editor speaks Oberheim's SysEx protocol directly to the synth: all 100 parameters grouped by signal flow, the full 10-slot modulation matrix, reading and storing patches, and a live MIDI monitor for debugging. Move a slider and the change reaches the synth in milliseconds. See the [project page](/projects/oberheim-matrix1000/) for the full rundown.

![Browser-based editor for the Oberheim Matrix 1000](../../img/oberheim-matrix1000.png#small)

It's a small love letter to old hardware — and a neat reminder that the modern web platform is more than capable of tight, real-time instrument control with zero install friction.

**A note on how it was made:** this editor was built largely with the help of [Claude](https://www.anthropic.com/claude), Anthropic's AI — we brought the design direction, the SysEx specifics, and the testing against real hardware, and the AI did a lot of the heavy lifting in between. It's one of several experiments we're running into AI-assisted engineering: pairing deep domain knowledge with modern AI to get from idea to a working tool remarkably fast. Expect more notes like this one.

<!-- Curious about web-based audio tools, controlling hardware from the browser, or what AI-assisted development could do for your own project? [Get in touch](mailto:info@curious-electric.com?subject=Project%20inquiry). -->

---
title: "A browser-based editor for the Oberheim Matrix 1000"
date: 2026-05-20T11:00:00+02:00
draft: false
description: "We built a real-time, browser-based patch editor for the Oberheim Matrix 1000 — no install, no backend, just the Web MIDI API talking SysEx to a 1984 analog synth."
image: ../img/oberheim-matrix1000.png
tags: ['JavaScript', 'WebMIDI', 'Audio']
---

The Oberheim Matrix 1000 is a beloved analog synth from 1984 with a famously cryptic front panel — a handful of buttons for a hundred hidden parameters. So we gave it a proper editor that runs entirely in the browser.

<!--more-->

No installation, no backend, no Electron — just open a tab. Using the **Web MIDI API**, the editor speaks Oberheim's SysEx protocol directly to the synth: all 100 parameters grouped by signal flow, the full 10-slot modulation matrix, reading and storing patches, and a live MIDI monitor for debugging. Move a slider and the change reaches the synth in milliseconds.

![Browser-based editor for the Oberheim Matrix 1000](../../img/oberheim-matrix1000.png#small)

It's a small love letter to old hardware — and a neat reminder that the modern web platform is more than capable of tight, real-time instrument control with zero install friction. The same browser-audio and Web MIDI know-how goes into our client work.

Curious about web-based audio tools or controlling hardware from the browser? [Get in touch](/about/).

---
title: "ESP32 Hardware Lab"
date: 2026-08-12
draft: false
image: ../img/esp32.jpg
tags: ['IoT', 'ESP32', 'Audio', 'AI']
description: "An ongoing hardware track: battery-powered ESP32 field devices with e-paper displays, on-device audio recording and a transcription pipeline."
---
An ongoing hardware track — battery-powered ESP32 devices with e-paper screens, on-device recording, and a path from the device to transcribed text.

<!--more-->

![Three boards on the bench: the e-paper device, a 5" RISC-V tablet and a keyboard handheld, the last two running the same grid interface](../../img/esp32.jpg#small)

Software that only ever runs on a screen gets comfortable. So a part of our work has moved onto real boards: three ESP32 devices on the bench, each with its own firmware, toolchain and set of open questions.

The small white one is a battery-powered ESP32-S3 board behind a 1.54" e-paper display. It runs two firmwares of ours: a **voice-memo recorder** — double-click to record, single-click to stop or play back, long-press to upload — and a lean **desk clock** showing time, room temperature, humidity and battery. Recordings go out over WiFi to a small server, get pulled down to a workstation and transcribed, written straight to disk as 16 kHz mono, exactly the format the speech model wants, so nothing needs converting on the way.

Everything interesting about it is a constraint. That idle screen refreshes only once a minute, because e-paper costs energy every time it changes. WiFi stays connected in low-power modem sleep rather than being switched off between uploads — switching it off entirely browned out the little cell and rebooted the device mid-memo. The result runs about eight hours of mixed use and boots in under ten seconds.

The other two run the same thing: a grid-based sampler interface, on a keyboard handheld the size of a card and on a 5" touch tablet built around a RISC-V chip. Two very different boards, one shared engine, kept in step by a link protocol with its own conformance tests — because the moment the same code runs on two machines, "it works here" stops being an answer.

This is a workbench, not a catalogue. It is the part where you find out what a battery, a radio and a display actually do when nobody is watching them through a browser tab — and it is where the next things we build will come from.

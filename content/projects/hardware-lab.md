---
title: "Hardware Lab"
date: 2026-08-12
draft: false
image: ../img/esp32.jpg
tags: ['IoT', 'ESP32', 'Audio', 'AI']
description: "An ongoing hardware track: battery-powered ESP32 field devices with e-paper displays, on-device audio recording and a transcription pipeline."
---
An ongoing hardware track — battery-powered, connected devices with their own firmware, sensors and displays.

<!--more-->

![Three boards on the bench: the e-paper device, a 5" RISC-V tablet and a keyboard handheld, the last two running the same grid interface](../../img/esp32.jpg#small)

Software that only ever runs on a screen gets comfortable. So a part of our work has moved onto real boards: battery-powered ESP32 devices that we design, program and live with.

On the bench right now: a device behind an e-paper display that records a spoken note, sends it on over WiFi and hands it back as text, and doubles as a clock reading the room's temperature and humidity. Next to it, the same sampler interface running on two very different machines — a keyboard handheld the size of a card and a 5" touch tablet — driven by one shared engine.

Hardware asks different questions than a browser does. Power has a budget, radios drop out, displays cost energy every time they change, a device that gets picked up has to be awake and ready in seconds, and the code has to keep working for hours with nobody watching it. Those constraints are the actual work, and they are what makes the results feel solid rather than demonstrated.

This is a workbench, not a catalogue: the groundwork for [where we are taking Curious Electric next](/news/robotics-aiot/).

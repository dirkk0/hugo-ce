---
title: "Pepper Showroom Assistant"
date: 2018-07-08
draft: true
image: ../img/pepper-1.jpg
tags: ['Python', 'Robotics', 'NAOqi']
description: "A prototype assistant system for Aldebaran's Pepper robot, built to welcome and guide visitors in the showroom of a large corporate client."
---
A prototype assistant for Pepper, the humanoid robot by Aldebaran, built to welcome and guide visitors in a corporate showroom.

<!--more-->

![Pepper, ready for duty](../../img/pepper-1.jpg#small)

Curious Electric built a prototype assistant system for **Pepper**, the humanoid service robot by Aldebaran. The idea: a robot host for the showroom of a large corporation — greeting visitors as they arrive, explaining the work of the other robots on show (care robots among them), and pointing people to the right station.

We programmed the behaviours with Aldebaran's Python API: speech and dialogue, gestures, and moving the robot around the floor.

![Behaviour authoring — the movement and dialogue steps were scripted in Python](../../img/pepper-2.jpg#small)

The hard limit turned out to be movement, not code. Even on flat, level floor Pepper could barely get around reliably — a robot host that walks visitors over to the right station was simply not on the table. What was left was everything the robot can do from where it stands: speech, gaze, gestures and the tablet on its chest.

![Testing on the real robot](../../img/pepper-3.jpg#small)

Curious Electric built the system as a subcontractor for [Headtrip GmbH](https://www.head-trip.de/).

<!-- STUB — kept deliberately vague on request: the client stays unnamed, and what became of the project on the client side is not known. Could still be added: duration/scope, team credits, video. -->

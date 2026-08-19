---
title: "Performance Sequencer"
date: 2025-08-10
draft: false
image: ../img/sequencer.jpg
tags: ['JavaScript', 'WebMIDI', 'Audio', 'Python']
description: "Ein Step-Sequencer im Browser für den Live-Einsatz — zehn Instrumente, verkettete Patterns, Hardware-Controller und MIDI-Clock hinaus zu echten Synthesizern."
---
Ein Step-Sequencer, der im Browser läuft und echte Hardware ansteuert: zehn Instrumente, verkettete Patterns, MIDI-Clock hinaus zu den Synths im Raum.

<!--more-->

![Der Sequencer im Betrieb: zehn Instrumente, acht Patterns, ein 16-Step-Raster](../../img/sequencer.jpg#small)

Zehn Instrumente auf acht Patterns, Raster mit 8, 16 oder 32 Steps, verkettet zu Arrangements, die sich im laufenden Betrieb umbauen lassen. Die Klänge kommen aus einem kleinen polyphonen Web-Audio-Synth — Plucks, Streicher und ein Drumkit —, aber im Browser bleiben sollte das Ganze nie.

Über die Brauchbarkeit auf der Bühne entscheidet das Timing. Der Playhead wird nie Schritt für Schritt weitergesetzt, sondern in jedem Frame neu aus einer Startzeit berechnet — so kann sich über ein Set hinweg kein Drift aufsummieren. Das Transport läuft auf einer internen Clock oder folgt einer eingehenden MIDI-Clock: der Sequencer kann ein Setup führen oder sich hinter eine DAW hängen.

Nach außen spricht er WebMIDI: ein Launchpad als Bedienoberfläche zum Anfassen und MIDI-Out zu allem, was gepatcht ist. Eine begleitende Node-Bridge geht weiter und spricht direkt mit einem alten [Oberheim Matrix 1000](/de/projects/oberheim-matrix1000/) — Patch-Wechsel und Lautstärke über rohes MIDI —, während ein Python-Audiohost Effektketten live rechnet und Takes mitschneidet, gesteuert über eine kleine HTTP-API.

Das ist eher ein Instrument als ein Produkt: gebaut zum Spielen — und um herauszufinden, wie weit sich ein Browser als Hirn eines Hardware-Setups treiben lässt.

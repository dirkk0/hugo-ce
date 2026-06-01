---
title: "Ein browserbasierter Editor für den Oberheim Matrix 1000"
date: 2026-02-20T11:00:00+02:00
draft: false
description: "Ein browserbasierter Echtzeit-Editor für den Oberheim Matrix 1000, größtenteils mit KI-Unterstützung (Claude) entwickelt — Web MIDI spricht SysEx mit einem analogen Synthesizer von 1984, ohne Installation."
image: ../img/oberheim-matrix1000.png
tags: ['JavaScript', 'WebMIDI', 'Audio', 'AI']
---

Der Oberheim Matrix 1000 ist ein beliebter analoger Synthesizer aus dem Jahr 1984 mit einem berüchtigt kryptischen Bedienfeld — eine Handvoll Tasten für hunderte versteckte Parameter. Deshalb haben wir ihm einen vollwertigen Editor verpasst, der vollständig im Browser läuft.

<!--more-->

Keine Installation, kein Backend, kein Electron — einfach einen Tab öffnen. Mithilfe der **Web MIDI API** spricht der Editor das SysEx-Protokoll von Oberheim direkt mit dem Synthesizer: alle 100 Parameter nach Signalfluss gruppiert, die vollständige Modulationsmatrix mit 10 Slots, das Lesen und Speichern von Patches sowie ein Live-MIDI-Monitor zur Fehlersuche. Auf der [Projektseite](/projects/oberheim-matrix1000/) finden Sie alle Details.

![Browserbasierter Editor für den Oberheim Matrix 1000](../../img/oberheim-matrix1000.png#small)

Es ist eine kleine Liebeserklärung an alte Hardware — und eine schöne Erinnerung daran, dass die moderne Web-Plattform durchaus zu präziser Echtzeit-Steuerung von Instrumenten fähig ist, ganz ohne Installationsaufwand.

**Eine Anmerkung zur Entstehung:** Dieser Editor wurde größtenteils mit Hilfe von [Claude](https://www.anthropic.com/claude), der KI von Anthropic, entwickelt — wir brachten die Designrichtung, die SysEx-Spezifika und das Testen an echter Hardware ein, und die KI übernahm einen Großteil der Arbeit dazwischen. Es ist eines von mehreren Experimenten, die wir im Bereich der KI-gestützten Entwicklung durchführen: tiefes Fachwissen mit moderner KI zu verbinden, um bemerkenswert schnell von der Idee zu einem funktionierenden Werkzeug zu gelangen. Erwarten Sie weitere Beiträge dieser Art.

Neugierig auf webbasierte Audio-Tools, die Steuerung von Hardware aus dem Browser oder darauf, was KI-gestützte Entwicklung für Ihr eigenes Projekt leisten könnte? [Kontaktieren Sie uns](mailto:info@curious-electric.com?subject=Project%20inquiry).

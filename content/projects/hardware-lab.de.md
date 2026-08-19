---
title: "Hardware Lab"
date: 2026-08-12
draft: false
image: ../img/esp32.jpg
tags: ['IoT', 'ESP32', 'Audio', 'AI']
description: "Eine laufende Hardware-Spur: batteriebetriebene ESP32-Geräte mit e-Paper-Display, Audioaufnahme direkt auf dem Gerät und einer Transkriptions-Pipeline."
---
Eine laufende Hardware-Spur — batteriebetriebene, vernetzte Geräte mit eigener Firmware, Sensorik und Display.

<!--more-->

![Drei Boards auf der Werkbank: das e-Paper-Gerät, ein 5"-RISC-V-Tablet und ein Tastatur-Handheld — die beiden letzten mit derselben Oberfläche](../../img/esp32.jpg#small)

Software, die nur auf einem Bildschirm läuft, macht es sich bequem. Ein Teil unserer Arbeit ist deshalb auf echte Platinen umgezogen: batteriebetriebene ESP32-Geräte, die wir entwerfen, programmieren und im Alltag benutzen.

Auf der Werkbank steht gerade ein Gerät hinter einem e-Paper-Display, das eine gesprochene Notiz aufnimmt, per WLAN weiterschickt und als Text zurückgibt — und nebenbei als Uhr Temperatur und Luftfeuchte im Raum anzeigt. Daneben läuft dieselbe Sampler-Oberfläche auf zwei sehr unterschiedlichen Maschinen: einem Tastatur-Handheld in Kartengröße und einem 5"-Touch-Tablet, angetrieben von einer gemeinsamen Engine.

Hardware stellt andere Fragen als ein Browser. Energie hat ein Budget, Funkstrecken brechen ab, Displays kosten bei jeder Änderung Strom, ein Gerät, das in die Hand genommen wird, muss in Sekunden wach und bereit sein, und der Code muss stundenlang weiterlaufen, ohne dass jemand zusieht. Genau diese Randbedingungen sind die eigentliche Arbeit — und der Grund, warum sich die Ergebnisse belastbar anfühlen und nicht bloß vorgeführt.

Das hier ist eine Werkbank, kein Katalog: die Grundlage für das, [wohin wir Curious Electric als Nächstes bringen](/de/news/robotics-aiot/).

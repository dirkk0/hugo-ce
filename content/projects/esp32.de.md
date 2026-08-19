---
title: "ESP32 Hardware Lab"
date: 2026-08-12
draft: false
image: ../img/esp32.jpg
tags: ['IoT', 'ESP32', 'Audio', 'AI']
description: "Eine laufende Hardware-Spur: batteriebetriebene ESP32-Geräte mit e-Paper-Display, Audioaufnahme direkt auf dem Gerät und einer Transkriptions-Pipeline."
---
Eine laufende Hardware-Spur — batteriebetriebene ESP32-Geräte mit e-Paper-Display, Aufnahme direkt auf dem Gerät und ein Weg vom Gerät zum transkribierten Text.

<!--more-->

![Drei Boards auf der Werkbank: das e-Paper-Gerät, ein 5"-RISC-V-Tablet und ein Tastatur-Handheld — die beiden letzten mit derselben Oberfläche](../../img/esp32.jpg#small)

Software, die nur auf einem Bildschirm läuft, macht es sich bequem. Ein Teil unserer Arbeit ist deshalb auf echte Platinen umgezogen: drei ESP32-Geräte auf der Werkbank, jedes mit eigener Firmware, eigener Toolchain und eigenen offenen Fragen.

Das kleine weiße Gerät ist ein batteriebetriebenes ESP32-S3-Board hinter einem 1,54"-e-Paper-Display. Darauf laufen zwei eigene Firmwares: ein **Sprachnotiz-Rekorder** — Doppelklick nimmt auf, einfacher Klick stoppt oder spielt ab, langer Druck lädt hoch — und eine schlanke **Tischuhr** mit Uhrzeit, Raumtemperatur, Luftfeuchte und Akkustand. Die Aufnahmen gehen per WLAN an einen kleinen Server, werden von dort auf den Rechner geholt und transkribiert — direkt als 16-kHz-Mono geschrieben, also genau das Format, das das Sprachmodell erwartet, ohne Umweg über eine Konvertierung.

Das Interessante daran sind lauter Randbedingungen. Dieser Ruhebildschirm aktualisiert nur einmal pro Minute, weil e-Paper bei jeder Änderung Energie kostet. Das WLAN bleibt im stromsparenden Modem-Sleep verbunden, statt zwischen den Uploads abgeschaltet zu werden — komplettes Abschalten brach die Spannung der kleinen Zelle ein und startete das Gerät mitten in der Notiz neu. Was dabei herauskommt, läuft rund acht Stunden im gemischten Betrieb und bootet in unter zehn Sekunden.

Die beiden anderen zeigen dasselbe: eine rasterbasierte Sampler-Oberfläche, einmal auf einem Tastatur-Handheld in Kartengröße und einmal auf einem 5"-Touch-Tablet mit RISC-V-Chip. Zwei sehr unterschiedliche Boards, eine gemeinsame Engine, zusammengehalten von einem Link-Protokoll mit eigenen Konformitätstests — denn sobald derselbe Code auf zwei Maschinen läuft, taugt „bei mir geht's" nicht mehr als Antwort.

Das hier ist eine Werkbank, kein Katalog. Es ist der Teil, in dem sich zeigt, was Akku, Funk und Display tatsächlich tun, wenn sie niemand aus einem Browser-Tab heraus beobachtet — und aus dem die nächsten Dinge entstehen, die wir bauen.

---
title: "Block Forge"
date: 2026-04-15
draft: false
image: ../img/block-forge.png
tags: ['JavaScript', 'ThreeJS', 'WebGL', 'AI']
description: "Eine Pipeline, die kommerzielle 3D-Asset-Pakete in saubere, vermessene Modelle verwandelt — und daraus dann eine Maschine glaubwürdige Spiel-Level bauen lässt."
---
Aus rohen kommerziellen Asset-Paketen saubere, vermessene 3D-Modelle machen — und daraus eine Maschine Level bauen lassen.

<!--more-->

![Aufgeräumte Assets aus einem kommerziellen Paket, normalisiert und platzierbar](../../img/block-forge.png#small)

Block Forge fing als visueller Baukasten an: ein Asset-Paket im Browser öffnen, Teile in einen 3D-Viewport ziehen, Ergebnis exportieren. Diesen Editor gibt es weiterhin — aber der Schwerpunkt hat sich zweimal verschoben, und jede Verschiebung war interessanter als die vorige.

Zuerst vom Baukasten zum **Batch-Konverter**. Das wirklich Schwierige war nie die Platzierungs-Oberfläche, sondern das Material: kaputte Texturverweise, uneinheitliche Maßstäbe, Müll in den Hierarchien. Sobald diese Aufräumlogik in einem plattformfreien Modul steckte, ließ sich ein komplettes Paket kopflos konvertieren — ohne Mensch, ohne offenen Viewport.

Dann vom Konverter zum **Generator**. Mit einem Ordner sauberer, vermessener Modelle stellt sich eine andere Frage: Kann eine Maschine daraus ein Level bauen, das sich wie ein echter Ort liest? Dafür muss sie wissen, was ein Asset überhaupt *ist* — seine Grundfläche, seine Kategorie, ob es ein betretbares Gebäude oder bloße Kulisse ist. Dateinamen verraten davon so gut wie nichts Verlässliches. Also ist ein zweischichtiges Wissensmodell entstanden, gemessene Daten unten und kuratiertes Urteil darüber, und ein Generator, der daraus Level anordnet.

Am Ende ist es eine kleine Studie in maschinellem Raumverständnis: Software so viel Verständnis von Objekten und Raum zu geben, dass sie Entscheidungen trifft, die sonst ein Level-Designer von Hand trifft.

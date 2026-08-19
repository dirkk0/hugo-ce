---
title: "STARLIGHT"
date: 2024-03-13
draft: false
image: ../img/chart1.png
tags: ['JavaScript', 'ThreeJS', 'WebGL', 'AR']
description: "Eine interaktive Sternenkarte unserer kosmischen Nachbarschaft als Web-Applikation, auf Basis echter astrometrischer Daten aus ESA-Katalogen — gefördert von der Film- und Medienstiftung NRW."
---
Eine interaktive Sternenkarte unserer Nachbarschaft im Universum als Web-Applikation — entwickelt mit Förderung der Film- und Medienstiftung NRW.

<!--more-->

![Die Sonnenumgebung, aus astrometrischen Daten gerendert — jedes Label ein echter Stern](../../img/chart1.png#small)

STARLIGHT wurde von der [Film- und Medienstiftung NRW](https://www.filmstiftung.de/news/die-film-und-medienstiftung-nrw-vergibt-340-000-euro-fuer-10-serious-games-projekte/) im Rahmen der Förderung digitaler Spiele und interaktiver Inhalte gefördert und im März 2024 abgeschlossen. Es umfasst drei Teile: eine interaktive Sternenkarte, die Datenbank darunter und einen Raumflugsimulator darüber — als Konzept ausgearbeitet und mit lauffähigen Prototypen unterlegt.

Darunter liegt echte Astrometrie. Die Sterne stammen aus Beobachtungskatalogen der ESA, vor allem Hipparcos, und eine Konversionspipeline macht aus diesen wissenschaftlichen Daten etwas, das eine Echtzeit-Engine tragen kann: Positionen, Entfernungen und Helligkeiten in einem Detailgrad, den ein Browser flüssig darstellt. Die Konversion läuft als wiederholbar ausführbare Skripte, sodass sich Detailgrad und Bereinigungsregeln nachjustieren und der gesamte Datensatz neu erzeugen lässt — samt der kleinen Übersetzungen zwischen Wissenschaft und Spiel, etwa der negativen Parallaxenwerte, die im Katalog ihren Sinn haben und interpretiert werden wollen, bevor ein Stern im Raum stehen kann.

![Entfernungen: der Himmel, wie er erscheint, und dieselben Sterne, wie sie tatsächlich stehen](../../img/starlight.png#small)

Drei Prototypen tragen das Konzept. **distances** trennt den flachen Anblick des Himmels von der realen Tiefe dahinter — das Sternbild, das von hier aus wie eine Figur aussieht, besteht aus Sternen, die über Hunderte von Lichtjahren verteilt stehen. **compass** bindet die Karte an den eigenen Standort, sodass die Ansicht zum Himmel darüber passt. Und ein Sternen-Renderer zeichnet die Karte selbst, im Browser, aus dem konvertierten Katalog.

Augmented Reality im Browser erwies sich mit WebXR als gut erreichbar: das Handy zum Himmel halten, und die Karte legt sich darüber.

Konzept, Datenpipeline und Prototypen stehen — eine Grundlage, auf die wir zurückkommen wollen.

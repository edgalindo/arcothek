# arcothek
arcothek ist ein Responsive WordPress-Theme für den Aufbau einer Kunstverleih-Website. Es ist entstanden im Zuge des Projekts "kulturBdigital - Digitale Entwicklung des Kulturbereichs": https://kultur-b-digital.de/ . Dieses Projekt der Technologiestiftung Berlin wird gefördert von der Senatsverwaltung für Kultur und Europa.

Demo
------
arcothek wird beispielhaft eingesetzt auf der Website des Kunstverleih Lichtenberg. Eine aktive Installation finden Sie unter: https://www.kunstverleih-berlin-lichtenberg.de/ 

Installationsanleitung
------
Die Einhaltung der Reihenfolge für die folgenden Schritte ist wichtig, um Fehlermeldungen zu vermeiden!

1. Wordpress installieren und nach eigenen Wünschen konfigurieren. Getestet haben wir bis WordPress 5.3.2.

2. Das notwendigen Plugin Advanced Custom Fields PRO installieren und aktivieren.

Advanced Custom Fields PRO (kostenpflichtig)
WordPress durch leistungsfähige, professionelle und zugleich intuitive Felder erweitern.
https://www.advancedcustomfields.com/

3. Vordefinierte Felder in Advanced Custom Fields PRO importieren: Individuelle Felder > Werkzeuge die "Advanced Custom Fields JSON-Datei: "acf-fields.json" importieren.

4. Das Theme "artothek" in das Theme Verzeichnis hochladen und aktivieren.

5. Gewünschte Seiten erstellen.
Bei der Startseite das Seiten-Atribute Template "Bilder-Galerie Template" auswählen.
Bei der Künstler-Index Seite das Seiten-Atribute Template "Künstler A-Z Template" auswählen.

6. Mindestens jeweils einen Eintrag bei den Menüpunkten "Werke/Bilder" und "Künstler" erstellen.

7. Das notwendigen Plugin Search & Filter Pro installieren.
Search & Filter Pro (kostenpflichtig)
Ermöglicht das Suchen und Filtern nach Kategorien, Tags, Taxonomien, benutzerdefinierten Feldern, Post-Meta, Post-Datumsangaben, Post-Typen und Autoren.
https://searchandfilter.com/
Plugin installieren und wie in der Plugin-Anleitung "Search & Filter Anleitung.pdf" beschrieben konfigurieren.

8. Wenn gewünscht, die "Nice to have Plugins" jetzt ebenfalls installieren.

# Plugin Übersicht

## A. Notwendige Plugins:
Advanced Custom **Fields PRO** (kostenpflichtig) Version 5.8.7
WordPress durch leistungsfähige, professionelle und zugleich intuitive Felder erweitern.
https://www.advancedcustomfields.com/
Plugin installieren und unter: Individuelle Felder > Werkzeuge die "Advanced Custom Fields JSON-Datei: acf-fields.json" importieren.

Search & **Filter Pro** (kostenpflichtig) Version 2.5.0
Ermöglicht das Suchen und Filtern nach Kategorien, Tags, Taxonomien, benutzerdefinierten Feldern, Post-Meta, Post-Datumsangaben, Post-Typen und Autoren.
https://searchandfilter.com/
Plugin installieren und wie in der Anleitung beschrieben konfigurieren.

## B. Nice to have Plugins
One Click Accessibility
One Click Accessibility-Plugin, mit dem die Website leichter zugänglich gemacht wird.
https://de.wordpress.org/plugins/pojo-accessibility/
Plugin installieren und gewünschte Einstellungen vornehmen.

Page Builder by SiteOrigin
Ein responsiver Page-Builder, der per Drag-and-Drop zu bedienen ist und es einfach macht, Inhalte responsive anzuordnen und zu gestalten.
Plugin installieren und gewünschte Einstellungen vornehmen.

SiteOrigin Widgets Bundle
Eine Sammlung von Widgets, für den Page Builder by SiteOrigin, die in einem Plugin zusammengefasst sind.
https://de.wordpress.org/plugins/so-widgets-bundle/
Plugin installieren und gewünschte Einstellungen vornehmen.

Classic Editor
Aktiviert den klassischen WordPress-Editor und die „old-style“-Bearbeiten-Ansicht für Beiträge bzw. Seiten. Unterstützt außerdem ältere Plugins, die diesen Bildschirm erweitern.
https://de.wordpress.org/plugins/classic-editor/

Prevent Content Theft Lite
https://de.wordpress.org/plugins/disable-right-click/
Das Plugin verhindert ein Rechtsklick-Kontextmenü, wodurch das Kopieren von Website-Inhalten und Quellcode in gewissem Maße vermieden wird.
Plugin installieren.

Beam me up Scotty
Fügt der Site schnell und einfach eine Schaltfläche zum "Zurück nach oben" hinzu.
https://de.wordpress.org/plugins/beam-me-up-scotty/
Plugin installieren und gewünschte Einstellungen vornehmen.

# Konfiguration des Plugin Search & Filter Pro

Search & Filter Pro (kostenpflichtig)
Ermöglicht das Suchen und Filtern nach Kategorien, Tags, Taxonomien, benutzer-
definierten Feldern, Post-Meta, Post-Datumsangaben, Post-Typen und Autoren.
https://searchandfilter.com/

1. Plugin installieren und aktivieren
2. Add New Search Form

![alt text](https://github.com/edgalindo/arcothek/blob/master/images/0.png)

3. Gewünschten Titel vergeben
4. Einstellungen für den Tab „General“ wie in den Screenshots übernehmen.

![alt text](https://github.com/edgalindo/arcothek/blob/master/images/1.png)

5. Available Fields durch Drag & Drop anlegen

![alt text](https://github.com/edgalindo/arcothek/blob/master/images/2.png)

6. Angelegte Felder wie in den Screenshots konfigurieren.

![alt text](https://github.com/edgalindo/arcothek/blob/master/images/screenshots_konfig.png)

7. Einstellungen für den Tab „Display Results“ wie in den Screenshots übernehmen.

![alt text](https://github.com/edgalindo/arcothek/blob/master/images/8.png)
![alt text](https://github.com/edgalindo/arcothek/blob/master/images/9.png)

8. Einstellungen für den Tab „Posts“ wie in den Screenshots übernehmen.

![alt text](https://github.com/edgalindo/arcothek/blob/master/images/10.png)

9. Bei den Einstellungen für die Tabs „Tags, Categories & Taxonomies, Post Meta und Advanced“ können die Vorgabewerte übernommen werden.

![alt text](https://github.com/edgalindo/arcothek/blob/master/images/11.png)
![alt text](https://github.com/edgalindo/arcothek/blob/master/images/12.png)
![alt text](https://github.com/edgalindo/arcothek/blob/master/images/13.png)

10. Die Searchform durch „Veröffentlichen bzw. Aktualisieren“ speichern.

![alt text](https://github.com/edgalindo/arcothek/blob/master/images/14.png)

11. Die angezeigten Shortcodes kopieren und in die Template-Datei
„template-bildergalerie.php„ einfügen. Die ID 43 ist hier nur beispielhaft.
Bitte den Shortcode so wie er von der Search Form generiert wurde übernehmen.
`[searchandfilter id=“43“]`
`[searchandfilter id=“43]" [show=“results“]`

![alt text](https://github.com/edgalindo/arcothek/blob/master/images/15.png)

Credits
------
Auftraggeber: Bezirksamt Lichtenberg/Fachbereich Kunst und Kultur

Design und Programmierung: büro perzborn - Agentur für Kommunikation, Webentwicklung, Design und Print
Ferner ist zu beachten:

* [HTML5 Blank](http://html5blank.com) Licensed under the MIT License
* Fonts by Google fonts http://www.google.com/fonts licensed under Apache License Version 2 (http://www.apache.org/licenses/LICENSE-2.0.html)
* Font Awesome licensed under the MIT License http://fortawesome.github.io/Font-Awesome/
* [Bootstrap Authors](https://github.com/twbs/bootstrap/graphs/contributors) and [Twitter, Inc.](https://twitter.com) Code released under the [MIT License](https://github.com/twbs/bootstrap/blob/master/LICENSE). Docs released under [Creative Commons](https://creativecommons.org/licenses/by/3.0/).

License
------
Veröffentlicht unter GPLv2 license (http://www.gnu.org/licenses/gpl-2.0.html)

<!DOCTYPE html>

<html>
    <body style="font-family: Arial, Helvetica, sans-serif">


        <!-- A4 Papier  //-->
        <div style="width: 1000px;">
            <!-- Kopfbreich //-->
            <div style="height: 200px; align-items: center;">
                <div style="float:left; width: 20%; margin-right: 50px;">
                    @if($logo)
                        <img src="{{ $logo }}" style="width: 100px;">
                    @endif
                </div>

                <div style="font-size: 1.2em; width:80%">
                    {{ $application_organisation }}
                </div>

            </div>


            <!-- Addressbereich //-->
            <div>
                <!-- Empfängerberiech //-->
                <div style="font-size: 0.7em; width: 250;">
                    Freiwillige Feuerwehr Wiesbaden-Dotzheim – Rheintalstr. 23
                    65199 Wiesbaden
                </div>

                <div style="margin-top: 10; font-size: 0.8em; height: 150px;">
                    <div style="width: 45%; float:left; height:100%;">
                        <p>
                            {!! nl2br($adressat) !!}
                        </p>
                    </div>
                    <div style="height:100%;">
                        <!-- Absenderbereich //-->
                        Freiwillige Feuerwehr Wiesbaden-Dotzheim<br><br>

                        Rheintalstraße 23<br>
                        65199 Wiesbaden<br><br>

                        Tel.: +49 611 7166361<br>
                        E-Mail: info@ff-dotzheim.de<br><br>

                        Datum: {{ Carbon\Carbon::now()->format("d.m.Y") }}
                    </div>
                </div>
            </div>

            <!-- Titel //-->
            <div style="font-weight: bold; font-size: 01.3em; margin-top:100px; margin-bottom: 30px;">
                Bestätigung über eine Teilnahme am Feuerwehr-Einsatzdienst
            </div>

            <!-- Inhaltsbereich //-->
            <div style="font-size:0.8em; width:700px;">
                Sehr geehrter Damen und Herren,<br>
                die unten genannte Person ist Mitglied der aktiven Einsatzabteilung der Freiwilligen Feuerwehr Wiesbaden-Dotzheim.<br>
                Am unten genannten Zeitpunkt wurde die Person durch die Leitstelle Wiesbaden zu einem Brand bzw. Hilfeleistungseinsatz alarmiert. Er kam damit seiner Verpflichtung nach §11 (1), sowie § 38 (2) des Hessischen Brand- und Katastrophenschutzgesetzes nach, um hoheitliche Aufgaben im Interesse der öffentlichen Sicherheit wahrzunehmen. <br>
                Die dadurch entstandene Fehlzeit bitten wir zu entschuldigen.<br><br>

                <div style="display:flex; font-size: 1em; width:700px; margin-top:40px;">
                    <table style="width:100%;">
                        <tr>
                            <td style="width:50%; padding:3px; border-bottom:1px solid black;">Einsatznummer</td>
                            <td style="padding: 3px; border-bottom:1px solid black;">{{ $einsatznummer }}</td>
                        </tr>
                        <tr>
                            <td style="width:50%; padding:3px; border-bottom:1px solid black;">Name</td>
                            <td style="padding: 3px; border-bottom:1px solid black;">{{ $name }}</td>
                        </tr>
                        <tr>
                            <td style="width:50%; padding:3px; border-bottom:1px solid black;">Alarmierungszeitpunkt</td>
                            <td style="padding: 3px; border-bottom:1px solid black;">{{ $alarm_at }}</td>
                        </tr>
                        <tr>
                            <td style="width:50%; padding:3px; border-bottom:1px solid black;">Einsatzende</td>
                            <td style="padding: 3px; border-bottom:1px solid black;">{{ $alarm_end_at }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Inhaltsfuß //-->
            <div style="margin-top: 50px; font-size: 0.8em;">
                Mit freundlichen Grüßen<br><br><br>
                <br>
                Wehrführung<br><br>
                Maximilian Sommer, Markus Klebsattel, Christian Dingeldein, Henning von Hüllesheim<br>
                Freiwillige Feuerwehr Wiesbaden-Dotzheim<br>
            </div>
        </div>

    </body>
</html>

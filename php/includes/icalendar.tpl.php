BEGIN:VCALENDAR
VERSION:2.0
X-WR-TIMEZONE:Europe/London
X-WR-CALNAME:<?php print sanical($defs->name); ?>

<?php foreach ($events as $event):?>

BEGIN:VEVENT
URL;VALUE=URI:<?php sanical($event['dc:identifier']); ?>
DTSTART:<?php sanical(date('Ymd\THis', $event['start'])); ?>
DTEND:<?php sanical(date('Ymd\THis', $event['end'])); ?>
SUMMARY:<?php sanical($event['dc:title']); ?>
DESCRIPTION:<?php sanical($event['dc:description']); ?>
LOCATION:<?php sanical($event['location'] ? $event['location'] : $defs->name); ?>
END:VEVENT

<?php endforeach ?>

END:VCALENDAR

<?php echo '<?xml version="1.0" encoding="UTF-8" ?>' ;?>
<!DOCTYPE plist PUBLIC "-//Apple Computer//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
        <dict>
            <key>Hostname</key>
            <string>ftp.{{$ftp->domain->server->domain }}</string>
            <key>Nickname</key>
            <string>{{$ftp->username."@".$ftp->hostname}} </string>
            <key>Port</key>
            <string>21</string>
            <key>Protocol</key>
            <string>ftp</string>
            <key>Username</key>
            <string>{{$ftp->username."@".$ftp->hostname}}</string>
        </dict>
</plist>

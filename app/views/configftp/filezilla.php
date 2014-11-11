<?php echo '<?xml version="1.0" encoding="UTF-8" ?>' ;?>
<FileZilla3> 
    <Servers> 
        <Server> 
            <Host>ftp.<?php echo $ftp->domain->server->domain ?></Host> 
            <Port>21</Port> 
            <Protocol>ftp</Protocol> 
            <Type>0</Type> 
            <User><?php echo $ftp->username."@".$ftp->hostname?></User>
            <Logontype>2</Logontype> 
            <TimezoneOffset>0</TimezoneOffset> 
            <PasvMode>MODE_DEFAULT</PasvMode> 
            <MaximumMultipleConnections>0</MaximumMultipleConnections> 
            <EncodingType>Auto</EncodingType> 
            <BypassProxy>0</BypassProxy> 
            <Name>ftp.<?php echo $ftp->domain->server->domain ?></Name> 
            <Comments/> 
            <LocalDir/> 
            <RemoteDir/> 
            <SyncBrowsing>0</SyncBrowsing>
            ftp.<?php echo $ftp->domain->server->domain ?>
        </Server> 
    </Servers> 
</FileZilla3>

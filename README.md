# PHP-MySQL-export-CSV #

This php File permits a user to customize an Export from a MySQL Database Table to a CSV File.

### Configurables ###

* $createcsv = false; Default False. Denotes to Create a CSV File on Server
* $servecsv= true;  Default True. Enables Download of CSV File
* $db_table; The Database Table to select From
* $db_select = '*'; The Fields to Export
* $where ; Optional Where Clause for Query

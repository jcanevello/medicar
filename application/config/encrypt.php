
<?php defined('SYSPATH') or die('No direct script access.');
 
return array(
 
    'default' => array(
        /**
        * The following options must be set:
        *
        * string   key     secret passphrase
        * integer  mode    encryption mode, one of MCRYPT_MODE_*
        * integer  cipher  encryption cipher, one of the Mcrpyt cipher constants
        */
        'key'    => sha1(md5('$Proyecto$Progresa$2016$')).sha1(md5('$Canevello$Salazar$2016$')),
//        'key'    => '$Proyecto$Progresa$2016$',
        'cipher' => MCRYPT_RIJNDAEL_256,
        'mode'   => MCRYPT_MODE_NOFB,
    ),
 
);
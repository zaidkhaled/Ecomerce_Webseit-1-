<?php

//deusch sprache

function lang($phrase){

    // haompage
    
    static $lang = [ 
    
//    category page
    
        
    "VIST"                 => "Besuchen",
    "PROFILE"              => "Profil",
    "LOGIN"                => "Einloggen",
    "LOGIN/REGISETER"      => "Einloggen/Registrieren",
    "PERSONAL_INFO"        => "Persönliche Info",
    "CHANGE_PASSWORD"      => "Passwort ändern",
    "CHANGE"               => "Ändern",
    "FOTO_UPLOAD"          => "Dein Foto hochladen...",
    "FOTO_ITEM_UPLOAD"     => "Laden Sie Ihr Produktfoto hoch",
    "APPROVE_WAIT"         => "Warten Sie, bis es genehmigt wird ",
    "MAIN_FOTO"            => "Hauptfoto",
    "ITEMS_FOTOS"          => "Produktfotos",
    "ADD_BALANCE"          => "Saldo zu Ihrem Konto hinzufügen",
    "COMMENT"              => "Kommentar",
    "COMMENT_ON"           => "hat auf dein Produkt kommentiert",
        
        
        
        
    "ITEMS"               => "Items",
    "SHOP"                => "Shop",
    "CATEGORIES"          => "Kategorien",
    "MEMBERS"             => "Mitglieder",    
    "STATISTICS"          => "Statistik",
    "EDIT"                => "Bearbeiten",    
    "SETTING"             => "Einstellung",    
    "LOGOUT"              => "Logout",
    "LOG_IN"              => 'Log in',
    "HOME_ADMIN"          => "Home",  
    "DASHBOARD"           => "Dashboard",  
    "ERRMSG(3)_JS"        => "Bitte füllen Sie dieses Feld mit <strong> mehr als 3 </ strong> Buchstaben aus", // JS: Witch means the Error Msg will show form Javescript
    "ERRMSG(6)_JS"        => "Bitte füllen Sie dieses Feld mit <strong> mehr als 6 </ strong> Buchstaben aus",
    "ERRMSG(8)_JS"        =>  "Bitte füllen Sie dieses Feld mit <strong> mehr als 8 </ strong> Buchstaben aus",
    "PHP_ERRMSG_NAME"     => "Dein Name sollte <strong> mehr als 3 </ strong> Buchstaben sein",// Php: Witch means Error rong Msg will show form PHP
    "PHP_ERRMSG_EMAIL"    => "Ihre Email sollte <strong> mehr als 6 </ strong> Buchstaben sein, aber nicht mehr als 20 Buchstaben",
        
        
    "ERRMSG_VALIDATE_EMAIL"=> "Diese Email ist ungültig",
    "PHP_ERRMSG_FULLNAME" => "Dein vollständiger Name sollte <strong> mehr als 8 </ strong> Buchstaben sein, aber nicht mehr als 25 Buchstaben",
    "PHP_ERR_EMPTY_PASS"    => "Ihr Passwort sollte NICHT <strong> leer sein </ strong>",
    "PHP_ERR_DIFFERENT_PASS"=> "Die Passwörter sind unterschiedlich",
    "PHP_ERR_FOTO_EXTENTIONS"=> "Fotoerweiterung sollte jpg oder jpg oder jpeg oder gif sein",
    "PHP_ERR_FOTO_EMPTY"  => "Foto-Feld sollte nicht leer sein",
        
    "PHP_ERR_FOTO_SIZE"   => "Die Bildgröße sollte nicht größer als 40MB sein",
    "PHP_REAPETED_EMPTY"  => "Diese Email ist alrady exsit",
    "PHP_Rec_Err_Msg"     => "Diese Reihenfolge ist nicht <strong> Akzeptiert </ strong> Bitte versuchen Sie es erneut",
        
    "PHP_SUCCMSG"         => "Mission abgeschlossen info aktualisiert",
    "PHP_SUCCMSG_DEL_MSG" => "Mission abgeschlossen info gelöscht",
    "PHP_SUCCMSG_REGISTER"=> "Ihre Daten wurden registriert",
    "SURE_MSG"            => "Bist du sicher",
        
        
    "SURE_FULLNAME_MSG"   => "Sie werden diesen Benutzer löschen:",
    "FIRST_NAME_OR_EMAIL" => "Vorname oder E-mail",
    "FIRST_NAME"          => "Vorname",
    "EMAIL"               => "Email", 
    "PASSWORD"            => "Password", 
    "REPEAT_PASSWORD"     => "Passwort wiederholen",
    "COMMENT_TIMES"       => "Kmt_Mäler", 
    "ITEMS_NUM"           => "produkt_num", 
    "PHP_EMPTY_PASS"      => "Passwort sollte nicht leer sein", 
    "FULLNAME"            => "Vollständiger Name",
    "SAVE"                => "speichern",
        
        
    "EDIT_MEMBERS"        => "Mitglieder bearbeiten",
    "ADD_MEMBERS"         => "Mitglieder hinzufügen",
    "REGISTER"            => "Registrieren",
    "REGISTERED"          => "Registriert",
    "CONTROL"             => "Kontrolle",
    "CLOSE"               => "Schließen",
    "SURE_MSG"            => "Bist du sicher",
    "SURE_MSG_CONTENT"    => "Sie werden diesen Benutzer löschen ",
    "REDIRECTED"          => "Sie werden zur letzten Seite weitergeleitet",
    "SECONDS"             => "Sekunden",
    "SUCCESS"             => "Mission abgeschlossen",
    "FAILED"              => "Mission fehlgeschlagen",
    "LATEST_USER"         => "Letzte registrierte Benutzer",
    "GRUOP"               => "Gruop",
    "CURRENT_BALANCE"     => "Aktueller Kontostand",

    //Category Page 
        
    "MANGE CATEGORIES"    => "Mange Kategorien",   
    "ADD_NEW_CATEGORIES"  => "Neue Kategorie hinzufügen",    
    "EIDT_CATEGORIES"     => "Kategorie bearbeiten",
    "PHP_CATE_NAME"       => "Kategoriename ist leer",
    "ADD_CATEGORIES"      => "Kategorie hinzufügen",    
    "CATEGORY_NAME"       => "KATEGORIE NAME",   
    "DESCRIPTION"         => "BESCHREIBUNG",   
    "ORDERING"            => "Bestellen",    
    "VISIBILTY"           => "Sichtbar",    
    "COMMENTS"            => "Kommentare",    
    "ADVERTISING"         => "Werbung",                  
    "ALLOW"               => "Zulassen",    
    "NOT_ALLOW"           => "verhindern",   
    "SURE_CATE_NAME_MSG"  => "du wirst diese Kategorie löschen: " ,  
       
    //items page 
    "BUY"                 => "Kaufen",   
    "AGREE"               => "Stimme zu",    
    "CLOSE"               => "Schließen",   
    "EMPTY"               => "Leer",
    "HOW_MANY"            => "Wie viele  $",
    "HOW_MANY_ITEM"       => "Menge",    
    "ITEMS_MANGER"        => "Produck-Manager", 
    "ADD_NEW_ITEMS"       => "Neues Produkt hinzufügen",    
    "ADD_NEW_COMMENT"     => "Neuen Kommentar hinzufügen",
    "SENT_IT"             => "schicken",
    "WRITE_COMMENT"       => "schreiben sie Ihre Kommentar",
    "UPDATA_ITEM"         => "produkt info bearbeiten",    
    "ITEM_NAME1"          => "Name",  
    "ITEMS_DESCRP"        => "Beschreibung", 
    "ITEMS_PRICE"         => "Preis",  
    "ITEMS_MIND_IN"       => "Made-in", 
    "TAGS"                => "Tags (,)", 
    "TAG_SHOW"            => "Tags", 
    "RATING"              => "Bewertung",
    "NEW"                 => "Neu",
    "STATUS"              => "Status", 
    "LIKE_NEW"            => "Wie neu", 
    "USED"                => "Benutzt", 
    "OLD"                 => "alt", 
        
    "USER_NAME"          => "Benutzername", 
//        
    "PHP_ERRMSG_ITEM_NAME"=> "produktname sollte <strong> mehr als 6 </ strong> Buchstaben sein",
    "PHP_ERRMSG_DSCRP"    => "Artikelbeschreibung sollte <strong> mehr als 6 sein</strong>",
    "PHP_ERRMSG_MADE_IN"  => "Item 'made in' selector sollte <strong> mehr als 6 </ strong> Buchstaben sein", 
    "PHP_ERRMSG_CATE"     => "Bitte wählen sie ein kategorie name aus" ,  
    "PHP_ERRMSG_PRICE"    => "Biite schreibe deinen producktpreis ",  
    "PHP_ERRMSG_TAGS"     => "Bitte fullen sie das Tag-Feld ohne Leerzeichen aus",  
    "ITEM NAME"           => "Name",  
    "DESCRIPTION"         => "Beschreibung", 
    "PRICE"               => "Preis",
    "MADE_IN"             => "Made in",  
    "CATEGORY"            => "Kategorie",  
    "MEMBER_NAME"         => "Benutze Name",  
    "STATUS"              => "Status",  
    "OWNER"               => "Besitzer", 
    "ADD_DATA"            => "Veröffentlicht am",
    "CHOSE_ITEM"          => "wählen sie ein product aus",
    "DELETE_ITEM_MSG"     => "diese produkt löschen : ",
    "DELETE"              => "löschen",
    "NUMS_ITEM"           => "Anzahl_Produkt",
    "ADD_COMMENT"         => "Kommentar hinzufügen",
    "UPDATE_COMMENT"      => "Kommentar bearbeiten",
    "SOLD"                => "verkauft",
    "BOUGHT_YOUR"         => "hat dein produkt gekauft",
    "NO_RESULT_FUOND"     => "Keine Benachrichtigung gefunden",
    "NO_ITEM"             => "Es gibt keine Produkte zu zeigen",
    
    //comments Page  
     
    "ITEM_NAME"           => "Produkt_Name",
    "WRITTEN_IN"          => "Written in",
    "NO_NOTIF"            => "No notification found ",
        
    
    // lang
    "CHANGE_LANG"         => "Sprache ändern"
    ];
        
    return $lang[$phrase];
    
}
 ?>
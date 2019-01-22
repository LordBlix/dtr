<?xml version="1.0" encoding="utf-8"?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta http-equiv="Content-Script-Type" content="text/javascript" />
    <title>JavaScript Demo</title>
    <script type="text/javascript">
    // <![CDATA[
    var submitForm = function( thisForm ) {
    var form = document.getElementsByTagName("form");
    form[thisForm].submit();
    };
    window.onunload = function() { submitForm("form1"); };
    // ]]>
    </script>
    </head>
    <body>
    <div id="content">
    <form id="form0" action="xyz.com/order/email_order.php">
    <div>
    <label for="txt0">FORM1: <input type="text" id="txt0" name="txt0" value="" size="15" /></label>
    </div>
    </form>
    <form id="form1" action="https://www.paypal.com.cgi-bin/webscr">
    <div>
    <label for="txt1">FORM2: <input type="text" id="txt1" name="txt1" value="" size="15" /></label>
    </div>
    </form>
    <button id="btn" name="btn" onclick="submitForm('form0');">Submit my form!</button>
    </div>
    </body>
    </html>
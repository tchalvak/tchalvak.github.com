/*****
    Object-Oriented-Ajax (OO-Ajax):
    This is an object oriented abstraction of the Ajax (Asynchronous Javascript and XML)
    technique.  It abstracts away all of the arcane initialization and use
    of the XMLHttpRequest (XHR) object, by using several functions and constants which
    describe what the protocol is all about.
    
    If you want to use this, just leave the "Original Author" as is, and add your name
    in a "Edited By:" section.
    
    Original Author:    Ryan Kinal
    Edited By:  
*****/


/***** 
    The constructor:
    Declares all member functions, sets all member constants, and initializes
    all variables (save for the XMLHttpRequest object itself, as JavaScript
    object-orientation does not handle calls to member functions.  It treats
    them as function declarations.  Takes two parameters:  the server-side
    script to process the data sent via XHR, and the state change handler function
*****/
function Ajax(p_script, p_handler)
{
    // Initializing functions
    this.initXHR = ajax_initXHR;
    this.handler = p_handler;
    this.post = ajax_post;
    this.get = ajax_get;
    this.put = ajax_put;
    this.propfind = ajax_propfind;
    this.send = ajax_send;
    this.setReturnType = ajax_setReturnType;
    this.setScript = ajax_setScript;
    this.setStateHandler = ajax_setStateHandler;
    this.getReadyState = ajax_getReadyState;
    this.getMessage = ajax_getMessage;
    this.getStatus = ajax_getStatus;
    this.getStatusText = ajax_getStatusText;

    // Initializing the XHR connection to null
    // This is to be initialized in the initXHR function
    this.xmlhttp = null;

    // Defining constants.  Although they are certainly mutable,
    // they should not be changed under any circumstances.
    // Javascript, while supporting the const keyword, does not
    // seem to want to precede a this.VARIABLE with const.
    
    // These first five (REQUEST_...) _MUST_ have their
    // values, as they match the values of the corresponding
    // XMLHttpRequest "ready" states.
    this.REQUEST_UNINIT = 0;
    this.REQUEST_LOADING = 1;
    this.REQUEST_LOADED = 2;
    this.REQUEST_INTERACTIVE = 3;
    this.REQUEST_COMPLETE = 4;
    
    this.RETURN_XML = 5;
    this.RETURN_TEXT = 6;
    this.RETURN_BODY = 7;
    this.RETURN_STREAM = 8;
    
    // The only two real variables in the object.  The script used
    // to process the data sent, and the return type of the
    // data (XML, Text, Body, or Stream).  The default value for
    // return type is XML.
    this.script = p_script;
    this.returnType = this.RETURN_XML;
}


/*****
    Initializes the xmlhttp member variable to the correct
    object type, dependant on the client's browser.
*****/
function ajax_initXHR()
{
    var xhr;
    if (window.ActiveXObject)
    {
        try {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (e) {
            alert(e.message);
            xhr = null;
        }
    }
    else
    {
        xhr = new XMLHttpRequest();
    }
    
    this.xmlhttp = xhr;
}

/*****
    Send data via the http post method.  Also includes error checking,
    to see if the xmlhttp member variable was initialized, as well
    as catching any errors that may happen in the send.
*****/
function ajax_post(p_msg)
{
    if (this.xmlhttp != null)
    {
        try {
            this.xmlhttp.open("post", this.script);
            this.send(p_msg);
        } catch (e) {
            e.message = "Ajax: Post Failed\n" + e.message;
            throw e;
        }
    }
    else
    {
        alert("XMLHttpRequest has not been initalized.  Please call Ajax.initXHR()");
    }
}

/*****
    Send data via the http get method.  Also includes error checking,
    to see if the xmlhttp member variable was initialized, as well
    as catching any errors that may happen in the send.
*****/
function ajax_get(p_msg)
{
    if (this.xmlhttp != null)
    {
        try {
            this.xmlhttp.open("post", this.script);
            this.send(p_msg);
        } catch (e) {
            e.message = "Ajax: Get Failed\n" + e.message;
            throw e;
        }
    }
    else
    {
        alert("XMLHttpRequest has not been initalized.  Please call Ajax.initXHR()");
    }       
}

/*****
    Send data via the http put method.  Also includes error checking,
    to see if the xmlhttp member variable was initialized, as well
    as catching any errors that may happen in the send.
*****/
function ajax_put(p_msg)
{
    if (this.xmlhttp != null)
    {
        try {
            this.xmlhttp.open("put", this.script);
            this.send(p_msg);
        } catch (e) {
            e.message = "Ajax: Put failed\n" + e.message;
            throw e;
        }
    }
}

/*****
    Send data via the http propfind method.  Also includes error checking,
    to see if the xmlhttp member variable was initialized, as well
    as catching any errors that may happen in the send.
*****/
function ajax_propfind(p_msg)
{
    if (this.xmlhttp != null)
    {
        try {
            this.xmlhttp.open("propfind", this.script);
            this.send(p_msg);
        } catch (e) {
            e.message = "Ajax: Propfind failed\n" + e.message;
            throw e;
        }
    }
}

/*****
    An auxiliary function (called by Ajax.post, Ajax.get, Ajax.put, and Ajax.propfind)
    which sets the request header, encodes and sends the data, and sets
    the statechange handler
*****/
function ajax_send(p_msg)
{
    this.xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
    this.xmlhttp.send(encodeURIComponent(p_msg));
    this.xmlhttp.onreadystatechange = this.handler;
}

/*****
    Returns the ready state of the xmlhttp member object
*****/
function ajax_getReadyState()
{
    return this.xmlhttp.readyState;
}

/*****
    Returns the xmlhttp response, based on the returnType member variable
*****/
function ajax_getMessage()
{
    var message = "Error";
    
    if (this.returnType == this.RETURN_XML)
    {
        message = this.xmlhttp.responseXML;
    }
    else if (this.returnType == this.RETURN_TEXT)
    {
        message = this.xmlhttp.responseText;
    }
    else if (this.returnType == this.RETURN_BODY)
    {
        message = this.xmlhttp.responseBody;
    }
    else if (this.returnType == this.RETURN_STREAM)
    {
        message = this.xmlhttp.responseStream;
    }
    else
    {
        message = this.xmlhttp.responseText;
    }

     return message;
}

/*****
    Gets the HTTP status code of the XHR request, if the send() function
    has returned.  If not, it returns -1.
*****/
function ajax_getStatus()
{
    if (this.xmlhttp.readyState == this.REQUEST_COMPLETE)
    {
        return this.xmlhttp.status;
    }
    else
    {
        return -1;
    }
}

/*****
    Gets the HTTP status text of the XHR request, if the send() function
    has returned.  If not, it returns an message stating as such.
*****/
function ajax_getStatusText()
{
    if (this.xmlhttp.readyState == this.REQUEST_COMPLETE)
    {
        return this.xmlhttp.statusText;
    }
    else
    {
        return "Send not complete";
    }
}

/*****
    Sets the return type.  Should be used with the RETURN_ constants
    defined in the constructor.
*****/
function ajax_setReturnType(p_returnType)
{
    this.returnType = p_returnType;
}

/*****
    A mutator function to set the script, should you want to change
    which script is being used to process data.
*****/
function ajax_setScript(p_script)
{
    this.script = p_script;
}

/*****
    A mutator which sets the stateChangeHandler.  This takes a
    pointer to a function.
*****/
function ajax_setStateHandler(p_handler)
{
    this.handler = p_handler;
}
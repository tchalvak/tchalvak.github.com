/*****
    Just added this function, to handle keypresses in the chat
*****/
function ac_keypress(key)
{
    if (key == 13)
    {
        return ac_send(document.getElementById(ac_input).value);
    }
    else
    {
        return true;
    }
}

function ac_send(p_msg)
{
    if (p_msg != "")
    {
        try {
            ac_ajax.post(ac_un + ":" + p_msg);
        
            if (p_msg != "CHAT_REFRESH")
            {
                ac_sent = true;
            }
            else
            {
                ac_sent = false;
            }
        } catch (e) {
        }
    }
    
    return false;
}

function ac_handler()
{
    var state = ac_ajax.getReadyState();
    
    if (state == ac_ajax.REQUEST_COMPLETE)
    {
        var message = ac_ajax.getMessage();
        if (ac_sent)
        {
            document.getElementById(ac_output).innerHTML += message;
            document.getElementById(ac_input).value = "";
            document.getElementById(ac_input).focus();
            document.getElementById(ac_output).scrollTop = document.getElementById(ac_output).clientHeight;
        }
        else
        {
            document.getElementById(ac_output).innerHTML = message;
        }
    }
}

function ac_init()
{
    timeout = setInterval("ac_send('CHAT_REFRESH')", 500);
    document.getElementById(ac_output).scrollTop = document.getElementById(ac_output).clientHeight;
}

ac_un = prompt("Username:");

ac_ajax = new Ajax("./chat/chat.php", ac_handler);
ac_ajax.initXHR();
ac_ajax.setReturnType(ac_ajax.RETURN_TEXT);

ac_output = "chat_output";
ac_input = "userinput";
ac_sent = false;

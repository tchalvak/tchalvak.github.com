chat = true;

function switchVisible(p_old, p_new)
{
    document.getElementById(p_old).style.display = "none";
    document.getElementById(p_new).style.display = "block";

    return p_new;
}

function setSection()
{
    currentSection = switchVisible("content_1", "content_1");
    lastclick = document.getElementById("page_1");
    lastSect = document.getElementById("section_1");
    currentPage = "page_1_sect";
}

function toggleChat()
{
    // .style.display seems to be read only, otherwise, I'd get
    // rid of this stupid "chat" boolean.
    if (chat)
    {
        document.getElementById("chat").style.display = "none";
        document.getElementById("chatOn").style.display = "inline";
        document.getElementById("chatOff").style.display = "none";
        clearInterval(timeout);
        chat = false;
    }
    else
    {
        document.getElementById("chat").style.display = "block";
        document.getElementById("chatOn").style.display = "none";
        document.getElementById("chatOff").style.display = "inline";
        timeout = setInterval("ac_send('CHAT_REFRESH')", 500);
        chat = true;
    }
    
    return false;
}
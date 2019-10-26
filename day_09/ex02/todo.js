function readCookie(name)
{
    var name = name + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) 
    {
        var c = ca[i];
        while (c.charAt(0) == ' ') 
            c = c.substring(1);
        if (c.indexOf(name) == 0)
            return (c.substring(name.length, c.length));
    }
    return null;
}

function addItemtoList(str)
{
    var text_node = document.createTextNode(str);
    var new_item = document.createElement("div");
    new_item.appendChild(text_node);
    new_item.setAttribute("class", "item");
    new_item.onclick = deleteItem;
    var list = document.getElementById("ft_list");
    if (list.childElementCount === 0)
        list.appendChild(new_item);
    else
        list.insertBefore(new_item, list.firstChild);
}

function createCookie()
{
    var items = document.getElementsByClassName("item");
    var array = new Array();
    for (var i = 0; i < items.length; i++)
        array.push(items[i].innerText);
    var cookie = JSON.stringify(array);
    var date = new Date();
    date.setTime(date.getTime() + (30*24*60*60*1000));
    var expires = "expires="+ date.toUTCString();
    document.cookie = "list=" + cookie + ";" + expires + ";path=./";
}

function deleteItem() 
{
    if (window.confirm(`Are you certain to delete task '${this.textContent}' ?`))
    {
        this.parentNode.removeChild(this);
        createCookie();
    }
}

function createItem()
{
    var input = prompt("New task:");
    if (input === null || input === "" || !input.trim())
        return;
    addItemtoList(input);
    createCookie();
}

function createTodo()
{
    if (readCookie("list") != null)
    {
        cookie = JSON.parse(readCookie("list"));
        var list = document.getElementById("ft_list");
        for (var i = cookie.length - 1; i >= 0; i--)
            addItemtoList(cookie[i]);
    }
}
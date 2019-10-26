function createCookie(name, value, days)
{
    if (days)
    {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        var expires = "expires="+ date.toUTCString();
    }
    else
        var expires = ""; 
    document.cookie = name + "=" + value + ";" + expires + ";path=./";
}

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

function deleteItem()
{
    var i = 0;
    var array = new Array();

    var items = document.getElementsByClassName("item");
    while (i < items.length)
    {
        items[i].onclick = function() 
        {
            if (window.confirm(`Are you certain to delete task '${this.textContent}' ?`))
            {
                this.parentNode.removeChild(this);
                array = [];
                for (var i = 0; i < items.length; i++)
                    array.push(items[i].innerText);
                var cookie = JSON.stringify(array);
                createCookie("list", cookie, 30);
            }
            else
                return;
        }
        i++;
    }
}

function createItem()
{
    var input = prompt("New task:");
    var list = document.getElementById("ft_list");
    var array = new Array();

    if (input === null || input === "" || !input.trim())
        return;
    var text_node = document.createTextNode(input);
    var new_item = document.createElement("div");
    new_item.appendChild(text_node);
    new_item.setAttribute("class", "item");
    if (list.childElementCount === 0)
    {
        list.appendChild(new_item);
        var items = document.getElementsByClassName("item");
        for (var i = 0; i < items.length; i++)
            array.push(items[i].innerText);
        var cookie = JSON.stringify(array);
        createCookie("list", cookie, 30);
    }
    else
    {
        list.insertBefore(new_item, list.firstChild);
        var items = document.getElementsByClassName("item");;
        for (var i = 0; i < items.length; i++)
            array.push(items[i].innerText);
        var cookie = JSON.stringify(array);
        createCookie("list", cookie, 30);
    }
    deleteItem();
}

function createTodo()
{
    if (readCookie("list") != null)
    {
        cookie = JSON.parse(readCookie("list"));
        var list = document.getElementById("ft_list");
        for (var i = 0; i < cookie.length; i++)
        {
            var text_node = document.createTextNode(cookie[i]);
            var new_item = document.createElement("div");
            new_item.appendChild(text_node);
            new_item.setAttribute("class", "item");
            list.appendChild(new_item);
        }
    }
    deleteItem();
}
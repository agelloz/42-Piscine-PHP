function createCookie(name, value, days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function deleteItem() {
    var i = 0;
    var array = new Array();

    var listItems = document.getElementsByClassName("item");
    while (i < listItems.length) {
        listItems[i].onclick = function() {
        if (window.confirm(`Are you sure you want to delete ${this.textContent} ?`))
        {
            this.parentNode.removeChild(this);
            array = [];
            for (var i = 0; i < listItems.length; i++)
                array.push(listItems[i].innerText);
            var cookie_list = JSON.stringify(array);
            createCookie("todo", cookie_list);
        }
        else
            return;
        }
        i++;
    }
}

function createItem() {
    var input = prompt("New task:");
    var main_div = document.getElementById("ft_list");
    var array = new Array();

    if (input === null || input === "" || !input.trim())
        return;
    var text_node = document.createTextNode(input);
    var new_item = document.createElement('div');
    new_item.appendChild(text_node);
    new_item.setAttribute("class", "item");
    if (main_div.childElementCount === 0)
    {
        main_div.appendChild(new_item);
        var todo_list = document.getElementsByClassName('item');
        for (var i = 0; i < todo_list.length; i++)
            array.push(todo_list[i].innerText);
        var cookie_list = JSON.stringify(array);
        createCookie("todo", cookie_list);
    }
    else
    {
        main_div.insertBefore(new_item, main_div.firstChild);
        var todo_list = document.getElementsByClassName('item');;
        for (var i = 0; i < todo_list.length; i++)
            array.push(todo_list[i].innerText);
        var cookie_list = JSON.stringify(array);
        createCookie("todo", cookie_list);
    }
    deleteItem();
}

function createTodo() {
    if (getCookie("todo"))
    {
        cookie = JSON.parse(readCookie("todo"));
        var main_div = document.getElementById("ft_list");
        
        for (var i = 0; i < cookie.length; i++) {
            var text_node = document.createTextNode(cookie[i]);
            var new_item = document.createElement('div');
            new_item.appendChild(text_node);
            new_item.setAttribute("class", "item");
            main_div.appendChild(new_item);
        }
    }
    deleteItem();
}

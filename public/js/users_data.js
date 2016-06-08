        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                jsonData = JSON.parse(xhttp.responseText);

                usersDataEl = document.getElementById('users-data');
                for (uNamekey in jsonData) {
                    //for ( fieldkey in jsonData[uNamekey] ){
                    var liParentEl = document.createElement("LI");
                    liParentEl.className = 'liste';

                    var nameElement = document.createElement('a');
                    nameElement.href = "/messages/view/" + jsonData[uNamekey]['username'];
                    nameElement.text = jsonData[uNamekey]['fullname'];
                    liParentEl.appendChild(nameElement);

                    liParentEl.appendChild(document.createTextNode(', '));

                    var followersEl = document.createTextNode(jsonData[uNamekey]['followers'] + ' followers,');
                    liParentEl.appendChild(followersEl);

                    var incomMsgEl = document.createTextNode(' ' + jsonData[uNamekey]['incomMsg'] + ' incoming messages');
                    liParentEl.appendChild(incomMsgEl);

                    if (jsonData[uNamekey]['loginDate']) {
                        var loginDateEl = document.createTextNode(' - Last login: ' + jsonData[uNamekey]['loginDate']);
                        liParentEl.appendChild(loginDateEl);
                    }


                    var delButtonEl = document.createElement("a");
                    delButtonEl.href = "admin/deleteUser/" + jsonData[uNamekey]['username'];
                    delButtonEl.className = "delete_button";
                    liParentEl.appendChild(delButtonEl);

                    usersDataEl.appendChild(liParentEl);
                }
            }
        };
        xhttp.open("GET", "http://mirindrar.com/admin/outputAjaxXML", true);
        xhttp.send();
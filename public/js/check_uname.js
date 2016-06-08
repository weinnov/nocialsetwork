
        
        RefNotifier = document.getElementById('notif');
        document.getElementById('iduname').addEventListener('blur',function(){
            var saisie = this.value;
            objAjxNotif = new XMLHttpRequest();
            objAjxNotif.onreadystatechange = function(){
                var availability = objAjxNotif.responseText;
                if(availability){
                    RefNotifier.textContent = "✔ "+saisie+" is great";
                    RefNotifier.style.color = "green";
                }else{
                   RefNotifier.textContent = "✘ "+saisie+" is taken";
                   RefNotifier.style.color = "red";
                };   
            }/*
            objAjxNotif.open('GET','/ajax.php?action=checkUsername&username='+saisie,true);*/
            objAjxNotif.open('GET','/signup/ajaxChekUname/'+saisie,true);
            objAjxNotif.send();
        }); 
        if(0 ){document.getElementById('formContainer').innerHTML = '';}
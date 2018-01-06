/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(document.getElementById('lmbtn'))
{
    document.getElementById('lmbtn').addEventListener('click',function(){
        var offset=this.dataset.offset;
        if(window.XMLHttpRequest)
        {
            xhttp = new XMLHttpRequest();
        }
        else
        {
            xhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xhttp.onreadystatechange = function() 
        {
            if (this.readyState === 4 && this.status === 200)
            {
                var data = JSON.parse(this.responseText);
                if(!isEmpty(data))
                {
                    var output = '';
                    for(var i=1 ; i <= Object.keys(data).length ; i++)
                    {
                        output += '<a href="'+data[i].platform_name+'">'+
                                      '<div class="new-prod">' +
                                          '<div class="flip">' +
                                              '<div class="front">' +
                                                  '<img src="images/'+data[i].picture+'" alt="Obrázek pro hru '+data[i].product_name+'">'+
                                                  '<p class="name">'+data[i].product_name+' ('+data[i].platform_name+')</p>'+
                                                  '<p class="price">'+data[i].price+' Kč</p>'+
                                              '</div>'+
                                              '<div class="back">'+data[i].description+'</div>'+
                                          '</div>'+
                                      '</div>'+
                                  '</a>';
                    }
                    document.getElementById('new-container').innerHTML = document.getElementById('new-container').innerHTML+output;
                    document.getElementById('lmbtn').setAttribute('data-offset',parseInt(offset)+8);
                }
                else
                {
                    document.getElementById('lmbtn').textContent="To je vše :(";
                }
            }
        };
        xhttp.open('POST', '/ajax/loadmore', true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send('offset='+offset);
    });
}
function isEmpty(obj)
{
    for(var key in obj)
    {
        if(obj.hasOwnProperty(key))
        {
            return false;
        }
    }
    return true;
}
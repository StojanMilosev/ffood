$('document').ready(function(){
    //promeniljive 
    var order = [];
    var item = '';
    var cena = 0;
    
    //smooth scrolling prilikom koriscenja navigacije
        $('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html, body').animate({
                scrollTop: target.offset().top
                }, 500);
                return false;
            }
            }
        });
    
    //auto collapse menu in mobile view fix
    $(".navbar-nav li a").click(function(event) {
        $(".navbar-collapse").collapse('hide');
    });   
    
    //dodavanje proizvoda u narudzbinu
    $(".item-button").click(function(){
        //menjane stila dugmeta za prikazivanje proudzbine
        //da li dugme poseduje klasu 'deafult'
        if($("#order-modal").attr("class")=="btn btn-default"){
            //zameni klasu 'default' sa klasom 'success'
            $( "#order-modal" ).toggleClass( "btn-deafult btn-success" );
        }
        //deklarisanje promenljivih koje sadrze podatke proizvoda 
        var row = $(this).closest("tr");
        var naziv = row.find("td:eq(0)").text();
        var cena = row.find("td:eq(1)").text();
        
        //konstruisanje objekta koji predstavlja proizvod
        var obj ={};
        obj.naziv = naziv;
        obj.cena = parseInt(cena);
        //dodavanje proizvoda nizu narudzbine
        order.push(obj);
    });
    //prikaz poruzdbine
    $("#order-modal").click(function(){
        //ciscenje modal-a porudzbine
        $("#order-table").empty();
        $("#total").empty();
        cena =0;
        //iteracija kroz elemente niza
        $.each(order,function(index,data){
            //svaki element niza se dodaje tabeli kao red
            $("#order-table").append(
                    "<tr>"+
                    "<td>"+data.naziv+"</td>"+
                    "<td>"+data.cena+"</td>"+
                    "</tr>"
                    );
            //racunanje ukupne cene porudzbine
            cena = cena+data.cena;
        });
        //dodavanje ukupne cene porudzbine
        if(cena){
            $("#order-table").append(
                    "<tr style='border-top: solid thin black;'>"+
                    "<td class='text-right text-total'><br>total</td>"+
                    "<td><br> "+cena+"</td>"+
                    "</tr>"
                    );
        }
    });
});
/*
*
*	front end logika koja AJAX-om šalje podatake CRUD-u i nazad dobija podatke iz baze.
*	Svaka funkcija šalje tip funkcije koja se traži od CRUD-a ako je u pitanju iščitavanje podatak iz baze
*	pravi se html leemeti od podataka i lepe na stranicu
*	čupanje podataka i manipulisanje se radi sa jQuery
*/

/*
* keriranje podataka
*/
    function create(){
	//uzimanje podataka koji se nalaze u elementu #create-table
        var table = $('#create-table').val();
        var action = 'create';
	//ajax poziv
        $.ajax({
	//tip poziva 
            type:"post",
	//url kuda se šalje poziv
            url:"includes/action.php",
	//podatci koji se šalju da se ubace u bazu 
	//.serialize() kreira text string u URL notaciji (single=Single&multiple=Multiple&multiple=Multiple3&check=check2&radio=radio1)
            data:$("#create-item").serialize()+"&table="+table+"&action="+action,
	//ako poziv uspe sledi osvežavaje podataka stranice
	// pros iščitaju podatci iz baze > elementi sa stranice se ukolen > lepe se novi podaci na strancu
            success:function(data){
                read();
                $('#info').empty();
                $('#info').append(data);
                console.log(data);
            }
        });
    };
/*
* Iščitavanje podataka iz baze
*/
    function read(){
        var table = $('#read-table').val();
        var action = 'read';
        $.ajax({
	//tip poziva 
            type:"post",			
	//url kuda se šalje poziv
            url:"includes/action.php",			
	//podatci koji se šalju da se ubace u bazu 
            data:"&table="+table+"&action="+action,
            success:function(data){				
	//ako poziv uspe sledi osvežavaje podataka stranice
	// pros iščitaju podatci iz baze > elementi sa stranice se ukolen > lepe se novi podaci na strancu
                $("#prikaz").empty();
	// po defaultu je ovaj element sakriven pa mu treba ukloniti klasu koja na to utice
                $("#prikaz").removeClass("hidden"); 
                var result = $.parseJSON(data);
	//kada se podaci prevedu JSON prvo se dodaje zaglavlje tabele
                $("#prikaz").append("<thead>" +
                    "<th>ID</th>" +
                    "<th>naziv</th>" +
                    "<th>cena</th>" +
                    "<th>update</th>" +
                    "<th>delete</th>" +
                    "</thead>"
                );
	//deklarisanje array-a u kome će biti podatci iz baze
                var items = [];
	//za svaki element iz rezultata AJAX poziva se konstruise html element (red u tabeli) sa podacima iz array-a i ubacuje u items array
	//s obzirom da je result u JSON-u svaki element se gleda kao objekat u JS
                $.each( result, function( key, val ) {
                    items.push(
                        "<tr>"+
                        "<td>"+ val.id+"</td>"+
                        "<td>"+ val.naziv+
                        "<td>"+val.cena+"</td>"+
                        "<td>"+table+"</td>"+
                        "<td><button type='button' class='btn btn-danger del' onclick='dell("+val.id+",\""+table+"\")'><span class='glyphicon glyphicon-remove'></span> obrisi</button></td>"+
                        "<td><button type='button' class='btn btn-warning' onclick='updatePregled("+val.id+","+table+")' data-toggle='modal' data-target='#promena-pregleda-modal'><span class='glyphicon glyphicon-edit'></span> promeni</button></td>"+
                        "</tr>"
                    );
                });
	//kada se prodje kroz sve elemente svi elementi iz niza items se spoje u jedan string i zalepe za element sa id #prikaz 
                $( "<tbody/>", { html: items.join( "" ) }).appendTo( "#prikaz" );
            }
        });
    };
/*
*	Brisanje podataka iz baze
*/
    function dell(id,table){
	//deklarisanje akcije za CRUD
        var action = 'delete';
        $.ajax({
	//tip poziva 
            type: "POST",
	//url na koji se šalje poziv
            url: "includes/action.php",
	//podatci koji se šalju CRUD-u, id je ID podatka u bazi
            data: "id="+id+"&table="+table+"&action="+action,
	//ako poziv uspe obrisi podatke sa stranice iščitati ih ponovo i zalepiti za stranicu
            success: function(data){
                read();
                $('#info').empty();
                $('#info').append(data);
            }
        });
    };
 //
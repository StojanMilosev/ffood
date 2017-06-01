function delData(id,table){
    $("#info").empty();
    var action = 'delete';
    $.ajax({
        type: "POST",
        url: "libs/action.php",
        data: "id="+id+"&table="+table+"&action="+action,
        success: function(data){
            $("#info").append(data);
        }
    });
}//end delData()
function delPregled(id){
    delData(id,"pregled");
    getPregled();
};//end delPregled
function delPacijent(id){
    delData(id,"pacijent");
    getPacijent();
};//end delPacijent
function getPregled(){
    var table = 'pregled';
    var action = 'get';
    $.ajax({
        type:"POST",
        url:"libs/action.php",
        data:"table="+table+"&action="+action,
        success: function(data){
            $( "#prikaz" ).empty();
            $("#prikaz").removeClass("hidden");
            var pregledi = $.parseJSON(data);
            $("#prikaz").append("<thead class='thead-inverse'>" +
                "<th>ID</th>" +
                "<th>Ime i prezime</th>" +
                "<th>Vrsta pregleda</th>" +
                "<th>Br. zdravstvenog kartona</th>" +
                "<th></th>" +
                "<th><h4>[ Lista pregleda ]</h4></th>" +
                "</thead>"
            );
            var items = [];
            $.each( pregledi, function( key, val ) {
                items.push(
                    "<tr>"+
                    "<td>"+ val.id+"</td>"+
                    "<td>"+ val.ime+" "+ val.prezime+"</td>"+
                    "<td>"+val.vrsta_pregleda+"</td>"+
                    "<td>"+val.broj_zdravstvenog_kartona+"</td>"+
                    "<td><button type='button' class='btn btn-danger del' onclick='delPregled("+val.id+")'><span class='glyphicon glyphicon-remove'></span> obrisi</button></td>"+
                    "<td><button type='button' class='btn btn-warning' onclick='updatePregled("+val.id+")' data-toggle='modal' data-target='#promena-pregleda-modal'><span class='glyphicon glyphicon-edit'></span> promeni</button></td>"+
                    "</tr>"
                );
            });
            $( "<tbody/>", { html: items.join( "" ) }).appendTo( "#prikaz" );
        }
    });
};//end getPregled()
function getPacijent(){
    var table = 'pacijent';
    var action = 'get';
    $.ajax({
        type:"POST",
        url:"libs/action.php",
        data:"table="+table+"&action="+action,
        success: function(data){
            //priprema mesta za prikaz posataka
            $( "#prikaz" ).empty();
            $("#prikaz").removeClass("hidden");
            //priprema rezultata upita
            var pacijenti = $.parseJSON(data);
            var items = [];
            //priprema zaglavlja tabele
            $("#prikaz").append("<thead class='thead-inverse'>" +
                "<th>ID</th>" +
                "<th>Ime</th>" +
                "<th>Prezime</th>" +
                "<th>JMBG</th>" +
                "<th>Br. zdravstvenog kartona</th>" +
                "<th></th>" +
                "<th><h4 class='table-head'>[ Lista pacijenata ]</h4></th>" +
                "</thead>"
            );
            //dodavanje redova telu tabele
            $.each( pacijenti, function( key, val ) {
                items.push(
                    "<tr>"+
                    "<td>"+ val.id+"</td>"+
                    "<td>"+ val.ime+"</td>"+
                    "<td>"+ val.prezime+"</td>"+
                    "<td>"+val.jmbg+"</td>"+
                    "<td>"+val.broj_zdravstvenog_kartona+"</td>"+
                    "<td><button type='button' class='btn btn-danger' onclick='delPacijent("+val.id+")'><span class='glyphicon glyphicon-remove'></span></button></td>"+
                    "<td><button type='button' class='btn btn-warning' onclick='updatePacijent("+val.id+")' data-toggle='modal' data-target='#promena-pacijenta-modal'><span class='glyphicon glyphicon-edit'></span></button></td>"+
                    "</tr>"
                );
            });
            //dodavanje tela tabeli prikaza
            $( "<tbody/>", { html: items.join( "" ) }).appendTo( "#prikaz" );
        }

    });
};//endGetPacijent()
function insertPregled(){
    $("#info").empty();
    var table = 'pregled';
    var action = 'insert';
    $.ajax({
        url:"libs/action.php",
        method:"POST",
        data:$('#zakazivanje-pregleda-form').serialize()+"&table="+table+"&action="+action,
        success:function (data) {
            $('#zakazivanje-pregleda-form')[0].reset();
            $('#zakazivanje-pregleda-modal').modal('hide');
            $("#info").append(data);
            console.log(data);
        }
    });
    getPregled();
};//end insertPregled()
function insertPacijent(){
    $("#info").empty();//ciscenje info div-a
    var table = 'pacijent';
    var action = 'insert';
    $.ajax({
        url:"libs/action.php",
        method:"POST",
        data:$('#dodavanje-pacijenta-form').serialize()+"&table="+table+"&action="+action,
        success:function (data) {
            $('#dodavanje-pacijenta-form')[0].reset();
            $('#dodavanje-pacijenta-modal').modal('hide');
            $("#info").append(data);
        }
    })
    getPacijent();
};//end insertPregled()
function update(table,modal,form){
    event.preventDefault();
    $("#info").empty();
    var action = 'update';
    $.ajax({
        url:"libs/action.php",
        method:"POST",
        data:$(form).serialize()+"&table="+table+"&action="+action,
        success:function (data) {
            $(form)[0].reset();
            $(modal).modal('hide');
            $("#info").append(data);
        }
    });
    if(table==='pregled'){
        getPregled();
    }else if(table==='pacijent'){
        getPacijent();
    };
};//end update()
function updatePacijent(id){
    var table = 'pacijent';
    var action = 'modal';
    $.ajax({
        url:"libs/action.php",
        method:"POST",
        data:"id="+id+"&table="+table+"&action="+action,
        success:function (data) {

            console.log(data);
            var pacijent = $.parseJSON(data);
            $("#promena-pacijenta-modal")
                .find("[name=id]").val(pacijent.id).end()
                .find("[name=ime]").val(pacijent.ime).end()
                .find("[name=prezime]").val(pacijent.prezime).end()
                .find("[name=jmbg]").val(pacijent.jmbg).end()
                .find("[name=brKartona]").val(pacijent.broj_zdravstvenog_kartona).end();
        }
    });
};//end updatePacijent()
function updatePregled(id){
    var table = 'pregled';
    var action = 'modal';
    $.ajax({
        url:"libs/action.php",
        method:"POST",
        data:"id="+id+"&table="+table+"&action="+action,
        success:function (data) {
            console.log(data);
            var pregled = $.parseJSON(data);
            $("#promena-pregleda-modal")
                .find("[name=id]").val(pregled.id).end()
                .find("[name=ime]").val(pregled.ime).end()
                .find("[name=prezime]").val(pregled.prezime).end()
                .find("[name=jmbg]").val(pregled.jmbg).end()
                .find("[name=brKartona]").val(pregled.broj_zdravstvenog_kartona).end()
                .find("[name=pregled]").val(pregled.vrsta_pregleda).end();
        }
    });
};//end updatePregled()
